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
        $email_root1 = 'developer.00@list.ru';
        $email_root2 = 'pariss8@mail.ru';
        $users = [
            [
                'name' => 'Сергей Смирнов Организатор',
                'email' => $email_root1,
                'email_verified_at' => now(),
                'auth' => '1',
                'request' => '0',
                'remember_token' => \Illuminate\Support\Str::random(),
                'password' => bcrypt('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Сергей Смирнов Юзер',
                'email' => $email_root2,
                'email_verified_at' => now(),
                'auth' => '0',
                'request' => '0',
                'remember_token' => \Illuminate\Support\Str::random(),
                'password' => bcrypt('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        mkdir(base_path('storage/app/public/users/' . md5($email_root1) . '/img'), 0755, true);
        file_put_contents(base_path('storage/app/public/users/' . md5($email_root1) . '/img/email.txt'), $email_root1);

        for ($i = 1; $i < 10; $i++) {
            $auth = ($i % 2 == 0 or $i == 1) ? '1' : '0';
            $request = (boolean)((int)$auth) ? '0' : '1';
            $email = $faker->unique()->safeEmail;
            $user = [
                'name' => $faker->name,
                'email' => $email,
                'auth' => $auth,
                'request' => $request,
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
