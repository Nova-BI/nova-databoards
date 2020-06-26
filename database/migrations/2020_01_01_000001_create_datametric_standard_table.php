<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDatametricStandardTable extends Migration {

	public function up()
	{
		Schema::create('datametric_standard', function(Blueprint $table) {
			$table->increments('id');
            $table->integer('visualable_id');
            $table->string('visualable_type');
            $table->schemalessAttributes('extra_attributes');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('datametric_standard');
	}
}
