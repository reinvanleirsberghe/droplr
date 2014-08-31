<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDropsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('drops', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
            $table->text('description');
            $table->string('location');
            $table->decimal('lat', 9, 6);
            $table->decimal('lng', 9, 6);
			$table->integer('user_id');
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
		Schema::drop('drops');
	}

}
