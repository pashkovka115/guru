<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $users = \App\Models\User::all('id')->toArray();

        $posts = [];
        for ($i = 0; $i < 50; $i++) {
            $post = [
                'user_id' => $users[array_rand($users)]['id'],
                'title' => implode(' ', $faker->words()),
                'excerpt' => $faker->paragraph(),
                'content' => $faker->paragraphs(10, true),
                'img' => asset('assets/site/images/home_bg_new.jpg'),
                'created_at' => now(),
                'updated_at' => now()
            ];
            $posts[] = $post;
        }

        DB::table('posts')->insert($posts);
    }
}





















