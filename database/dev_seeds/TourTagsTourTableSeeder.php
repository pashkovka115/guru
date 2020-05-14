<?php

use Illuminate\Database\Seeder;

class TourTagsTourTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tour = \Modules\Admin\Models\Tour::find(1);
        $tags = \Modules\Admin\Models\ToursTags::where('id', '>=', 1)->where('id', '<=', 5)->get();
        $arr_ids_tags = array_keys($tags->keyBy('id')->toArray());

        $tour->tags()->attach($arr_ids_tags);
    }
}
