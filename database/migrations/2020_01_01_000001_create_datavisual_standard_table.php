<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDatavisualStandardTable extends Migration {

	public function up()
	{
		Schema::create('datavisual_standard', function(Blueprint $table) {
			$table->increments('id');
            $table->schemalessAttributes('extra_attributes');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('datavisual_standard');
	}
}
