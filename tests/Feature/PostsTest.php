<?php

namespace Tests\Feature;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use RefreshDatabase;

    protected $author, $admin;

    public function setUp(): void
    {
        parent::setUp();

        $this->setupPermissions();

        $this->member = factory(\App\User::class)->create();

        $this->author = factory(\App\User::class)->create();
        $this->author->assignRole('author');

        $this->admin = factory(\App\User::class)->create();
        $this->admin->assignRole('admin');

        $this->setupPosts();
    }

    protected function setupPermissions()
    {
        Permission::findOrCreate('view unpublished posts');
        Permission::findOrCreate('create posts');
        Permission::findOrCreate('edit own posts');
        Permission::findOrCreate('edit all posts');
        Permission::findOrCreate('delete own posts');
        Permission::findOrCreate('delete any post');

        Role::findOrCreate('author')
            ->givePermissionTo(['create posts', 'edit own posts', 'delete own posts']);

        Role::findOrCreate('admin')
            ->givePermissionTo(['view unpublished posts', 'create posts', 'edit all posts', 'delete any post']);

        $this->app->make(PermissionRegistrar::class)->registerPermissions();
    }

    protected function setupPosts()
    {
        \DB::table('posts')->truncate();

        factory(\App\Post::class)->create([
            'title' => 'This is the first post. (author)',
            'published' => 1,
            'user_id' => $this->author->id,
        ]);

        factory(\App\Post::class)->create([
            'title' => 'This is the second post. (admin)',
            'published' => 1,
            'user_id' => $this->admin->id,
        ]);

        factory(\App\Post::class)->create([
            'title' => 'This is the third post. (author)',
            'published' => 1,
            'user_id' => $this->author->id,
        ]);

        factory(\App\Post::class)->create([
            'title' => 'This is the fourth post. (admin, unpublished)',
            'published' => 0,
            'user_id' => $this->admin->id,
        ]);

        factory(\App\Post::class)->create([
            'title' => 'This is the fifth post. (member)',
            'published' => 1,
            'user_id' => $this->member->id,
        ]);
    }

    /** @test */
    public function visitors_can_view_posts_index()
    {
        $this->withoutExceptionHandling();

        $this->setupPosts();

        $response = $this->get('/post');

        $response->assertStatus(200);

        $response->assertSee('first post.');
        $response->assertSee('second post.');
    }

    /** @test */
    public function members_can_view_specific_published_post()
    {
        $this->withoutExceptionHandling();

        $this->setupPosts();

        $response = $this
            ->actingAs($this->member)
            ->get('/post/1');

        $response->assertStatus(200);

        $response->assertSee('first post.');
    }

    /** @test */
    public function members_cannot_see_unpublished_posts()
    {
        $this->setupPosts();

        $response = $this
            ->actingAs($this->member)
            ->get('/post/4');

        $response->assertStatus(403);
    }


    /** @test */
    public function authors_can_view_posts()
    {
        $this->withoutExceptionHandling();

        $this->setupPosts();

        $response = $this
            ->actingAs($this->author)
            ->get('/post/1');

        $response->assertStatus(200);
        $response->assertSee('first post.');
    }

    /** @test */
    public function authors_can_edit_own_posts()
    {
        $this->withoutExceptionHandling();

        $this->setupPosts();

        $response = $this
            ->actingAs($this->author)
            ->get('/post/1/edit');

        $response->assertStatus(200);
        $response->assertSee('first post.');
    }

    /** @test */
    public function admins_can_edit_others_posts()
    {
        $this->withoutExceptionHandling();

        $this->setupPosts();

        $response = $this
            ->actingAs($this->admin)
            ->get('/post/5/edit');

        $response->assertStatus(200);
        $response->assertSee('fifth post.');
    }

    /** @test */
    public function members_cannot_delete_posts()
    {
        $this->withoutExceptionHandling();

        $this->setupPosts();

        $this->expectException(\Illuminate\Auth\Access\AuthorizationException::class);

        $response = $this
            ->actingAs($this->member)
            ->delete('/post/1');

        $response->assertStatus(403);
    }

    /** @test */
    public function authors_can_delete_own_posts()
    {
        $this->setupPosts();
        $this->withoutExceptionHandling();

        $response = $this
            ->actingAs($this->author)
            ->delete('/post/1');

        $response->assertStatus(302);
        $response->assertDontSee('first post.');
    }

    /** @test */
    public function admins_can_delete_posts()
    {
        $this->setupPosts();

        $response = $this
            ->actingAs($this->admin)
            ->delete('/post/1');

        $response->assertStatus(302);
        $response->assertDontSee('first post.');
    }

}
