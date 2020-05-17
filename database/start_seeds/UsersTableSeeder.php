<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UsersTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $email_root = 'developer.00@list.ru';
        $users = [
            [
                'name' => 'Сергей Смирнов',
                'email' => $email_root,
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(),
                'password' => bcrypt('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        mkdir(base_path('storage/app/public/users/' . md5($email_root) . '/img'), 0755, true);
        file_put_contents(base_path('storage/app/public/users/' . md5($email_root) . '/img/email.txt'), $email_root);

        DB::table('users')->insert($users);
    }

}
