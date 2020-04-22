<?php

use Illuminate\Database\Seeder;

class CategoryTourTourTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category_has_tours = [];
        $tours = \Modules\Admin\Models\Tour::all('id')->toArray();
        foreach ($tours as $key => $tour){
            $tours[$key] = $tour['id'];
        }
//        print_r($tours); exit();
        $categories = \Modules\Admin\Models\CategoryTour::all('id');

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        $categories[0]->tours()->attach($tours);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
