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

        Schema::create('likes', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('publication_id');
            // Definir valores válidos para 'type'
            $table->enum('type', ['like', 'dislike'])->nullable();
            $table->timestamp('created_at')->nullable(); // Eliminado 'default('DEFAULT NULL')'
            $table->timestamp('updated_at')->nullable(); // Eliminado 'default('DEFAULT NULL')'
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
