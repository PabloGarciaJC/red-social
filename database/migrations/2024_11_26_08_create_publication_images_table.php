<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicationImagesTable extends Migration
{
    public function up()
    {
        Schema::create('publication_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('publication_id');
            $table->string('image_path');
            $table->timestamps(0);

            $table->foreign('publication_id')->references('id')->on('publications')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('publication_images');
    }
}

