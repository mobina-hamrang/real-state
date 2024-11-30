<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Image;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $image = Image::create(['path' => 'images/house-icon.png']);
        $cat1 = Category::create(['title'=>'رهن و اجاره',  'image_id' => $image->image_id]);
        $cat2 = Category::create(['title'=>'فروش',  'image_id' => $image->image_id]);
        $cat3 = Category::create(['title' => 'مسکونی', 'parent_id' => $cat1->category_id,  'image_id' => $image->image_id]);
        $cat4 = Category::create(['title' => 'مسکونی', 'parent_id' => $cat2->category_id,  'image_id' => $image->image_id]);
        $cat5 = Category::create(['title' => 'تجاری و اداری', 'parent_id' => $cat1->category_id,  'image_id' => $image->image_id]);
        $cat6 = Category::create(['title' => 'تجاری و اداری', 'parent_id' => $cat2->category_id,  'image_id' => $image->image_id]);
        Category::create(['title' => 'آپارتمان', 'parent_id' => $cat3->category_id,  'image_id' => $image->image_id]);
        Category::create(['title' => 'آپارتمان', 'parent_id' => $cat4->category_id,  'image_id' => $image->image_id]);
        Category::create(['title' => 'ویلایی', 'parent_id' => $cat3->category_id,  'image_id' => $image->image_id]);
        Category::create(['title' => 'ویلایی', 'parent_id' => $cat4->category_id,  'image_id' => $image->image_id]);
        Category::create(['title' => 'فروشگاه', 'parent_id' => $cat5->category_id,  'image_id' => $image->image_id]);
        Category::create(['title' => 'فروشگاه', 'parent_id' => $cat6->category_id,  'image_id' => $image->image_id]);
        Category::create(['title' => 'دفاتر کار', 'parent_id' => $cat5->category_id,  'image_id' => $image->image_id]);
        Category::create(['title' => 'دفاتر کار', 'parent_id' => $cat6->category_id,  'image_id' => $image->image_id]);

    }
}
