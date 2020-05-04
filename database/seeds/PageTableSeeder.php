<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class PageTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $pages = [
            [
                'title' => 'Пользовательское соглашение',
                'content' => $faker->paragraphs(30, true)
            ],
            [
                'title' => 'Политика публикации',
                'content' => $faker->paragraphs(30, true)
            ],
            [
                'title' => 'Политика конфиденциальности',
                'content' => $faker->paragraphs(30, true)
            ],
            [
                'title' => 'Оплата и отмена',
                'content' => $faker->paragraphs(30, true)
            ],
        ];

        DB::table('pages')->insert($pages);
    }
}


