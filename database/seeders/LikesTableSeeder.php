<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LikesTableSeeder extends Seeder
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

        DB::table('likes')->insert([
            [
                'id' => 413,
                'user_id' => 115,
                'publication_id' => 1126,
                'type' => 'like',
                'created_at' => Carbon::create('2024', '11', '21', '21', '20', '13'),
                'updated_at' => Carbon::create('2024', '11', '21', '21', '20', '13'),
            ],
            [
                'id' => 414,
                'user_id' => 115,
                'publication_id' => 1125,
                'type' => 'dislike',
                'created_at' => Carbon::create('2024', '11', '21', '21', '20', '17'),
                'updated_at' => Carbon::create('2024', '11', '21', '21', '20', '17'),
            ],
            [
                'id' => 415,
                'user_id' => 111,
                'publication_id' => 1128,
                'type' => 'like',
                'created_at' => Carbon::create('2024', '11', '21', '21', '20', '28'),
                'updated_at' => Carbon::create('2024', '11', '21', '21', '20', '28'),
            ],
            [
                'id' => 416,
                'user_id' => 111,
                'publication_id' => 1127,
                'type' => 'like',
                'created_at' => Carbon::create('2024', '11', '21', '21', '20', '31'),
                'updated_at' => Carbon::create('2024', '11', '21', '21', '20', '31'),
            ],
            [
                'id' => 417,
                'user_id' => 111,
                'publication_id' => 1126,
                'type' => 'dislike',
                'created_at' => Carbon::create('2024', '11', '21', '21', '20', '35'),
                'updated_at' => Carbon::create('2024', '11', '21', '21', '20', '35'),
            ],
            [
                'id' => 418,
                'user_id' => 111,
                'publication_id' => 1125,
                'type' => 'like',
                'created_at' => Carbon::create('2024', '11', '21', '21', '20', '38'),
                'updated_at' => Carbon::create('2024', '11', '21', '21', '20', '38'),
            ],
            [
                'id' => 419,
                'user_id' => 112,
                'publication_id' => 1128,
                'type' => 'dislike',
                'created_at' => Carbon::create('2024', '11', '21', '21', '20', '50'),
                'updated_at' => Carbon::create('2024', '11', '21', '21', '20', '50'),
            ],
            [
                'id' => 420,
                'user_id' => 112,
                'publication_id' => 1127,
                'type' => 'like',
                'created_at' => Carbon::create('2024', '11', '21', '21', '20', '56'),
                'updated_at' => Carbon::create('2024', '11', '21', '21', '20', '56'),
            ],
            [
                'id' => 421,
                'user_id' => 112,
                'publication_id' => 1126,
                'type' => 'dislike',
                'created_at' => Carbon::create('2024', '11', '21', '21', '21', '00'),
                'updated_at' => Carbon::create('2024', '11', '21', '21', '21', '00'),
            ],
            [
                'id' => 422,
                'user_id' => 112,
                'publication_id' => 1125,
                'type' => 'like',
                'created_at' => Carbon::create('2024', '11', '21', '21', '21', '03'),
                'updated_at' => Carbon::create('2024', '11', '21', '21', '21', '03'),
            ],
            [
                'id' => 423,
                'user_id' => 115,
                'publication_id' => 1128,
                'type' => 'like',
                'created_at' => Carbon::create('2024', '11', '21', '21', '21', '15'),
                'updated_at' => Carbon::create('2024', '11', '21', '21', '21', '15'),
            ],
            [
                'id' => 424,
                'user_id' => 115,
                'publication_id' => 1127,
                'type' => 'dislike',
                'created_at' => Carbon::create('2024', '11', '21', '21', '21', '22'),
                'updated_at' => Carbon::create('2024', '11', '21', '21', '21', '22'),
            ],
            [
                'id' => 425,
                'user_id' => 113,
                'publication_id' => 1128,
                'type' => 'like',
                'created_at' => Carbon::create('2024', '11', '21', '21', '21', '56'),
                'updated_at' => Carbon::create('2024', '11', '21', '21', '21', '56'),
            ],
            [
                'id' => 426,
                'user_id' => 113,
                'publication_id' => 1127,
                'type' => 'dislike',
                'created_at' => Carbon::create('2024', '11', '21', '21', '21', '59'),
                'updated_at' => Carbon::create('2024', '11', '21', '21', '21', '59'),
            ],
            [
                'id' => 427,
                'user_id' => 113,
                'publication_id' => 1126,
                'type' => 'like',
                'created_at' => Carbon::create('2024', '11', '21', '21', '22', '02'),
                'updated_at' => Carbon::create('2024', '11', '21', '21', '22', '02'),
            ],
            [
                'id' => 428,
                'user_id' => 113,
                'publication_id' => 1125,
                'type' => 'dislike',
                'created_at' => Carbon::create('2024', '11', '21', '21', '22', '06'),
                'updated_at' => Carbon::create('2024', '11', '21', '21', '22', '06'),
            ],
        ]);

        // Volver a habilitar las restricciones de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
