<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
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

        for ($i = 1; $i < 30; $i++) {
            $email = $faker->unique()->safeEmail;
            $user = [
                'name' => $faker->name,
                'email' => $email,
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(),
                'password' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            if ($i < 20){
                $user['password'] = bcrypt('12345678');
            }
            $users[] = $user;
            mkdir(base_path('storage/app/public/users/' . md5($email) . '/img'), 0755, true);
            file_put_contents(base_path('storage/app/public/users/' . md5($email) . '/img/email.txt'), $email);
        }

        DB::table('users')->insert($users);
    }

}
