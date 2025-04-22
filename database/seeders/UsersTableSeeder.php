<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $role = Role::findOrFail(1);

            DB::table('users')->insert([
                'name' => 'Indra Mahesa',
                'email' => 'indramahesa@student.telkomuniversity.ac.id',
                'password' => bcrypt('admin'),
                'role_id' => $role->id,
            ]);

            $permissions = Permission::get();

            foreach ($permissions as $permission) {
                $role->permissions()->attach($permission->id);
            }
        } catch (Exception $e) {
        }
    }
}
