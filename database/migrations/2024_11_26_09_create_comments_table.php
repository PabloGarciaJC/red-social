<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id(); // id (auto-incremental, UNSIGNED)
            $table->unsignedBigInteger('user_id'); // user_id (UNSIGNED)
            $table->unsignedBigInteger('publication_id'); // publication_id (UNSIGNED)
            $table->text('contenido')->nullable(); // contenido (puede ser NULL)
            $table->timestamps(0); // created_at, updated_at

            // Claves foráneas
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('publication_id')->references('id')->on('publications')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}


