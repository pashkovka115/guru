<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UserCommentsTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $us_ids = \App\Models\User::all('id')->keyBy('id')->toArray();
        $comments = [];
        for ($i = 0; $i < 20; $i++) {
            $comment = [
                'user_id' => array_rand($us_ids),
                'author_id' => 1,
                'good' => 1,
                'title' => $faker->words(3, true),
                'comment' => $faker->paragraph(10),
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $comments[] = $comment;
        }
        DB::table('users_comments')->insert($comments);
    }
}


