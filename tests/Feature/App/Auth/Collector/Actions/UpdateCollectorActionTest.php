<?php

namespace App\Auth\Collector\Actions;

use App\Http\Requests\Auth\Admin\CreateCollectorRequest;
use App\Jobs\GenerateSmallThumbnailsJob;
use App\Jobs\GenerateThumbnailJob;
use Database\Seeders\PermissionsTestSeeder;
use Domain\Auth\Actions\CreateCollectorAction;
use Domain\Auth\Actions\UpdateCollectorAction;
use Domain\Auth\DTOs\NewCollectorDTO;
use Domain\Auth\DTOs\UpdateCollectorDTO;
use Domain\Auth\Models\Collector;
use Domain\Auth\Models\Permission;
use Domain\Auth\Models\Role;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UpdateCollectorActionTest extends TestCase
{
    use RefreshDatabase;

    protected array $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = CreateCollectorRequest::factory()->create();

        Role::create([
            'name' => config('settings.default_collector_role'),
            'display_name' => 'collector',
            'guard_name' => 'collector'
        ]);

        $this->withoutExceptionHandling();
    }

    public function test_collector_created_success(): void
    {
        Queue::fake();
        Storage::fake('images');
        Event::fake([
            Verified::class
        ]);

        $createAction = app(CreateCollectorAction::class);

        $createAction(NewCollectorDTO::make(
            $this->request['name'],
            $this->request['email'],
            $this->request['password'],
            $this->request['language'],
            $this->request['roles'],
            $this->request['first_name'],
            $this->request['slug'],
            $this->request['description'],
            null,
            null,
        ));

        $collector = Collector::where('email', $this->request['email'])->first();

        $this->artisan('db:seed', ['--class' => PermissionsTestSeeder::class]);

        Permission::create(['name' => 'test', 'display_name' => 'Test', 'guard_name' => 'collector']);
        Permission::create(['name' => 'entity.*', 'display_name' => 'Entity', 'guard_name' => 'collector']);
        Role::create(['name' => 'superadmin', 'display_name' => 'Super Admin', 'guard_name' => 'collector']);
        $role = Role::where('name', config('settings.default_collector_role'))->first();
        $role->givePermissionTo('entity.*');

        $updateAction = app(UpdateCollectorAction::class);

        $updateAction(UpdateCollectorDTO::make(
            'newName',
            'newEmail@email.com',
            $this->request['language'],
            ['collector', 'superadmin'],
            ['test'],
            $this->request['password'],
            $this->request['first_name'],
            $this->request['slug'],
            $this->request['description'],
            UploadedFile::fake()->image('photo2.doc'),
            null,
            $this->request['is_verified'],
        ), $collector);

        $this->assertDatabaseHas('collectors', [
            'email' => 'newEmail@email.com',
        ]);

        $updatedCollector = Collector::where('email', 'newEmail@email.com')->first();

        $this->assertTrue($updatedCollector->hasAllPermissions(['entity.edit', 'entity.delete', 'test']));
        $this->assertTrue($updatedCollector->hasAllRoles([config('settings.default_collector_role'), 'superadmin']));
        $this->assertFalse($updatedCollector->hasRole('editor'));

        Queue::assertPushed(GenerateThumbnailJob::class, 3);
        Queue::assertPushed(GenerateSmallThumbnailsJob::class, 2);

        Event::assertDispatched(Verified::class);
    }

    //    TODO test exception without HTTP
}
