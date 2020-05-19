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
    }
}
