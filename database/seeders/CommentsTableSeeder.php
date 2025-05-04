<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CommentsTableSeeder extends Seeder
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

        DB::table('comments')->insert([
            [
                'id' => 1076,
                'user_id' => 115,
                'publication_id' => 1128,
                'contenido' => 'Nada como un buen libro para desconectar y a la vez nutrir la mente. ¿Recomendarías algo relacionado con liderazgo?',
                'created_at' => Carbon::create('2024', '11', '21', '20', '40', '35'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '44', '50'),
            ],
            [
                'id' => 1078,
                'user_id' => 112,
                'publication_id' => 1128,
                'contenido' => 'Qué buen hábito, Marco. Leer en un entorno tranquilo siempre dispara mi creatividad. ¿Prefieres ficción o no ficción?',
                'created_at' => Carbon::create('2024', '11', '21', '20', '45', '22'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '45', '22'),
            ],
            [
                'id' => 1079,
                'user_id' => 111,
                'publication_id' => 1128,
                'contenido' => '😎 Gracias a todos por sus comentarios. Estoy leyendo \'La vida secreta de los árboles\' de Peter Wohlleben, un libro fascinante que conecta con mi amor por la naturaleza. También me encanta explorar temas de liderazgo y sostenibilidad, así que \'El líder que no tenía cargo\' es una gran recomendación que podría interesarles.',
                'created_at' => Carbon::create('2024', '11', '21', '20', '46', '09'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '46', '24'),
            ],
            [
                'id' => 1080,
                'user_id' => 111,
                'publication_id' => 1127,
                'contenido' => '¡Qué buena idea, Sofía! Creo que cambiar de entorno puede ser la clave para desbloquear la creatividad. ¿Tienes un lugar favorito para hacer picnics?',
                'created_at' => Carbon::create('2024', '11', '21', '20', '49', '08'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '49', '08'),
            ],
            [
                'id' => 1081,
                'user_id' => 113,
                'publication_id' => 1127,
                'contenido' => 'Totalmente de acuerdo, Sofía. Estar en contacto con la naturaleza siempre ayuda a aclarar la mente. ¿Qué sueles llevar para esos momentos al aire libre?',
                'created_at' => Carbon::create('2024', '11', '21', '20', '49', '32'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '49', '32'),
            ],
            [
                'id' => 1082,
                'user_id' => 115,
                'publication_id' => 1127,
                'contenido' => 'Me encanta este enfoque, Sofía. La combinación de aire fresco y un espacio tranquilo suena perfecta para nuevas ideas. ¿Lo haces a menudo?',
                'created_at' => Carbon::create('2024', '11', '21', '20', '49', '55'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '49', '55'),
            ],
            [
                'id' => 1083,
                'user_id' => 112,
                'publication_id' => 1127,
                'contenido' => '¡Gracias a todos! Estoy convencida de que la naturaleza nos inspira de maneras únicas. Liam, suelo ir a un parque cerca de casa, lleno de cerezos. Marco, siempre llevo un cuaderno y bocadillos caseros; es mi ritual creativo. Emilia, trato de hacerlo al menos una vez al mes. ¡Deberíamos intentar una sesión creativa grupal al aire libre algún día!',
                'created_at' => Carbon::create('2024', '11', '21', '20', '50', '18'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '50', '18'),
            ],
            [
                'id' => 1084,
                'user_id' => 113,
                'publication_id' => 1126,
                'contenido' => '¡Qué gran punto, Liam! La música tiene ese poder de enfocarnos y ayudarnos a pensar de manera más clara. ¿Tienes alguna canción o género específico que te inspire cuando tomas decisiones importantes?',
                'created_at' => Carbon::create('2024', '11', '21', '20', '51', '59'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '51', '59'),
            ],
            [
                'id' => 1085,
                'user_id' => 115,
                'publication_id' => 1126,
                'contenido' => 'Totalmente de acuerdo, Liam. La música tiene una forma única de crear el ambiente adecuado para la creatividad. ¿Prefieres algo tranquilo o más energético para esos momentos clave?',
                'created_at' => Carbon::create('2024', '11', '21', '20', '52', '34'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '52', '34'),
            ],
            [
                'id' => 1086,
                'user_id' => 112,
                'publication_id' => 1126,
                'contenido' => '¡Me encanta! La música realmente puede hacer que nuestras ideas fluyan mejor. ¿Tienes alguna playlist favorita para la toma de decisiones estratégicas?',
                'created_at' => Carbon::create('2024', '11', '21', '20', '52', '58'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '52', '58'),
            ],
            [
                'id' => 1087,
                'user_id' => 111,
                'publication_id' => 1126,
                'contenido' => 'Gracias a todos por sus comentarios. Personalmente, me inclino por música instrumental cuando necesito concentración, algo como piano o electrónica suave. Marco, me encanta el jazz para los momentos de reflexión profunda. Emilia, varío entre géneros dependiendo de la tarea, aunque generalmente prefiero algo tranquilo para tomar decisiones clave. Sofía, tengo varias listas de reproducción, pero si les interesa, puedo compartir una de mis favoritas para inspirar creatividad.',
                'created_at' => Carbon::create('2024', '11', '21', '20', '53', '25'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '53', '25'),
            ],
            [
                'id' => 1088,
                'user_id' => 111,
                'publication_id' => 1125,
                'contenido' => 'Totalmente de acuerdo, Emilia. Meditar puede ser el ancla que necesitamos en momentos de alta presión. ¿Tienes alguna técnica o rutina específica que sigas?',
                'created_at' => Carbon::create('2024', '11', '21', '20', '54', '41'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '54', '41'),
            ],
            [
                'id' => 1089,
                'user_id' => 113,
                'publication_id' => 1125,
                'contenido' => '¡Qué interesante, Emilia! La meditación siempre ha sido un desafío para mí, pero sé que es fundamental para la claridad mental. ¿Cuánto tiempo sueles dedicarle a tu práctica diaria?',
                'created_at' => Carbon::create('2024', '11', '21', '20', '54', '59'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '54', '59'),
            ],
            [
                'id' => 1090,
                'user_id' => 112,
                'publication_id' => 1125,
                'contenido' => '¡Qué bien dicho, Emilia! Encontrar espacio para la calma en medio del caos es esencial. ¿Usas alguna aplicación o prefieres meditar de forma libre?',
                'created_at' => Carbon::create('2024', '11', '21', '20', '55', '20'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '55', '20'),
            ],
            [
                'id' => 1091,
                'user_id' => 115,
                'publication_id' => 1125,
                'contenido' => 'Gracias a todos por sus comentarios. Liam, suelo meditar en silencio por la mañana, solo unos 10-15 minutos para empezar el día con claridad. Marco, no hace falta mucho tiempo, lo importante es hacerlo con constancia. Sofía, prefiero meditar libremente, sin ninguna aplicación, solo centrándome en la respiración. ¡Me encantaría saber cómo cada uno de ustedes maneja el estrés y se enfoca en lo importante!',
                'created_at' => Carbon::create('2024', '11', '21', '20', '55', '42'),
                'updated_at' => Carbon::create('2024', '11', '21', '20', '55', '42'),
            ],
        ]);

        // Volver a habilitar las restricciones de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
