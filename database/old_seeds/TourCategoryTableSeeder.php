<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TourCategoryTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $categories = [
            [
                'title' => 'Без категории',
                'description' => $faker->paragraph,
                'img' => $faker->imageUrl('720', '444', 'cats', true, 'Faker', true),
            ],
            [
                'title' => 'Растительная медицина',
                'description' => $faker->paragraph,
                'img' => $faker->imageUrl('720', '444', 'cats', true, 'Faker', true),
            ],
            [
                'title' => 'Йога',
                'description' => $faker->paragraph,
                'img' => $faker->imageUrl('720', '444', 'cats', true, 'Faker', true),
            ],
            [
                'title' => 'Медитация и духовность',
                'description' => $faker->paragraph,
                'img' => $faker->imageUrl('720', '444', 'cats', true, 'Faker', true),
            ],
            [
                'title' => 'Здоровье и здоровое питание',
                'description' => $faker->paragraph,
                'img' => $faker->imageUrl('720', '444', 'cats', true, 'Faker', true),
            ],
            [
                'title' => 'Искусство и творчество',
                'description' => $faker->paragraph,
                'img' => $faker->imageUrl('720', '444', 'cats', true, 'Faker', true),
            ],
            [
                'title' => 'Активный отдых',
                'description' => $faker->paragraph,
                'img' => $faker->imageUrl('720', '444', 'cats', true, 'Faker', true),
            ],
        ];

        DB::table('category_tours')->insert($categories);
    }
}






















