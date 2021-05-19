<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateBankTokenTable extends Migration
{
	protected $table;

	public function __construct() {
		$name = null;
		$class = \App\Models\Bank\BankToken::class;
		try {
			$model = new $class();
			if (method_exists($model, 'getTable')) {
				$name = ($model)->getTable();
			}
		} catch (Exception $exception) {}
		if (!$name) {
			$name = Str::snake(Str::pluralStudly($class));
		}
		$this->table = $name;
	}

	public function up()
	{
		Schema::create($this->table, function (Blueprint $table) {
			$table->id();

			$table->string('title')->nullable();

			$table->string('url');
			$table->string('rsUrl');
            $table->string('apiVersion');

            $table->string('key')->nullable()->default(Str::random('32'))->unique();

			$table->string('bankId');
			$table->string('bankSecret');

//            $table->integer('company_id')->references('id')->on('companies')->onDelete('cascade');

			$table->timestamps();
			$table->string('authCode')->nullable();
			$table->timestamp('authCodeDate')->nullable();
			$table->string('accessToken')->nullable();
			$table->timestamp('accessTokenDate')->nullable();
			$table->string('refreshToken')->nullable();
			$table->timestamp('refreshTokenDate')->nullable();
		});
	}

	public function down()
	{
		Schema::dropIfExists($this->table);
	}
}
