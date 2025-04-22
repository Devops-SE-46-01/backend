<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            ['name' => 'admin'],
        ]);

        Permission::insert([
            ['name' => 'admin'],
            ['name' => 'role'],
            ['name' => 'blog'],
            ['name' => 'achievement'],
            ['name' => 'permission'],
        ]);
    }
}
