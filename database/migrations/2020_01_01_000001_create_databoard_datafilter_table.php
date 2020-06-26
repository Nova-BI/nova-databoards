<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDataboardDatafilterTable extends Migration {

	public function up()
	{
		Schema::create('databoard_datafilter', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('databoard_id')->unsigned();
			$table->integer('datafilter_id')->unsigned();
			$table->integer('sort_order')->default('0');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('databoard_datafilter');
	}
}
