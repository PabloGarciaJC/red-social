<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicationImagesTable extends Migration
{
    public function up()
    {
        Schema::create('publication_images', function (Blueprint $table) {
            $table->id(); // Crea un campo 'id' de tipo BIGINT UNSIGNED AUTO_INCREMENT
            $table->foreignId('publication_id')->constrained()->onDelete('cascade'); // Crea un campo para la relación con publications
            $table->string('image_path'); // Crea un campo para almacenar la ruta de la imagen
            $table->timestamps(); // Crea los campos created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('publication_images');
    }
}
