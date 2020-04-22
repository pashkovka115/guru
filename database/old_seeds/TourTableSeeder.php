<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TourTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $tours = [];
        for ($i = 0; $i < 30; $i++) {
            $tour = [
                'active' => ($i % 2 == 0) ? '1' : '0',
                'good' => ($i % 2 == 0) ? '1' : '0',
                'price' => random_int(100, 600000),
                'rating' => random_int(0, 5),
                'title' => implode(' ', $faker->words()),
                'h1' => implode(' ', $faker->words(5)),

                'included_event' => $faker->words(5, true),
                'wifi_desc' => $faker->words(5, true),
                'transfer' => ($i % 3 == 0) ? implode(' ', $faker->words()) : '',
                'some_text' => ($i % 9 == 0) ? implode(' ', $faker->words()) : '',
                'accommodation_desc' => ($i % 7 == 0) ? implode(' ', $faker->words()) : '',
                'group_people' => ($i % 4 == 0) ? implode(' ', $faker->words()) : '',
                'food_desc' => ($i % 5 == 0) ? implode(' ', $faker->words()) : '',

                'description' => $faker->paragraph(3, true),
                'date_start' => \Carbon\Carbon::now()->subDays(random_int(1, 10)),
                'date_end' => \Carbon\Carbon::now()->addDays(random_int(2, 20)),
                'img' => $faker->imageUrl(720, 444, 'cats', true, 'Faker', true),
                'gallery' => json_encode([
                    asset('public/assets/site/images/home_bg_new.jpg'),
                    asset('public/assets/site/images/home_bg_new.jpg'),
                    asset('public/assets/site/images/home_bg_new.jpg'),
                    ]),
                'location' => '[{"w":"'.($faker->latitude()).'","h":"'.($faker->longitude()).'"}]',
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $tours[] = $tour;
        }

        DB::table('tours')->insert($tours);
    }
}
