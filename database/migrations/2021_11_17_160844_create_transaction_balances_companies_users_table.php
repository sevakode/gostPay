<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionBalancesCompaniesUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_balances_companies_users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('bank_account_id')->unsigned();
            $table->bigInteger('company_id')->unsigned();
            $table->bigInteger('transaction_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('transaction_balances_companies_users', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('bank_account_id')->references('id')->on('bank_account');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('transaction_id')->references('id')->on('transaction_balances');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_balances_companies_users');
    }
}
