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
        $categories = \Modules\Admin\Models\CategoryPost::all('id')->toArray();

        $posts = [];
        for ($i = 0; $i < 50; $i++) {
            $post = [
                'title' => implode(' ', $faker->words()),
                'excerpt' => $faker->paragraph(),
                'content' => $faker->paragraph(10),
                'user_id' => $users[array_rand($users)]['id'],
                'category_post_id' => $categories[array_rand($categories)]['id'],
                'created_at' => now(),
                'updated_at' => now()
            ];
            $posts[] = $post;
        }

        DB::table('posts')->insert($posts);
    }
}





















