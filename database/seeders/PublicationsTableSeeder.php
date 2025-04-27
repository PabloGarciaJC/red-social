<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PublicationsTableSeeder extends Seeder
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

        DB::table('publications')->insert([
            [
                'id' => 1125,
                'user_id' => 115,
                'imagen' => null,
                'contenido' => 'Encontrando claridad en medio del caos: Meditar, un hábito clave para liderar con propósito.',
                'created_at' => Carbon::create('2024', '11', '21', '20', '08', '25'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '09', '55'),
            ],
            [
                'id' => 1126,
                'user_id' => 111,
                'imagen' => null,
                'contenido' => 'La música como inspiración: el ritmo perfecto para tomar decisiones estratégicas.',
                'created_at' => Carbon::create('2024', '11', '21', '20', '11', '43'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '11', '43'),
            ],
            [
                'id' => 1127,
                'user_id' => 112,
                'imagen' => null,
                'contenido' => 'Creatividad al aire libre: cómo un picnic puede renovar tus ideas.',
                'created_at' => Carbon::create('2024', '11', '21', '20', '13', '42'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '13', '42'),
            ],
            [
                'id' => 1128,
                'user_id' => 113,
                'imagen' => null,
                'contenido' => 'Entre páginas y paisajes: encontrando inspiración en la lectura.',
                'created_at' => Carbon::create('2024', '11', '21', '20', '15', '06'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '15', '06'),
            ],
        ]);

        // Volver a habilitar las restricciones de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
