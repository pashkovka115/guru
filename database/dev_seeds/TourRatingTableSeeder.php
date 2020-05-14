<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TourRatingTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $ratings = [];
        for ($i = 1; $i <= 10; $i++){
            $rating = [
                'tour_id' => 1,
                'user_id' => $i,
                'new_comment' => (string) random_int(0, 1),
                'rating' => random_int(1, 5),
                'title' => $faker->words(7, true),
                'comment' => $faker->paragraphs(5, true),
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $ratings[] = $rating;
        }

        DB::table('tours_rating')->insert($ratings);
    }
}


