<?php

use Illuminate\Database\Seeder;

class TourLeaderTableSeeder extends Seeder
{
    public function run()
    {
        $count_tour = \Modules\Admin\Models\Tour::count();
        $count_user = \App\Models\User::count();

        $parts = [];
        for ($i = 0; $i < $count_tour; $i++) {
            $part = [
                'tour_id' => random_int(1, $count_tour),
                'leader_id' => random_int(1, $count_user),
            ];
            $parts[] = $part;
        }

        DB::table('tour_leader')->insert($parts);
    }
}
