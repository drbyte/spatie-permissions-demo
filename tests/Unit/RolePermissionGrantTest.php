<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Tests\TestCase;

class RolePermissionGrantTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $permission = Permission::create(['name' => 'edit articles']);
        $role1 = Role::create(['name' => 'writer']);
        $role1->givePermissionTo($permission->name);
    }

    /**
     * @test
     */
    public function it_can_assign_a_role_and_confirm_the_role_is_assigned()
    {
        $user = User::factory()->create();
        $user->assignRole('writer');

        $freshUser = User::find($user->id);

        $this->assertTrue($freshUser->hasRole('writer'));
        $this->assertTrue($freshUser->hasPermissionTo('edit articles'));
        $this->assertTrue($freshUser->can('edit articles'));
    }
}
