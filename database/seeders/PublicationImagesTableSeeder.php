<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PublicationImagesTableSeeder extends Seeder
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

        DB::table('publication_images')->insert([
            [
                'id' => 1054,
                'publication_id' => 1125,
                'image_path' => '1732219795_imagen_3.jpg',
                'created_at' => Carbon::create('2024', '11', '21', '20', '09', '55'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '09', '55'),
            ],
            [
                'id' => 1055,
                'publication_id' => 1125,
                'image_path' => '1732219795_imagen_1.jpg',
                'created_at' => Carbon::create('2024', '11', '21', '20', '09', '55'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '09', '55'),
            ],
            [
                'id' => 1056,
                'publication_id' => 1125,
                'image_path' => '1732219795_imagen_0.jpg',
                'created_at' => Carbon::create('2024', '11', '21', '20', '09', '55'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '09', '55'),
            ],
            [
                'id' => 1057,
                'publication_id' => 1125,
                'image_path' => '1732219795_imagen_2.jpg',
                'created_at' => Carbon::create('2024', '11', '21', '20', '09', '55'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '09', '55'),
            ],
            [
                'id' => 1058,
                'publication_id' => 1126,
                'image_path' => '1732219903_imagen_0.jpg',
                'created_at' => Carbon::create('2024', '11', '21', '20', '11', '44'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '11', '44'),
            ],
            [
                'id' => 1059,
                'publication_id' => 1126,
                'image_path' => '1732219904_imagen_1.jpg',
                'created_at' => Carbon::create('2024', '11', '21', '20', '11', '44'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '11', '44'),
            ],
            [
                'id' => 1060,
                'publication_id' => 1126,
                'image_path' => '1732219904_imagen_2.jpg',
                'created_at' => Carbon::create('2024', '11', '21', '20', '11', '44'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '11', '44'),
            ],
            [
                'id' => 1061,
                'publication_id' => 1126,
                'image_path' => '1732219904_imagen_3.jpg',
                'created_at' => Carbon::create('2024', '11', '21', '20', '11', '44'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '11', '44'),
            ],
            [
                'id' => 1062,
                'publication_id' => 1127,
                'image_path' => '1732220022_imagen_0.jpg',
                'created_at' => Carbon::create('2024', '11', '21', '20', '13', '42'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '13', '42'),
            ],
            [
                'id' => 1063,
                'publication_id' => 1127,
                'image_path' => '1732220022_imagen_1.jpg',
                'created_at' => Carbon::create('2024', '11', '21', '20', '13', '42'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '13', '42'),
            ],
            [
                'id' => 1064,
                'publication_id' => 1127,
                'image_path' => '1732220022_imagen_2.jpg',
                'created_at' => Carbon::create('2024', '11', '21', '20', '13', '42'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '13', '42'),
            ],
            [
                'id' => 1065,
                'publication_id' => 1128,
                'image_path' => '1732220106_imagen_0.jpg',
                'created_at' => Carbon::create('2024', '11', '21', '20', '15', '06'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '15', '06'),
            ],
            [
                'id' => 1066,
                'publication_id' => 1128,
                'image_path' => '1732220106_imagen_1.jpg',
                'created_at' => Carbon::create('2024', '11', '21', '20', '15', '06'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '15', '06'),
            ],
            [
                'id' => 1067,
                'publication_id' => 1128,
                'image_path' => '1732220106_imagen_2.jpg',
                'created_at' => Carbon::create('2024', '11', '21', '20', '15', '06'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '15', '06'),
            ],
            [
                'id' => 1068,
                'publication_id' => 1128,
                'image_path' => '1732220106_imagen_3.jpg',
                'created_at' => Carbon::create('2024', '11', '21', '20', '15', '06'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '15', '06'),
            ],
        ]);

        // Volver a habilitar las restricciones de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
