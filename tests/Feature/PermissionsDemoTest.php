<?php

namespace Tests\Feature;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PermissionsDemoTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $permission = Permission::create(['name' => 'edit all posts']);
        $role1 = Role::create(['name' => 'admin']);
        $role1->givePermissionTo($permission->name);
    }

    /**
     * @test
     */
    public function it_recognizes_blade_hasrole_directive()
    {
        $response = $this->get('/');

        $response->assertSeeText('admin');
        $response->assertDontSeeText('@hasrole');
    }

    /**
     * @test
     */
    public function it_shows_message_confirming_permission_is_not_granted()
    {
        $response = $this->get('/');

        $response->assertSeeText('Sorry, you may NOT edit [edit all posts]');
    }

    /**
     * @test
     */
    public function it_shows_message_confirming_permission_is_granted()
    {
        $user = \App\Models\User::factory()->create();
        $user->assignRole('admin');

        $response = $this->actingAs(\App\Models\User::find($user->id))->get('/');

        $response->assertDontSeeText('@hasrole');

        $response->assertSeeText("You have permission to [edit all posts].");
    }

}
