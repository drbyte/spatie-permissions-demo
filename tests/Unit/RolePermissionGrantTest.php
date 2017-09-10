<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RolePermissionGrantTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * @test
     */
    public function it_can_assign_a_role_and_confirm_the_role_is_assigned()
    {
        $user = Factory(User::class)->create();
        $user->assignRole('writer');

        $freshUser = User::find($user->id);

        $this->assertTrue($freshUser->hasRole('writer'));
        $this->assertTrue($freshUser->hasPermissionTo('edit articles'));
        $this->assertTrue($freshUser->can('edit articles'));
    }
}
