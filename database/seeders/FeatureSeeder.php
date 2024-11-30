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
        Feature::create(['title' => 'elevator', 'type'=>'static', 'value'=>'yes']);
        Feature::create(['title' => 'elevator', 'type'=>'static', 'value'=>'no']);
        Feature::create(['title' => 'garage', 'type'=>'static', 'value'=>'yes']);
        Feature::create(['title' => 'garage', 'type'=>'static', 'value'=>'no']);
        Feature::create(['title' => 'parking', 'type'=>'static', 'value'=>'yes']);
        Feature::create(['title' => 'parking', 'type'=>'static', 'value'=>'no']);

//        File_feature::create(['feature_id' => $feature1->feature_id, 'value' => '1']);
//        File_feature::create(['feature_id' => $feature2->feature_id, 'value' => '1']);
//        File_feature::create(['feature_id' => $feature3->feature_id, 'value' => '1']);
    }
}
