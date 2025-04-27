<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('alias', 255)->nullable();
            $table->string('nombre', 255)->nullable();
            $table->string('apellido', 255)->nullable();
            $table->string('pais', 255)->nullable();
            $table->string('direccion', 255)->nullable();
            $table->string('empresa', 255)->nullable();
            $table->string('cargo', 255)->nullable();
            $table->string('movil', 255)->nullable();
            $table->string('email', 191)->unique();
            $table->string('fotoPerfil', 255)->nullable();
            $table->string('password', 255);
            $table->text('sobreMi')->nullable();
            $table->tinyInteger('conectado')->nullable();
            $table->rememberToken(); // Crea remember_token
            $table->timestamps();    // Crea created_at y updated_at
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
