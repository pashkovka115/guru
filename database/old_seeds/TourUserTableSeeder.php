<?php

use Illuminate\Database\Seeder;

class TourUserTableSeeder extends Seeder
{
    public function run()
    {
        $tours_ids = \Modules\Admin\Models\Tour::all('id')->keyBy('id')->toArray();
        $user_tour_ids = [];
        foreach ($tours_ids as $key => $v){
            $part = [
                'user_id' => 1,
                'tour_id' => $key
            ];
            $user_tour_ids[] = $part;
        }

        DB::table('tour_user')->insert($user_tour_ids);
    }
}
