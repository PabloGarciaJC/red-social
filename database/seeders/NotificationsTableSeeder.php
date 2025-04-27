<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NotificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notifications')->insert([
            [
                'id' => 'd730bff0-1bdc-44d9-b9e4-08cddd7c312f',
                'type' => 'App\\Notifications\\AgregarAmigoNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 113,
                'data' => json_encode([
                    'user_id' => 112,
                    'alias' => 'Sofía',
                    'fotoPerfil' => '17322194842.png',
                    'estado' => 'confirmado',
                    'messaje' => 'Acepto solicitud de amistad',
                ]),
                'read_at' => Carbon::create('2024', '11', '21', '20', '38', '56'),
                'created_at' => Carbon::create('2024', '11', '21', '20', '30', '01'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '38', '56'),
            ],
        ]);

    }
}
