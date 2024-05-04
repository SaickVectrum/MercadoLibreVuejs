<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up()
	{
		Schema::create('files', function (Blueprint $table) {
			$table->id();
			$table->bigInteger('fileable_id')->unsigned(); //Id del modelo (1)(34)
			$table->string('fileable_type'); //Modelo (Book)(User)
			$table->string('route');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('files');
	}
};
