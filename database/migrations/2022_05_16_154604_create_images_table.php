<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class CreateImagesTable extends Migration
{
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('file_name');
            $table->string('file_extension');
            $table->string('file_path');
            $table->integer('imageable_id');
            $table->string('imageable_type');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('images');
        Storage::deleteDirectory('public/files');
    }
}
