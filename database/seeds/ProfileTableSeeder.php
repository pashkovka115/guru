<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProfileTableSeeder extends Seeder
{

    public function run(Faker $faker)
    {
        $users = \App\Models\User::with('profile')->get();
        $i = 0;
        foreach ($users as $user){
            if ($i <= 1){
                $type_user = 'organizer';
            }elseif ($i > 1 and $i < 8){
                $type_user = 'leader';
            }else{
                $type_user = 'user';
            }


            $raiting = round(mt_rand(0, 5) + (mt_rand(0, 10) / 10), 1);
            if ($raiting > 5)
                $raiting = 5;

            $user->profile()->create([
                'user_id'=> $user->id,
                'auth' => ($i % 2 == 0 or $i == 1) ? '1' : '0',
//                'type_user'=>$type_user,
                'avatar' => '['.json_encode(asset('assets/site/images/avatar.jpg')).']',
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

