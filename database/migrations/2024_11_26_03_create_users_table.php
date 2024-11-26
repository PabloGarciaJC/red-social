<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // Fuerza el uso de InnoDB
            $table->id(); // id (auto-incremental, UNSIGNED)
            $table->string('alias')->nullable(); // alias
            $table->string('nombre')->nullable(); // nombre
            $table->string('apellido')->nullable(); // apellido
            $table->string('pais')->nullable(); // pais
            $table->string('direccion')->nullable(); // direccion
            $table->string('empresa')->nullable(); // empresa
            $table->string('cargo')->nullable(); // cargo
            $table->string('movil')->nullable(); // movil
            $table->string('email')->unique(); // email (único)
            $table->string('fotoPerfil')->nullable(); // fotoPerfil
            $table->string('password'); // password
            $table->text('sobreMi')->nullable(); // sobreMi
            $table->tinyInteger('conectado')->nullable(); // conectado
            $table->rememberToken(); // remember_token
            $table->timestamps(0); // created_at, updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}


