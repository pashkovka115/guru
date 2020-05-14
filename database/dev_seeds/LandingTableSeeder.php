<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class LandingTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $parts = [
            [
                'block_id' => 1,
                'sort' => 1,
                'title' => 'Хотите предложить объявление и найти участников?',
                'img' => '',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut error nesciunt, odio porro ducimus placeat.'
            ],
            [
                'block_id' => 2,
                'sort' => 1,
                'title' => 'Lorem ipsum dolor sit amet.1',
                'img' => 'http://retreat-guru.loc/assets/site/images/home_bg_new.jpg',
                'content' => $faker->paragraphs(3, true)
            ],
            [
                'block_id' => 2,
                'sort' => 2,
                'title' => 'Lorem ipsum dolor sit amet.2',
                'img' => 'http://retreat-guru.loc/assets/site/images/home_bg_new.jpg',
                'content' => $faker->paragraphs(3, true)
            ],
            [
                'block_id' => 2,
                'sort' => 3,
                'title' => 'Lorem ipsum dolor sit amet.3',
                'img' => 'http://retreat-guru.loc/assets/site/images/home_bg_new.jpg',
                'content' => $faker->paragraphs(3, true)
            ],
            [
                'block_id' => 3,
                'sort' => 1,
                'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, facilis, voluptates? In ullam quod, iusto.',
                'img' => '',
                'content' => '- Lorem ipsum dolor sit amet.'
            ],
            // 4
            [
                'block_id' => 4,
                'sort' => 1,
                'title' => 'Lorem ipsum dolor.',
                'img' => '',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. In, sequi!'
            ],
            [
                'block_id' => 4,
                'sort' => 2,
                'title' => 'Lorem ipsum dolor.',
                'img' => '',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. In, sequi!'
            ],
            [
                'block_id' => 4,
                'sort' => 3,
                'title' => 'Lorem ipsum dolor.',
                'img' => '',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. In, sequi!'
            ],
            [
                'block_id' => 4,
                'sort' => 4,
                'title' => 'Lorem ipsum dolor.',
                'img' => '',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. In, sequi!'
            ],
            [
                'block_id' => 4,
                'sort' => 5,
                'title' => 'Lorem ipsum dolor.',
                'img' => '',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. In, sequi!'
            ],
            [
                'block_id' => 4,
                'sort' => 6,
                'title' => 'Lorem ipsum dolor.',
                'img' => '',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. In, sequi!'
            ],
            // 5

            [
                'block_id' => 5,
                'sort' => 1,
                'title' => '',
                'img' => '',
                'content' => file_get_contents(__DIR__ . '/landing_latest_block_content.txt')
            ],
        ];

        DB::table('landing')->insert($parts);
    }
}
