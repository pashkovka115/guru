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
                'slug' => Str::slug('Пользовательское соглашение'),
                'content' => $faker->paragraphs(30, true)
            ],
            [
                'title' => 'Политика публикации',
                'slug' => Str::slug('Политика публикации'),
                'content' => $faker->paragraphs(30, true)
            ],
            [
                'title' => 'Политика конфиденциальности',
                'slug' => Str::slug('Политика конфиденциальности'),
                'content' => $faker->paragraphs(30, true)
            ],
            [
                'title' => 'Оплата и отмена',
                'slug' => Str::slug('Оплата и отмена'),
                'content' => $faker->paragraphs(30, true)
            ],
        ];

        DB::table('pages')->insert($pages);
    }
}


