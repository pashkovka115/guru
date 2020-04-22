<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $pages = [];
        for ($i=0; $i<5; $i++){
            $page = [
                'title' => implode(' ', $faker->words(5)),
                'content' => $faker->paragraph(10)
            ];

            $pages[] = $page;
        }

        DB::table('pages')->insert($pages);
    }
}
