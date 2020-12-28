<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesManiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images_manies', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('small')->nullable();
            $table->string('medium')->nullable();
            $table->string('large')->nullable();
            $table->string('original')->nullable();
            $table->string('imageable_type')->nullable();
            $table->integer('imageable_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images_manies');
    }
}
