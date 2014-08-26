<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMarkersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('markers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('drop_id')->index();
			$table->boolean('has_event');
			$table->double('lat');
			$table->double('lng');
			$table->integer('event_id')->index();
			$table->integer('order')->default(999999);
			$table->softDeletes();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('markers');
	}

}
