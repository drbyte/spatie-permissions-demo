<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExamplesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_responds_to_show_my_roles()
    {
        $this->artisan('db:seed');

        $user = \App\User::find(1);
        $this->actingAs($user)->assertAuthenticated();

        $response = $this->get('/my_roles');

        $response->assertStatus(200);
        $response->assertSee('Collection');
        $response->assertSee('writer');
    }
}
