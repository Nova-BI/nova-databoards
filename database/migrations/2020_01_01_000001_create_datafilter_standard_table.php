<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDatafilterStandardTable extends Migration {

	public function up()
	{
		Schema::create('datafilter_standard', function(Blueprint $table) {
			$table->increments('id');
            $table->schemalessAttributes('extra_attributes');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('datafilter_standard');
	}
}
