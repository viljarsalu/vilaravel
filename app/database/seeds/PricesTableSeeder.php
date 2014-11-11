<?php

class PricesTableSeeder extends Seeder {

	public function run()
    {
        DB::table('prices')->delete();

        Price::create(array('title' => 'Plan a','description' => 'this is plan a', 'price'=>0, 'public'=>true, 'date_start' => new DateTime, 'date_start' => new DateTime));
        Price::create(array('title' => 'Plan b','description' => 'this is plan b', 'price'=>20, 'public'=>true, 'date_start' => new DateTime, 'date_start' => new DateTime));
        Price::create(array('title' => 'Plan c','description' => 'this is plan c', 'price'=>30, 'public'=>true, 'date_start' => new DateTime, 'date_start' => new DateTime));
    }

}