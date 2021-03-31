<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('head')->nullable();
            $table->string('tail')->nullable();

            $table->string('card_description')->nullable();
            $table->string('card_type')->nullable();
            $table->string('account_code')->nullable();
            $table->string('bank_code')->nullable();
            $table->string('cvc')->nullable();

            $table->integer('user_id')->nullable();
            $table->integer('company_id')->nullable();
//            $table->integer('geo_id')->nullable();

            $table->string('state')->default(\App\Models\Bank\Card::ACTIVE);

            $table->softDeletes();
            $table->timestamp('expiredAt')->useCurrent();
            $table->timestamps();

            $table->index(['number']);
            $table->index(['head', 'tail', 'expiredAt']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
