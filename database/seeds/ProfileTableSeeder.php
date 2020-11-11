<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProfileTableSeeder extends Seeder
{

    public function run(Faker $faker)
    {
        $users = \App\Models\User::with('profile')->where('id', '>', 0)->get();

        $i = 0;
        foreach ($users as $user){
            $user_id = $user->id;

            if ($user_id == 1){
                $type_user = 'organizer';
            }elseif ($user_id == 2){
//                $type_user = 'user';
                continue;
            }else{
                $type_user = 'leader';
            }


            $raiting = round(mt_rand(0, 5) + (mt_rand(0, 10) / 10), 1);
            if ($raiting > 5)
                $raiting = 5;


            $user->profile()->create([
                'user_id'=> $user_id,
                'url' => \Illuminate\Support\Str::random(10),
                'avatar' => '['.json_encode(asset('assets/site/images/avatar.jpg')).']',
                'type_user' => $type_user,
                'raiting'=> $raiting,
                'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum fugit incidunt quasi deserunt, libero placeat.',
                'description'=> $faker->paragraph(10),
                'gallery' => json_encode([
                    asset('assets/site/images/home_bg.jpg'),
                    asset('assets/site/images/home_bg.png'),
                    asset('assets/site/images/home_bg_new.jpg'),
                ]),
                'country'=> $faker->country,
                'city'=> $faker->city,
            ]);
            $i++;
        }

    }
}

