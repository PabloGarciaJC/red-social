<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');  
            $table->string('alias', 255)->nullable();          
            $table->string('nombre', 255)->nullable(); 
            $table->string('apellido', 255)->nullable();             
            $table->string('pais', 255)->nullable();  
            $table->string('direccion', 255)->nullable(); 
            $table->string('empresa', 255)->nullable();
            $table->string('cargo', 255)->nullable();
            $table->string('movil', 255)->nullable();
            $table->string('email')->unique();
            $table->string('fotoPerfil', 255)->nullable();
            $table->string('password', 255);
            $table->text('sobreMi')->nullable();
            $table->boolean('conectado')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
