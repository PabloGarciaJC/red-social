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

        Schema::create('publication_images', function (Blueprint $table) {
            $table->id(); // Esto crea la columna id como clave primaria y tipo unsignedBigInteger
            $table->unsignedBigInteger('publication_id'); // Cambiado a unsignedBigInteger
            $table->foreign('publication_id')->references('id')->on('publications')->onDelete('cascade'); // Establecer la clave foránea
            $table->string('image_path', 255);
            $table->timestamps(); // Laravel maneja automáticamente los timestamps
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publication_images');
    }
};
