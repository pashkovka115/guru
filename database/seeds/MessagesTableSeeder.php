<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class MessagesTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $messages = [];
        for ($i = 0; $i < 20; $i++){
            $message = [
                'name' => $faker->name,
                'leader_id' => random_int(3, 10),
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'message' => $faker->paragraphs(10, true)
            ];
            $messages[] = $message;
        }

        DB::table('messages')->insert($messages);
    }
}

