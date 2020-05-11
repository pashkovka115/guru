<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class CategoryToursTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $categories = [
            /*[
                'title' => 'Без категории',
                'description' => $faker->paragraph,
                'img' => env('APP_URL') . '/assets/site/images/home_bg_new.jpg',
            ],*/
            [
                'title' => 'Растительная медицина',
                'description' => $faker->paragraph,
                'img' => env('APP_URL') . '/assets/site/images/home_bg_new.jpg',
                'icon' => asset('assets/site/images/all-events.svg')
            ],
            [
                'title' => 'Йога',
                'description' => $faker->paragraph,
                'img' => env('APP_URL') . '/assets/site/images/home_bg_new.jpg',
                'icon' => asset('assets/site/images/all-events.svg')
            ],
            [
                'title' => 'Медитация и духовность',
                'description' => $faker->paragraph,
                'img' => env('APP_URL') . '/assets/site/images/home_bg_new.jpg',
                'icon' => asset('assets/site/images/all-events.svg')
            ],
            [
                'title' => 'Здоровье и здоровое питание',
                'description' => $faker->paragraph,
                'img' => env('APP_URL') . '/assets/site/images/home_bg_new.jpg',
                'icon' => asset('assets/site/images/all-events.svg')
            ],
            [
                'title' => 'Искусство и творчество',
                'description' => $faker->paragraph,
                'img' => env('APP_URL') . '/assets/site/images/home_bg_new.jpg',
                'icon' => asset('assets/site/images/all-events.svg')
            ],
            [
                'title' => 'Активный отдых',
                'description' => $faker->paragraph,
                'img' => env('APP_URL') . '/assets/site/images/home_bg_new.jpg',
                'icon' => asset('assets/site/images/all-events.svg')
            ],
        ];

        DB::table('category_tours')->insert($categories);
    }
}






















