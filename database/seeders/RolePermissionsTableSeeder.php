<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionsTableSeeder extends Seeder
{
    public function run()
    {


        DB::table('role_permissions')->insert([
            ['id' => 1, 'role_id' => 1, 'permission_id' => 1],
            ['id' => 2, 'role_id' => 1, 'permission_id' => 2],
            ['id' => 3, 'role_id' => 1, 'permission_id' => 3],
            ['id' => 4, 'role_id' => 1, 'permission_id' => 4],
            ['id' => 5, 'role_id' => 1, 'permission_id' => 5],
            ['id' => 6, 'role_id' => 1, 'permission_id' => 6],
            ['id' => 7, 'role_id' => 2, 'permission_id' => 1],
            ['id' => 8, 'role_id' => 2, 'permission_id' => 2],
            ['id' => 9, 'role_id' => 2, 'permission_id' => 3],
            ['id' => 10, 'role_id' => 2, 'permission_id' => 4],
            ['id' => 11, 'role_id' => 3, 'permission_id' => 1],
            ['id' => 12, 'role_id' => 3, 'permission_id' => 2],
        ]);
    }
}
