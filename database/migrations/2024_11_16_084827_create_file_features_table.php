<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_features', function (Blueprint $table) {
            $table->uuid('file_feature_id')->primary();
            $table->string('feature_id');
            $table->string('file_id');
            $table->string('value');
            $table->timestamps();

            $table->foreign('feature_id')->references('feature_id')->on('features')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('file_id')->references('file_id')->on('files')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_features');
    }
}
