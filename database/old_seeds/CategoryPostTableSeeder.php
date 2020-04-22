<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class CategoryPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $categories = [
            ['title' => 'Без категории']
        ];
        for ($i = 0; $i < 10; $i++) {
            $category = ['title' => 'Кат_' . $faker->word];
            $categories[] = $category;
        }

        DB::table('category_posts')->insert($categories);
    }
}
