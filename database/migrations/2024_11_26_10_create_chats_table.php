<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // Fuerza el uso de InnoDB
            $table->id(); // id (auto-incremental, UNSIGNED)
            $table->unsignedBigInteger('emisor_id'); // emisor_id (UNSIGNED)
            $table->unsignedBigInteger('receptor_id'); // receptor_id (UNSIGNED)
            $table->text('message'); // message
            $table->timestamps(0); // created_at, updated_at
            $table->tinyInteger('leido')->default(0); // leido (DEFAULT 0)

            // Claves foráneas
            $table->foreign('emisor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receptor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('chats');
    }
}

