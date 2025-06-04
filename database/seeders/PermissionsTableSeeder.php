<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');  // Desactiva las restricciones FK
        DB::table('permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');  // Reactiva las restricciones FK

        DB::table('permissions')->insert([
            [
                'id' => 1,
                'nombre' => 'read',
                'descripcion' => 'Ver contenido',
            ],
            [
                'id' => 2,
                'nombre' => 'write',
                'descripcion' => 'Crear y modificar contenido',
            ],
            [
                'id' => 3,
                'nombre' => 'delete',
                'descripcion' => 'Eliminar contenido',
            ],
            [
                'id' => 4,
                'nombre' => 'ban',
                'descripcion' => 'Banear usuarios',
            ],
            [
                'id' => 5,
                'nombre' => 'manage_users',
                'descripcion' => 'Gestionar usuarios',
            ],
            [
                'id' => 6,
                'nombre' => 'manage_roles',
                'descripcion' => 'Gestionar roles y permisos',
            ],
        ]);
    }
}
