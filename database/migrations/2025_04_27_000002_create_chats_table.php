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
        Schema::create('chats', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->unsignedInteger('emisor_id');
            $table->unsignedInteger('receptor_id');
            $table->text('message');
            $table->timestamps(0); // Crea 'created_at' y 'updated_at' como nullable
            $table->tinyInteger('leido')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
