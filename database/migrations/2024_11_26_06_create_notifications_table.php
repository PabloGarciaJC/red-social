<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->char('id', 36);
            $table->string('type');
            $table->string('notifiable_type');
            $table->unsignedBigInteger('notifiable_id');
            $table->text('data');
            $table->timestamp('read_at')->nullable();
            $table->timestamps(0);

            $table->primary('id');
            $table->index(['notifiable_type', 'notifiable_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}

