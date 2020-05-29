<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TourTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $category_tours = \Modules\Admin\Models\CategoryTour::count();
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
        $count_meals = [
            "3 раза в день",
            "2 раза в день",
            "1 раз в день",
            "Без питания"
        ];
        $tours = [];
        for ($i = 0; $i < 70; $i++) {
            $tour = [
                'user_id' => random_int(1, 2),
                'category_tour_id' => random_int(1, $category_tours),
                'active' => ($i % 2 == 0) ? '1' : '0',
                'good' => ($i % 2 == 0) ? '1' : '0',
                'recommended' => ($i < 10) ? '1' : '0',
//                'price_base' => random_int(100, 600000),
                'rating' => random_int(0, 5),
                'title' => implode(' ', $faker->words()),
                'gallery' => json_encode([
                    asset('assets/site/images/home_bg.jpg'),
                    asset('assets/site/images/home_bg.png'),
                    asset('assets/site/images/home_bg_new.jpg'),
                ]),
                'address' => $faker->address,
                'street' => $faker->streetName,
                'house' => random_int(1, 3000),
                'region' => $faker->region,
                'city' => $faker->city,
                'country' => $faker->country,
                'latitude' => $faker->latitude,
                'longitude' => $faker->longitude,
                'adress_desk' => $faker->paragraph(5),
                'video_url' => \Illuminate\Support\Str::random(10),
                'info_excerpt' => $faker->paragraph(5),
                'info_description' => $faker->paragraphs(10, true),
                'count_person' => $count_person[array_rand($count_person)],
                'timetable' => $faker->paragraph(10),
                'included' => $faker->paragraph(10),
                'no_included' => $faker->paragraph(10),
                'first_aid' => $faker->words(10, true),
                'drinking_water' => $faker->words(10, true),
                'communication' => $faker->words(10, true),
                'accommodation_photo' => json_encode([
                    asset('assets/site/images/home_bg.png'),
                    asset('assets/site/images/home_bg_new.jpg'),
                ]),
                'accommodation_description' => $faker->paragraph(10),
                'conditioner' => (string)random_int(0, 1),
                'wifi' => (string)random_int(0, 1),
                'pool' => (string)random_int(0, 1),
                'towel' => (string)random_int(0, 1),
                'kitchen' => (string)random_int(0, 1),
                'coffee_tea' => (string)random_int(0, 1),
                'private_room' => (string)random_int(0, 1),
                'dormitory_room' => (string)random_int(0, 1),
                'separate_house' => (string)random_int(0, 1),
                'transfer_free' => (string)random_int(0, 1),
                'transfer_fee' => (string)random_int(0, 1),
                'not_transfer' => (string)random_int(0, 1),
                'gallery_meals' => json_encode([
                    asset('assets/site/images/home_bg.png'),
                    asset('assets/site/images/home_bg_new.jpg'),
                ]),
                'meals_desc' => $faker->paragraph(10),
                'vegan' => (string)random_int(0, 1),
                'vegetarianism' => (string)random_int(0, 1),
                'fish' => (string)random_int(0, 1),
                'ayurveda' => (string)random_int(0, 1),
                'meat' => (string)random_int(0, 1),
                'organic' => (string)random_int(0, 1),
                'gluten_free' => (string)random_int(0, 1),
                'milk_free' => (string)random_int(0, 1),
                'nuts_free' => (string)random_int(0, 1),
                'count_meals' => $count_meals[array_rand($count_meals)],

//                'date_start' => \Carbon\Carbon::now()->subDays(random_int(1, 10)),
//                'date_end' => \Carbon\Carbon::now()->addDays(random_int(2, 20)),

                'created_at' => now(),
                'updated_at' => now(),
            ];
            $tours[] = $tour;
        }

        DB::table('tours')->insert($tours);
    }
}
