<?php

use Illuminate\Database\Seeder;
//use Faker\Generator as Faker;

/*
 * У организатора есть эти ведущие
 */
class OrganizerLeaderTableSeeder extends Seeder
{
    public function run()
    {
        // для каждого organizer_id нужен новый объект leader_id
        $faker = Faker\Factory::create();
        $parts = [];
        for ($i = 0; $i < 7; $i++) {
            try {
                $part = [
                    'organizer_id' => 1,
                    'leader_id' => $faker->unique()->numberBetween(3, 10),
                ];
                $parts[] = $part;
            }catch (Exception $e){
                // заглушка от ошибок
                continue;
            }
        }

        $faker = Faker\Factory::create();

        for ($i = 0; $i < 7; $i++) {
            try {
                $part = [
                    'organizer_id' => 2,
                    'leader_id' => $faker->unique()->numberBetween(2, 10),
                ];
                $parts[] = $part;
            }catch (Exception $e){
                // заглушка от ошибок
                continue;
            }
        }

        DB::table('organizer_leader')->insert($parts);
    }
}
