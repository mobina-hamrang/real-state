<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\File_feature;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Feature::create(['title' => 'elevator', 'type'=>'static', 'value'=>'yes']);
//        Feature::create(['title' => 'elevator', 'type'=>'static', 'value'=>'no']);
//        Feature::create(['title' => 'garage', 'type'=>'static', 'value'=>'yes']);
//        Feature::create(['title' => 'garage', 'type'=>'static', 'value'=>'no']);
//        Feature::create(['title' => 'parking', 'type'=>'static', 'value'=>'yes']);
//        Feature::create(['title' => 'parking', 'type'=>'static', 'value'=>'no']);

        Feature::create(['title' => 'آسانسور', 'type'=>'static', 'value'=>'yes']);
        Feature::create(['title' => 'آسانسور', 'type'=>'static', 'value'=>'no']);
        Feature::create(['title' => 'انباری', 'type'=>'static', 'value'=>'yes']);
        Feature::create(['title' => 'انباری', 'type'=>'static', 'value'=>'no']);
        Feature::create(['title' => 'پارکینگ', 'type'=>'static', 'value'=>'yes']);
        Feature::create(['title' => 'پارکینگ', 'type'=>'static', 'value'=>'no']);

    }
}
