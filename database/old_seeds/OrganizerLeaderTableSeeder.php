<?php

use Illuminate\Database\Seeder;

class OrganizerLeaderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organizers_leaders = [];

        for ($i = 10; $i < 20; $i++) {
            $part = [
                'leader_id' => $i,
                'organizer_id' => 1
            ];
            $organizers_leaders[] = $part;
        }

        DB::table('organizer_leader')->insert($organizers_leaders);
    }
}

//$table->unsignedBigInteger('leader_id');
//$table->unsignedBigInteger('organizer_id');
