<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\User;
use Baloot\Database\CitiesTableSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(CitiesTableSeeder::class); // سیدر شهر ها و استان ها
        $this->call(CategoriesTableSeeder::class); //سیدر دسته بندی ها
        $this->call([RoleAndPermissionSeeder::class,]);
        $this->call([FeatureSeeder::class,]); //سیدر فیچرها و مقدارشون

        User::create([
            'name'=>'mobina',
            'phone'=>'09190374769',
        ])->assignRole('Admin');

        User::create([
            'name'=>'arina',
            'phone'=>'09016519188',
        ])->assignRole('Admin');
    }
}
