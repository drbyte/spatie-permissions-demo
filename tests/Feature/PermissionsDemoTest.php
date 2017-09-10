<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PermissionsDemoTest extends TestCase
{
    /**
     * @test
     */
    public function it_recognizes_blade_hasrole_directive()
    {
        $response = $this->get('/');

        $response->assertSeeText('writer');
        $response->assertDontSeeText('@hasrole');
    }

    /**
     * @test
     */
    public function it_shows_message_confirming_permission_is_not_granted()
    {
        $response = $this->get('/');

        $response->assertSeeText('Sorry, you may NOT edit articles.');
    }

    /**
     * @test
     */
    public function it_shows_message_confirming_permission_is_granted()
    {
        $response = $this->actingAs(\App\User::find(1))->get('/');

        $response->assertSeeText("You have permission to 'edit articles'.");
        $response->assertDontSeeText('@hasrole');
    }

}
