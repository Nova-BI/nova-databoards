<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDataboardsTable extends Migration {

	public function up()
	{
		Schema::create('databoards', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->text('description')->nullable();
			$table->integer('databoardable_id');
			$table->string('databoardable_type');
            $table->schemalessAttributes('extra_attributes');
			$table->integer('sort_order')->default('0');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('databoards');
	}
}
