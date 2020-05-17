<?php

use Illuminate\Database\Seeder;

class AboutUsTableSeeder extends Seeder
{
//$table->enum('post_type', ['title', 'content', 'people', 'progress']);
//$table->integer('sort')->default(0);
//$table->string('title')->nullable();
//$table->text('excerpt')->nullable();
//$table->longText('content')->nullable();
//$table->string('img')->nullable();


    public function run()
    {
        // titles
        DB::table('about')->insert([
            'title' => 'О нас',
            'post_type' => 'title'
            ]);

        DB::table('about')->insert([
            'post_type' => 'content',
            'content' => file_get_contents(__DIR__ . '/about.txt'),
            ]);

        $people = [];
        for ($i = 0; $i < 6; $i++){
            $person = [
                'post_type' => 'people',
                'title' => 'Имя Фамилия',
                'excerpt' => 'Должность',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa blanditiis asperiores harum? Enim, laboriosam tempora.',
                'img' => asset('assets/site/images/autor_text.png')
            ];
            $people[] = $person;
        }

        DB::table('about')->insert($people);

        $progresies = [];
        for ($i = 0; $i < 4; $i++){
            $progress = [
                'post_type' => 'progress',
                'title' => '2500+',
                'excerpt' => 'Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.'
            ];
            $progresies[] = $progress;
        }
        DB::table('about')->insert($progresies);
    }
}
