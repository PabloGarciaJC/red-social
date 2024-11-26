<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowersTable extends Migration
{
    public function up()
    {
        Schema::create('followers', function (Blueprint $table) {
            $table->id(); // id (auto-incremental, UNSIGNED)
            $table->unsignedBigInteger('user_id'); // user_id (UNSIGNED)
            $table->integer('seguido'); // seguido (int(11))
            $table->string('estado')->nullable(); // estado (VARCHAR, NULL permitido)
            $table->timestamps(0); // created_at, updated_at

            // Clave foránea
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('followers');
    }
}


