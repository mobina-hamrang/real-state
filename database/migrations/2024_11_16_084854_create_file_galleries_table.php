<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_galleries', function (Blueprint $table) {
            $table->uuid('file_gallery_id')->primary();
            $table->string('image_id');
            $table->string('file_id');
            $table->timestamps();

            $table->foreign('file_id')->references('file_id')->on('files')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('image_id')->references('image_id')->on('images')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_galleries');
    }
}
