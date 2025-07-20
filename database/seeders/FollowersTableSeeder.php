<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Deshabilitar las restricciones de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Insertar los datos de los seguidores
        DB::table('followers')->insert([
            [
                'id' => 186,
                'user_id' => 115,
                'seguido' => 111,
                'estado' => 'confirmado',
                'created_at' => Carbon::create('2024', '10', '02', '04', '50', '37'),
                'updated_at' => Carbon::create('2024', '11', '11', '20', '04', '18'),
            ],
            [
                'id' => 187,
                'user_id' => 112,
                'seguido' => 111,
                'estado' => 'desconocido',
                'created_at' => Carbon::create('2024', '10', '07', '03', '31', '10'),
                'updated_at' => Carbon::create('2024', '10', '14', '20', '53', '30'),
            ],
            [
                'id' => 188,
                'user_id' => 111,
                'seguido' => 112,
                'estado' => 'confirmado',
                'created_at' => Carbon::create('2024', '10', '22', '03', '08', '05'),
                'updated_at' => Carbon::create('2024', '10', '22', '03', '08', '20'),
            ],
            [
                'id' => 189,
                'user_id' => 115,
                'seguido' => 112,
                'estado' => 'confirmado',
                'created_at' => Carbon::create('2024', '10', '24', '17', '25', '29'),
                'updated_at' => Carbon::create('2024', '10', '24', '17', '26', '28'),
            ],
            [
                'id' => 190,
                'user_id' => 115,
                'seguido' => 113,
                'estado' => 'confirmado',
                'created_at' => Carbon::create('2024', '10', '24', '17', '25', '37'),
                'updated_at' => Carbon::create('2024', '10', '24', '17', '26', '49'),
            ],
            [
                'id' => 192,
                'user_id' => 111,
                'seguido' => 113,
                'estado' => 'confirmado',
                'created_at' => Carbon::create('2024', '11', '21', '20', '28', '38'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '28', '59'),
            ],
            [
                'id' => 193,
                'user_id' => 113,
                'seguido' => 112,
                'estado' => 'confirmado',
                'created_at' => Carbon::create('2024', '11', '21', '20', '29', '25'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '30', '01'),
            ],
        ]);

        // Volver a habilitar las restricciones de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
