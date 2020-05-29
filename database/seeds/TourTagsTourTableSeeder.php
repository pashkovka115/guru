<?php

use Illuminate\Database\Seeder;

class TourTagsTourTableSeeder extends Seeder
{
    public function run()
    {
        $tours = \Modules\Admin\Models\Tour::find([1,2,3]);
        $tags = \Modules\Admin\Models\ToursTags::where('id', '>=', 1)->where('id', '<=', 5)->get();
        foreach ($tours as $tour){
            $arr_ids_tags = array_keys($tags->keyBy('id')->toArray());
            $tour->tags()->attach($arr_ids_tags);
        }
    }
}
