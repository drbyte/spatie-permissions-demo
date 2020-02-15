<?php

namespace Tests\Feature;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MiddlewareTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function middleware_in_constructor_using_only()
    {
        $this->app->make(PermissionRegistrar::class)->forgetCachedPermissions();

        $permission = Permission::create(['name' => 'edit articles']);
        $role1 = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'writer']);
        $role1->givePermissionTo($permission);
        $role2->givePermissionTo($permission);

        $user = factory(\App\User::class)->create([
            'name' => 'Example User',
            'email' => 'test@example.com',
        ]);
        $user->assignRole($role2);

        $user = \App\User::first();
        $this->withoutExceptionHandling()->actingAs($user)->assertAuthenticated();

        $response = $this->get('/testmiddleware');

        $response->assertStatus(200);
    }
}
