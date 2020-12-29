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
			$table->string('url');
			$table->string('rsUrl');
            $table->string('apiVersion');

			$table->string('bankId')->nullable();
			$table->string('bankSecret')->nullable();

			$table->timestamps();
			$table->string('authCode')->nullable();
			$table->timestamp('authCodeDate')->nullable();
			$table->string('accessToken')->nullable();
			$table->timestamp('accessTokenDate')->nullable();
			$table->string('refreshToken')->nullable();
			$table->timestamp('refreshTokenDate')->nullable();
			$table->text('jwtToken')->nullable();
		});
	}

	public function down()
	{
		Schema::dropIfExists($this->table);
	}
}
