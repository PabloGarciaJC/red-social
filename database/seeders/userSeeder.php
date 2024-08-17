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
        for ($i = 0; $i <= 6; $i++) {
            \DB::table('users')->insert(array(
                'alias' => 'administrador' . $i,
                'nombre' => 'administrador' . $i,
                'apellido' => 'administrador' . $i,
                'pais' => 'Lorem Ipsum' . $i,
                'direccion' => 'Lorem Ipsum' . $i,
                'empresa' => 'Lorem Ipsum' . $i,
                'cargo' => 'Lorem Ipsum' . $i,
                'movil' => '(+58) 12345612' . $i,
                'email' => 'administrador'.$i. '@administrador.com',
                'fotoPerfil' => 'profile' . $i . '.png',
                'password' => Hash::make('administrador') . $i,
                'sobreMi' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since th Lorem Ipsum has been the industry s standard dummy text ever since th' . $i,
                'conectado' => 0
            ));
        };
        $this->command->info('La Tabla de user Ha sido Rellenada');
    }
}
