<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Create some roles and users and permissions
     */
    public function run(): void
    {
         $this->call(PermissionsDemoSeeder::class);
    }
}
