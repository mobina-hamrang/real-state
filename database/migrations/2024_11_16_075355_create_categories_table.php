<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id('category_id');
            $table->string('title');
            $table->string('image_id')->nullable();
            $table->string('parent_id')->nullable();
            $table->timestamps();

            $table->foreign('image_id')->references('image_id')->on('images')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('parent_id')->references('category_id')->on('categories')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
