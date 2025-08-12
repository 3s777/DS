<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Yaml\Yaml;

#[AsCommand('openapi:build')]
class OpenApiBuildCommand extends Command
{
    public function handle(): int
    {
        $data = Yaml::parseFile(resource_path('openapi/v1.yaml'));

        $yamlData = Yaml::dump($data, 10, 2);

        (new Filesystem())->put(
            resource_path('openapi/v1_build.yaml'),
            $yamlData
        );

        dd($yamlData);


        $this->generateFile(
            app_path('Contracts/Api/ResponderContract.php'),
            $this->makeStub('responder_contract')
        );

        $this->generateFile(
            app_path('Contracts/Api/ResponseResolverContract.php'),
            $this->makeStub('resolver_contract')
        );

        $routes = ['uses' => [], 'routes' => []];

        foreach ($data['paths'] as $endpoint => $data) {
            $methods = [];
            $controllerName = '';

            foreach ($data as $method => $parameters) {
                $security = isset($parameters['security']);
                $pathParameters = collect($parameters['parameters'] ?? [])
                    ->map(fn ($parameter) => $parameter['in'] === 'path' ? $parameter['name'] : null)
                    ->filter()
                    ->toArray();

                //$hasQueryParameters = collect($parameters['parameters'] ?? [])->every(fn($parameter) => $parameter['in'] === 'query');
                $hasRequestBody = $parameters['requestBody'] ?? false;

                $operation = $parameters['operationId'] ?? '__invoke';

                $tag = $parameters['tags'][0];

                $action = strtolower(str_replace(strtolower($tag), '', $operation));

                $controllerName = $parameters['tags'][0];
                $methods[$method] = [
                    'method' => $action ?: $operation,
                    'endpoint' => $endpoint,
                    'security' => $security,
                    'name' => $controllerName,
                    'parameters' => $pathParameters,
                    'withFormRequest' => $hasRequestBody,
                ];

            }

            $r = $this->makeController($controllerName, $methods);
            $routes['uses'] = array_merge($routes['uses'], $r['uses']);
            $routes['routes'] = array_merge($routes['routes'], $r['routes']);
        }

        $this->generateFile(
            app_path('Routing/ApiRegistrar.php'),
            $this->makeStub('routes', [
                '@use' => implode(PHP_EOL, array_unique($routes['uses'])),
                '{{routes}}' => $this->tab(3) . implode($this->tab(3), array_unique($routes['routes'])),
            ])
        );

        return self::SUCCESS;
    }

    private function tab(int $times = 1): string
    {
        return str_repeat(' ', $times * 4);
    }

    private function makeStub(string $name, array $replacements = []): string
    {
        $stub = File::get(resource_path("openapi/stubs/$name.stub"));

        return str_replace(
            array_keys($replacements),
            $replacements,
            $stub
        );
    }

    private function generateFile(string $path, string $content, bool $replace = true): void
    {
        if (!$replace && File::exists($path)) {
            return;
        }

        if (!File::exists(dirname($path))) {
            File::makeDirectory(dirname($path), recursive: true);
        }

        File::put($path, $content);
    }

    private function makeController(string $name, array $data): array
    {
        $routes = [];
        $routesUses = [];
        $uses = [];
        $methods = [];

        foreach ($data as $httpMethod => $parameters) {
            $routes[] = $this->makeStub('route', [
                '{{method}}' => $httpMethod,
                '{{action}}' => $parameters['method'] === '__invoke' ? "{$parameters['name']}Controller::class" : "[{$parameters['name']}Controller::class, '{$parameters['method']}']",
                '{{path}}' => $parameters['endpoint'],
                '{{name}}' => $parameters['method'] === '__invoke'
                    ? strtolower(str_replace('Controller', '', $parameters['name']))
                    : $parameters['method'],
                '{{additional}}' => $parameters['security'] ? "->middleware('auth:jwt')" : '',
            ]);

            $prefix = $name;

            if (strtolower($parameters['method']) !== 'index' && strtolower($name) !== strtolower($parameters['method'])) {
                $prefix = $parameters['method'] === '__invoke' ? $name : ($name . ucfirst($parameters['method']));
            }

            $this->generateFile(
                app_path('Http/Responses/Api/' . $prefix . 'Resolver.php'),
                $this->makeStub('resolver', [
                    '{{name}}' => $prefix . 'Resolver',
                    '@use' => '',
                ]),
                replace: false,
            );

            $uses[] = 'use App\\Http\\Responses\\Api\\' . $prefix . 'Resolver;';

            $this->generateFile(
                app_path('Http/Responses/Api/' . $prefix . 'Responder.php'),
                $this->makeStub('responder', [
                    '{{name}}' => $prefix . 'Responder',
                    '{{resolver}}' => $prefix . 'Resolver',
                    '@use' => 'use App\\Http\\Responses\\Api\\' . $prefix . 'Resolver;',
                ]),
                replace: false,
            );

            $uses[] = 'use App\\Http\\Responses\\Api\\' . $prefix . 'Responder;';

            if ($parameters['withFormRequest']) {
                $this->generateFile(
                    app_path('Dto/' . $prefix . 'Dto.php'),
                    $this->makeStub('dto', [
                        '{{name}}' => $prefix . 'Dto',
                        '{{namespace}}' => 'App\\Dto',
                        '@use' => '',
                    ]),
                    replace: false,
                );

                $this->generateFile(
                    app_path('Http/Requests/Api/' . $prefix . 'FormRequest.php'),
                    $this->makeStub('form_request', [
                        '{{name}}' => $prefix . 'FormRequest',
                        '{{dto}}' => $prefix . 'Dto',
                        '@use' => 'use App\\Dto\\' . $prefix . 'Dto;',
                    ]),
                    replace: false,
                );

                $uses[] = 'use App\\Http\\Requests\\Api\\' . $prefix . 'FormRequest;';
            }


            $methodStub = $parameters['withFormRequest'] ? 'method_with_form_request' : 'method_with_parameters';
            $methods[$parameters['method']] = $this->makeStub($methodStub, [
                '{{name}}' => $parameters['method'],
                '{{form-request}}' => $prefix . 'FormRequest',
                '{{resolver}}' => $prefix . 'Resolver',
                '{{responder}}' => $prefix . 'Responder',
                '{{parameters}}' => $parameters['parameters'] !== []
                    ? 'string $' . implode(',string $', $parameters['parameters']) . ','
                    : '',
                '{{with-parameters}}' => $parameters['parameters'] !== []
                    ? '$' . implode(',$', $parameters['parameters']) . ','
                    : '',
            ]);

            $routesUses[] = 'use App\\Http\\Controllers\\Api\\' . $parameters['name'] . 'Controller;';
        }

        $content = $this->makeStub('controller', [
            '@use' => implode(PHP_EOL, array_unique($uses)),
            '{{name}}' => $name . 'Controller',
            '{{methods}}' => implode(PHP_EOL, $methods),
        ]);

        $this->generateFile(
            app_path('Http/Controllers/Api/' . $name . 'Controller.php'),
            $content,
        );

        return [
            'uses' => array_unique($routesUses),
            'routes' => $routes,
        ];
    }
}
