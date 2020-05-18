<?php

use Illuminate\Database\Seeder;

class HomeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parts = [
            [
                'post_type' => 'title',
                'title' => 'Самая большая коллекция оздоровительных туров по всему миру.',
                'excerpt' => '',
            ],
            [
                'post_type' => 'content',
                'title' => 'Наша идея',
                'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo doloremque error ducimus perspiciatis omnis earum minus, temporibus quae quibusdam. Rerum ut mollitia dolorem alias? Aspernatur unde id, corporis, at porro reprehenderit ut explicabo eveniet minima cumque!',
            ],
            [
                'post_type' => 'progress',
                'title' => '2500+',
                'excerpt' => 'Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.'
            ],
            [
                'post_type' => 'progress',
                'title' => '2500+',
                'excerpt' => 'Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.'
            ],
            [
                'post_type' => 'progress',
                'title' => '2500+',
                'excerpt' => 'Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.'
            ],
            [
                'post_type' => 'progress',
                'title' => '2500+',
                'excerpt' => 'Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.'
            ],
        ];

        DB::table('home')->insert($parts);
    }
}


