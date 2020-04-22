<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;


class TourVariantTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $variants = [
            [
                'tour_id' => 1,
                'price' => random_int(10000, 157000),
                'excerpt' => $faker->paragraph(),
                'img' => $faker->imageUrl(),
                'group_people' => random_int(20, 30),
            ],
            [
                'tour_id' => 1,
                'price' => random_int(10000, 157000),
                'excerpt' => $faker->paragraph(),
                'img' => $faker->imageUrl(),
                'group_people' => random_int(1, 5),
            ],
            [
                'tour_id' => 1,
                'price' => random_int(10000, 157000),
                'excerpt' => $faker->paragraph(),
                'img' => $faker->imageUrl(),
                'group_people' => random_int(10, 20),
            ],
        ];

        DB::table('tour_variant')->insert($variants);
    }
}


