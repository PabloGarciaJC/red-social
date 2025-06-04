<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'nombre' => 'admin',
                'descripcion' => 'Acceso completo al sistema',
            ],
            [
                'nombre' => 'moderador',
                'descripcion' => 'Puede gestionar publicaciones y usuarios',
            ],
            [
                'nombre' => 'usuario',
                'descripcion' => 'Permisos básicos de uso de la red social',
            ],
        ]);
    }
}
