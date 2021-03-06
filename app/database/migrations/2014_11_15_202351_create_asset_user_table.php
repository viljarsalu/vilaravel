<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssetUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('asset_user', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('asset_id')->unsigned()->index();
			$table->foreign('asset_id')->references('id')->on('assets')->onDelete('cascade');
			$table->integer('user_id')->unsigned()->index();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
		Schema::drop('asset_user');
	}

}
