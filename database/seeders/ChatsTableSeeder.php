<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chats')->insert([
            [
                'id' => 909,
                'emisor_id' => 111,
                'receptor_id' => 115,
                'message' => 'Hola Emilia, ¡es un placer verte por aquí! Me encanta tu publicación sobre meditar para encontrar claridad. Coincido totalmente, especialmente en momentos de caos. Yo también trato de incorporar momentos de silencio en mi día para mantener la mente enfocada. ¿Tienes algún consejo para quienes recién empezamos a meditar?',
                'created_at' => Carbon::create('2024', '11', '21', '21', '01', '08'),
                'updated_at' => Carbon::create('2024', '11', '21', '21', '02', '37'),
                'leido' => 1
            ],
            [
                'id' => 910,
                'emisor_id' => 111,
                'receptor_id' => 113,
                'message' => '¡Hola Marco! Vi tu publicación sobre libros, qué interesante. Estoy de acuerdo contigo, la lectura es un gran escape y una fuente de inspiración. ¿Te interesa algún género en particular? A mí me encanta leer sobre psicología y liderazgo',
                'created_at' => Carbon::create('2024', '11', '21', '21', '01', '28'),
                'updated_at' => Carbon::create('2024', '11', '21', '21', '03', '02'),
                'leido' => 1
            ],
            [
                'id' => 911,
                'emisor_id' => 111,
                'receptor_id' => 112,
                'message' => '¡Hola Sofía! Me encantó tu publicación sobre cómo un picnic puede renovar ideas. ¡Qué buen enfoque! Yo también creo que un cambio de entorno puede abrir la mente. ¿Tienes algún lugar favorito para esos momentos de desconexión?',
                'created_at' => Carbon::create('2024', '11', '21', '21', '01', '43'),
                'updated_at' => Carbon::create('2024', '11', '21', '21', '02', '08'),
                'leido' => 1
            ],
            [
                'id' => 912,
                'emisor_id' => 112,
                'receptor_id' => 111,
                'message' => '¡Hola Liam! Sí, a menudo voy a un pequeño parque cerca de mi casa. Es tranquilo y tiene mucha vegetación. Me ayuda a relajarme y pensar con claridad. ¿Tienes algún espacio que uses para desconectar del trabajo?',
                'created_at' => Carbon::create('2024', '11', '21', '21', '02', '11'),
                'updated_at' => Carbon::create('2024', '11', '21', '21', '03', '32'),
                'leido' => 1
            ],
            [
                'id' => 913,
                'emisor_id' => 115,
                'receptor_id' => 111,
                'message' => '¡Hola Liam! Qué bueno que te guste. Mi consejo es empezar con solo unos minutos al día. Lo importante es ser constante y no presionarte demasiado. Con el tiempo, verás los beneficios. ¿Y tú, alguna técnica que uses para calmar la mente?',
                'created_at' => Carbon::create('2024', '11', '21', '21', '02', '44'),
                'updated_at' => Carbon::create('2024', '11', '21', '21', '04', '26'),
                'leido' => 1
            ],
            [
                'id' => 914,
                'emisor_id' => 113,
                'receptor_id' => 111,
                'message' => '¡Hola Liam! Claro, la psicología es fascinante. Yo también disfruto de esos temas. Ahora estoy leyendo un libro sobre neurociencia aplicada a la toma de decisiones. ¿Algún libro en particular que me recomiendes sobre liderazgo?',
                'created_at' => Carbon::create('2024', '11', '21', '21', '03', '11'),
                'updated_at' => Carbon::create('2024', '11', '21', '21', '04', '01'),
                'leido' => 1
            ],
            [
                'id' => 915,
                'emisor_id' => 111,
                'receptor_id' => 112,
                'message' => '¡Hola Sofía! Me encantó tu publicación sobre los picnics. Es increíble cómo un cambio de ambiente puede realmente activar la creatividad. ¿Te ha sorprendido alguna vez una idea mientras estabas al aire libre? A veces, las mejores soluciones vienen cuando menos lo esperas.',
                'created_at' => Carbon::create('2024', '11', '21', '21', '03', '45'),
                'updated_at' => Carbon::create('2024', '11', '21', '21', '10', '35'),
                'leido' => 1
            ],
            [
                'id' => 916,
                'emisor_id' => 111,
                'receptor_id' => 113,
                'message' => '¡Hola Marco! Totalmente de acuerdo contigo, la lectura siempre es una excelente fuente de inspiración. Yo también soy un gran fan de los libros sobre psicología y liderazgo. Si te interesa, te puedo recomendar un libro que me ayudó mucho en ese ámbito, \'Los 7 hábitos de la gente altamente efectiva\' de Stephen Covey. ¿Lo has leído?',
                'created_at' => Carbon::create('2024', '11', '21', '21', '04', '10'),
                'updated_at' => Carbon::create('2024', '11', '21', '21', '12', '35'),
                'leido' => 1
            ],
            [
                'id' => 917,
                'emisor_id' => 111,
                'receptor_id' => 115,
                'message' => '¡Hola Emilia! Me encanta cómo hablas sobre meditar para encontrar claridad. Yo también he notado cómo momentos de silencio pueden realmente ayudar a alinear mis pensamientos. ¿Sueles meditar en la mañana o en la noche? Yo he probado ambas y me gusta cómo en la mañana establece el tono del día.',
                'created_at' => Carbon::create('2024', '11', '21', '21', '05', '42'),
                'updated_at' => Carbon::create('2024', '11', '21', '21', '13', '30'),
                'leido' => 1
            ],
            [
                'id' => 918,
                'emisor_id' => 112,
                'receptor_id' => 115,
                'message' => '¡Hola Emilia! Me encantó tu publicación sobre meditar. Yo también he encontrado que dedicar unos minutos al día para desconectar realmente ayuda a mantener el enfoque. ¿Tienes algún tipo de meditación guiada que uses? A veces me cuesta concentrarme solo en la respiración.',
                'created_at' => Carbon::create('2024', '11', '21', '21', '11', '21'),
                'updated_at' => Carbon::create('2024', '11', '21', '21', '13', '34'),
                'leido' => 1
            ],
            [
                'id' => 919,
                'emisor_id' => 112,
                'receptor_id' => 113,
                'message' => '¡Hola Marco! Estoy totalmente de acuerdo contigo, la lectura siempre tiene una manera de abrir la mente. También soy fan de los libros sobre desarrollo personal y liderazgo. Uno de mis favoritos es \'Despierta tu héroe interior\' de Victor Hugo Manzanilla. ¿Lo conoces?',
                'created_at' => Carbon::create('2024', '11', '21', '21', '11', '33'),
                'updated_at' => Carbon::create('2024', '11', '21', '21', '12', '41'),
                'leido' => 1
            ],
            [
                'id' => 920,
                'emisor_id' => 113,
                'receptor_id' => 112,
                'message' => '¡Hola Sofía! No conocía ese libro, pero suena interesante. Me encanta leer sobre cómo podemos desarrollar nuestro máximo potencial. Siempre estoy en busca de nuevas recomendaciones. Si te interesa, te puedo recomendar \'El poder de los hábitos\' de Charles Duhigg, ¡es uno de mis favoritos! ¿Tú qué tipo de libros prefieres, además de los de desarrollo personal?',
                'created_at' => Carbon::create('2024', '11', '21', '21', '13', '07'),
                'updated_at' => Carbon::create('2024', '11', '21', '21', '15', '33'),
                'leido' => 1
            ],
            [
                'id' => 921,
                'emisor_id' => 115,
                'receptor_id' => 112,
                'message' => '¡Hola Sofía! Gracias por tu comentario. A veces la meditación guiada también me ayuda, especialmente cuando quiero profundizar más en la práctica. Utilizo algunas apps como Headspace o Calm. Pero, en general, me gusta meditar en silencio para centrarme mejor. ¡Deberíamos hacer una sesión juntas algún día!',
                'created_at' => Carbon::create('2024', '11', '21', '21', '13', '55'),
                'updated_at' => Carbon::create('2024', '11', '21', '21', '15', '23'),
                'leido' => 1
            ],
            [
                'id' => 922,
                'emisor_id' => 113,
                'receptor_id' => 115,
                'message' => '¡Hola Emilia! Estaba pensando en lo que dijiste sobre meditar en la mañana para comenzar el día con claridad. ¡Qué buena idea! A veces me cuesta encontrar el tiempo para meditar, pero creo que voy a probar hacerlo por la mañana. ¿Tienes algún consejo para mantener la mente enfocada mientras meditas?',
                'created_at' => Carbon::create('2024', '11', '21', '21', '17', '32'),
                'updated_at' => Carbon::create('2024', '11', '21', '21', '17', '52'),
                'leido' => 1
            ],
            [
                'id' => 923,
                'emisor_id' => 115,
                'receptor_id' => 113,
                'message' => '¡Hola Marco! Me alegra que te guste la idea. Para mantener la mente enfocada, trato de no presionarme demasiado por \'no pensar en nada\'. Simplemente dejo que los pensamientos vengan y vayan sin aferrarme a ellos. Al principio puede ser difícil, pero con la práctica se vuelve más fácil. ¡Dale una oportunidad por la mañana, te sorprenderá cómo cambia el día! 😜',
                'created_at' => Carbon::create('2024', '11', '21', '21', '18', '11'),
                'updated_at' => Carbon::create('2024', '11', '21', '21', '19', '21'),
                'leido' => 1
            ]
        ]);
    }
}
