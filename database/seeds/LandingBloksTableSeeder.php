<?php

use Illuminate\Database\Seeder;

class LandingBloksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bloks = [
            [
                'sort' => 1,
                'block_name' => 'первый',
                'class' => 'block_adds',
                'title' => '',
                'img' => ''
            ],
            [
                'sort' => 1,
                'block_name' => 'второй',
                'class' => 'block_adds_content',
                'title' => '',
                'img' => ''
            ],
            [
                'sort' => 1,
                'block_name' => 'третий',
                'class' => 'block_adds_content_bg',
                'title' => '',
                'img' => ''
            ],
            [
                'sort' => 1,
                'block_name' => 'четвертый',
                'class' => 'block_adds_content',
                'title' => 'Lorem ipsum dolor sit amet. block 4',
                'img' => ''
            ],
            [
                'sort' => 1,
                'block_name' => 'пятый',
                'class' => 'block_adds_content',
                'title' => 'Lorem ipsum dolor sit amet. block 5',
                'img' => ''
            ],
        ];

        DB::table('landing_blocks')->insert($bloks);
    }
}
