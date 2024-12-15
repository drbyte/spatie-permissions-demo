<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsDemoSeeder extends Seeder
{
    /**
     * Create some roles and permissions.

     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);
        Permission::create(['name' => 'publish articles']);
        Permission::create(['name' => 'unpublish articles']);
        Permission::create(['name' => 'delete own articles']);
        // For Super Admin
        Permission::create(['name' => 'assign roles']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'Writer']);
        $role1->givePermissionTo('edit articles');
        $role1->givePermissionTo('delete articles');

        $role2 = Role::create(['name' => 'Admin']);
        $role2->givePermissionTo('publish articles');
        $role2->givePermissionTo('unpublish articles');
        $role2->givePermissionTo('delete own articles');

        // create a demo user
        $user = \App\Models\User::factory()->create([
            'name' => 'Example User',
            'email' => 'test@example.com',
        ]);
        $user->assignRole($role1);


        // super admin
        $role3 = Role::create(['name' => 'Super-Admin']);
        $role3->givePermissionTo('assign roles');
        $admin = \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);
        $admin->assignRole('Super-Admin');

        # Assign some random posts that are published
        for($i = 0; $i < 15; $i++) {
            $posts = \App\Models\Post::factory()->create([
                                                              'title' => fake()->sentence(),
                                                              'user_id' => random_int(1, 2),
                                                              'body' => fake()->realText(),
                                                              'published' => '1',
                                                          ]);
        }

        # Assign some random posts that are unpublished
        for($i = 0; $i < 15; $i++) {
            $posts = \App\Models\Post::factory()->create([
                                                             'title' => fake()->sentence(),
                                                             'user_id' => random_int(1, 2),
                                                             'body' => fake()->realText(),
                                                             'published' => '',
                                                         ]);
        }
    }
}
