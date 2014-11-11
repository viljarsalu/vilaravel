<?php

class LabelsTableSeeder extends Seeder {

	public function run()
    {
        DB::table('labels')->delete();

        Label::create(array('title' => 'Label 1','public' => true));
        Label::create(array('title' => 'Label 2','public' => true));
        Label::create(array('title' => 'Label 3','public' => false));
        Label::create(array('title' => 'Label 4','public' => true));
    }

}