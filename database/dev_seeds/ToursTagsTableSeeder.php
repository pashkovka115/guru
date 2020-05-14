<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ToursTagsTableSeeder extends Seeder
{
    public $tableName = 'tours_tags';


    public function run(Faker $faker)
    {
        $tags = [];
        for ($i = 0; $i < 50; $i++) {
            $tag = ['tag' => $faker->word()];
            $tags[] = $tag;
        }

        DB::table($this->tableName)->insert($tags);
    }
}
