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

        Schema::create('publications', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');  // Aquí agregamos la opción 'cascade'
            $table->string('imagen', 255)->nullable()->default('DEFAULT NULL');
            $table->text('contenido')->nullable()->default('DEFAULT NULL');
            $table->timestamps(0);
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints(); // Desactivar restricciones
        Schema::dropIfExists('publications');
        Schema::enableForeignKeyConstraints(); // Volver a habilitar restricciones
    }
    
};
