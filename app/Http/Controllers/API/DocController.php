<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\JsonResponse;

class DocController extends Controller
{
    public function showDocV1(): Factory|View|Application
    {
        return view('content.api.docs');
    }

    public function contentV1(): JsonResponse
    {
        return new JsonResponse(
            data: File::get(resource_path('openapi/v1_bundle.yaml')),
            json: true,
        );
//        return Response::file(resource_path("openapi/v1.yaml"), [
//            'Content-Type' => 'text/yaml',
//        ]);
    }
}
