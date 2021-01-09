<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards_operations', function (Blueprint $table) {
            $table->id();
//            $table->string('externalId');
            $table->string('text');
            $table->timestamps();
            $table->timestamp('date')->useCurrent();
            $table->float('amount');
            $table->integer('card_id');
//            $table->index(['externalId']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards_operations');
    }
}
