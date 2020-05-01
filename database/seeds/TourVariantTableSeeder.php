<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;


class TourVariantTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $count_person = [
            "1 человек",
            "2 человека",
            "3 человека",
            "4 человека",
            "5 человек",
            "от 5 до 10 человек",
            "от 10 до 20 человек",
            "от 20 до 50 человек"
        ];

        $variants = [];

        for ($i = 0; $i<5; $i++){
            $variant = [
                'tour_id' => 1,
                'price_variant' => random_int(10000, 157000),
                'photo_variant' => 'http://retreat-guru.loc/assets/site/images/home_bg.jpg',
                'date_start_variant' => $faker->date(),
                'date_end_variant' => $faker->date(),
                'text_variant' => $faker->paragraph(),
                'amount_variant' => $count_person[array_rand($count_person)],
            ];
            $variants[] = $variant;
        }
        DB::table('tours_variants')->insert($variants);
    }
}


