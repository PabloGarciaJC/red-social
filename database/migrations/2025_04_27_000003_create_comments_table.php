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

        Schema::create('comments', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('publication_id');
            $table->foreign('publication_id')->references('id')->on('publications');
            $table->text('contenido')->nullable(); // Eliminado 'default('DEFAULT NULL')'
            $table->timestamps(0); // Esto crea 'created_at' y 'updated_at' como nullable automáticamente
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
