<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i <= 2; $i++) {
            \DB::table('users')->insert(array(
                'alias' => 'user' . $i,
                'nombre' => 'user' . $i,
                'apellido' => 'user' . $i,
                'pais' => 'Lorem Ipsum' . $i,
                'direccion' => 'Lorem Ipsum' . $i,
                'empresa' => 'Lorem Ipsum' . $i,
                'cargo' => 'Lorem Ipsum' . $i,
                'movil' => '(+58) 12345612' . $i,
                'email' => 'user'.$i. '@user.com',
                'fotoPerfil' => 'profile' . $i . '.png',
                'password' => 'password',
                'sobreMi' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since th Lorem Ipsum has been the industry s standard dummy text ever since th' . $i,
                'conectado' => 0
            ));
        };
        $this->command->info('La Tabla de user Ha sido Rellenada');
    }
}
