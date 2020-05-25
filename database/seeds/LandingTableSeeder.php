<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class LandingTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $header = [
            'post_type' => 'header',
            'title' => 'Хотите предложить объявление и найти участников?',
            'img' => asset('storage/background/bg_add.jpg'),
            'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut error nesciunt, odio porro ducimus placeat.',
            'button_text' => 'Добавить объявление'
        ];
        DB::table('landing')->insert($header);

        $posts = [];
        for ($i = 0; $i < 3; $i++){
            $post = [
                'post_type' => 'post',
                //'sort_block' => 1,
                'title' => 'Lorem ipsum dolor sit amet',
                'img' => asset('assets/site/images/home_bg_new.jpg'),
                'excerpt' => $faker->paragraphs(3, true)
            ];
            $posts[] = $post;
        }
        DB::table('landing')->insert($posts);

        $decorative = [
            'post_type' => 'decorative',
            //'sort_block' => 2,
            'img' => asset('storage/background/bg_add.jpg'),
            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, facilis, voluptates? In ullam quod, iusto.',
            'excerpt' => '- Lorem ipsum dolor sit amet.',
        ];
        DB::table('landing')->insert($decorative);

        $title_progress = [
            'post_type' => 'progress',
            //'sort_block' => 3,
            'title' => 'Lorem ipsum dolor sit amet.',
            'button_text' => 'Добавить объявление'
        ];
        DB::table('landing')->insert($title_progress);

        $progs = [];
        for ($i = 0; $i < 6; $i++){
            $progress = [
                'post_type' => 'progress',
                //'sort_block' => 4,
                'title' => 'Lorem ipsum dolor.',
                'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. In, sequi!',
            ];
            $progs[] = $progress;
        }

        DB::table('landing')->insert($progs);




        $content = [
            'post_type' => 'content',
            //'sort_block' => 6,
            'title' => 'Lorem ipsum dolor sit amet.',
            'content' => file_get_contents(__DIR__ . '/landing_latest_block_content.txt')
        ];
        DB::table('landing')->insert($content);


    }
}
