<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    public function run()
    {
        $networks = [
            [
                'post_type' => 'url',
                'url' => 'https://vk.com/',
                'icon' => asset('storage/admin/icons/soc_network/vk.svg')
            ],
            [
                'post_type' => 'url',
                'url' => 'https://www.youtube.com/?gl=RU',
                'icon' => asset('storage/admin/icons/soc_network/youtube.svg')
            ],
            [
                'post_type' => 'url',
                'url' => 'https://ru-ru.facebook.com/',
                'icon' => asset('storage/admin/icons/soc_network/facebook.svg')
            ],
        ];

        DB::table('settings')->insert($networks);

        $help = [
            'post_type' => 'help',
            'title' => 'Помощь и поддержка',
            'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime iste facere ducimus incidunt odit pariatur!',
            'content' => '<p class="text-normal">Lorem ipsum dolor sit amet.</p> <a href="mailto:" class="help_message">Написать в поддержку</a>',
        ];
        DB::table('settings')->insert($help);
    }
}
