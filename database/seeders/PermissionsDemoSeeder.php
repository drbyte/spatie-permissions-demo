<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsDemoSeeder extends Seeder
{
    protected User $author;
    protected User $admin;
    protected User $member;

    /**
     * Create some roles and permissions, users, posts

     */
    public function run(): void
    {

        $this->setupPermissions();
        $this->setupUsers();
        $this->setupPosts();

    }

    protected function setupPermissions(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

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
    }

    protected function setupUsers(): void
    {


        $this->author = User::factory()->create([
                                                    'name' => 'Example Author',
                                                    'email' => 'author@example.com',
                                                ]);
        $this->author->assignRole('author');

        $this->admin = User::factory()->create([
                                                   'name' => 'Admin User',
                                                   'email' => 'admin@example.com',
                                               ]);
        $this->admin->assignRole('admin');

        $this->member = User::factory()->create([
                                                    'name' => 'Example Member',
                                                    'email' => 'member@example.com',
                                                ]);
    }

    protected function setupPosts()
    {
        Post::factory()->create([
                                    'title' => 'This is the first post. (author)',
                                    'published' => 1,
                                    'user_id' => $this->author->id,
                                ]);

        Post::factory()->create([
                                    'title' => 'This is the second post. (admin)',
                                    'published' => 1,
                                    'user_id' => $this->admin->id,
                                ]);

        Post::factory()->create([
                                    'title' => 'This is the third post. (author)',
                                    'published' => 1,
                                    'user_id' => $this->author->id,
                                ]);

        Post::factory()->create([
                                    'title' => 'This is the fourth post. (admin, unpublished)',
                                    'published' => 0,
                                    'user_id' => $this->admin->id,
                                ]);

        Post::factory()->create([
                                    'title' => 'This is the fifth post. (member)',
                                    'published' => 1,
                                    'user_id' => $this->member->id,
                                ]);
    }
}
