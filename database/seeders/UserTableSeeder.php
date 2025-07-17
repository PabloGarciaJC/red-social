<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 111,
                'alias' => 'Liam',
                'nombre' => 'Liam',
                'apellido' => 'Keller',
                'pais' => 'España',
                'direccion' => 'Berliner Strasse 89, Múnich, Alemania',
                'empresa' => 'Horizon Biotech',
                'cargo' => 'Director de Operaciones Internacionales',
                'movil' => '+49 171 654 3210',
                'email' => 'liam@user.com',
                'fotoPerfil' => '17322193751.png',
                'password' => '$2y$10$yV4bfuX1TFzE7v6OAtC9i.mVhy0dsZxIIbyOo3vj7aDTjy1BHaQAG',
                'sobreMi' => 'Con una experiencia de más de 15 años en logística y operaciones, mi enfoque principal es optimizar procesos globales. En mi tiempo libre, disfruto correr maratones y leer sobre historia contemporánea.',
                'conectado' => 1,
                'role_id' => 3,
                'remember_token' => NULL,
                'created_at' => '2024-09-01 18:43:08',
                'updated_at' => '2024-11-27 19:13:28',
            ],
            [
                'id' => 112,
                'alias' => 'Sofía',
                'nombre' => 'Sofía',
                'apellido' => 'Nakamura',
                'pais' => 'Japón',
                'direccion' => '3-2-1 Shinjuku, Tokio, Japón',
                'empresa' => 'Akira Designs',
                'cargo' => 'Diseñadora Jefe de Producto',
                'movil' => '+81 90 1234 5678',
                'email' => 'sofia@user.com',
                'fotoPerfil' => '17322194842.png',
                'password' => '$2y$10$X/fCuCvm8QNR9fSCtWuXLuPtrHntbge.6X5p9bG43CAyh2UFYZmZO',
                'sobreMi' => 'Diseñadora con enfoque en la sostenibilidad, creo productos funcionales y amigables con el medio ambiente. Soy amante de la música clásica y el arte contemporáneo.',
                'conectado' => 0,
                'role_id' => 3,
                'remember_token' => NULL,
                'created_at' => '2024-09-01 18:45:00',
                'updated_at' => '2024-11-26 21:28:07',
            ],
            [
                'id' => 113,
                'alias' => 'Marco',
                'nombre' => 'Marco',
                'apellido' => 'Santis',
                'pais' => 'Italia',
                'direccion' => 'Via Roma 18, Milán, Italia',
                'empresa' => 'Verde Vita Consultores',
                'cargo' => 'Consultor Ambiental Senior',
                'movil' => '+39 345 678 9012',
                'email' => 'marco@user.com',
                'fotoPerfil' => '17322195963.png',
                'password' => '$2y$10$bTlrYZCshMpdY9Uxn4XQkemMv2nYN8UTBp3j8HCKhX629.d/j83tu',
                'sobreMi' => 'Mi misión es asesorar a empresas para que reduzcan su huella de carbono y adopten estrategias ecológicas. Amante de la naturaleza, suelo dedicar mi tiempo libre a la fotografía de paisajes.',
                'conectado' => 0,
                'role_id' => 3,
                'remember_token' => NULL,
                'created_at' => '2024-09-01 18:46:29',
                'updated_at' => '2024-11-27 14:35:24',
            ],
            [
                'id' => 115,
                'alias' => 'Emilia',
                'nombre' => 'Emilia',
                'apellido' => 'Fuentes',
                'pais' => 'Colombia',
                'direccion' => 'Carrera 45 #12-34, Bogotá, Colombia',
                'empresa' => 'NovaGenix Solutions',
                'cargo' => 'Gerente de Innovación',
                'movil' => '+57 312 456 7890',
                'email' => 'emilia@user.com',
                'fotoPerfil' => '17322192474.png',
                'password' => '$2y$10$DNDuHiKvxpq/JyBkx4Nq/OWx0SSlkYSMep3ATgzv54wXDkVnPc4Yu',
                'sobreMi' => 'Apasionada por la tecnología y las soluciones disruptivas, lidero equipos para crear productos innovadores que transforman vidas. Fuera del trabajo, disfruto explorar nuevos destinos y aprender sobre diferentes culturas.',
                'conectado' => 0,
                'role_id' => 3,
                'remember_token' => NULL,
                'created_at' => '2024-09-18 00:59:26',
                'updated_at' => '2024-11-21 21:21:28',
            ],
            [
                'id' => 116,
                'alias' => 'superadmin',
                'nombre' => 'superadmin',
                'apellido' => 'superadmin',
                'pais' => 'España',
                'direccion' => 'Carrera 45 #12-34, Bogotá, Colombia',
                'empresa' => 'NovaGenix Solutions',
                'cargo' => 'Gerente de Innovación',
                'movil' => '+57 312 456 7890',
                'email' => 'superadmin@superadmin.com',
                'fotoPerfil' => '17322192474.png',
                'password' => '$2y$10$rReNYnNwSbLyWjsM8f9pf.w6xf9YXuPJOoJy1uVShqcgSkQeNrMTq',
                'sobreMi' => 'Como superusuario, administro y superviso todos los aspectos del sistema para garantizar su correcto funcionamiento y seguridad. Apasionado por la tecnología y el liderazgo, trabajo para impulsar la innovación y apoyar a todos los usuarios en su crecimiento.',
                'conectado' => 0,
                'role_id' => 1,
                'remember_token' => NULL,
                'created_at' => '2024-09-18 00:59:26',
                'updated_at' => '2024-11-21 21:21:28',
            ],
        ]);
    }
}
