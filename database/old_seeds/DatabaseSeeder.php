<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(TourCategoryTableSeeder::class);
        $this->call(TourTableSeeder::class);
        $this->call(CategoryTourTourTableSeeder::class);
        $this->call(PageTableSeeder::class);
        $this->call(CategoryPostTableSeeder::class);
        $this->call(PostTableSeeder::class);
        $this->call(TourUserTableSeeder::class);
        $this->call(ProfileTableSeeder::class);
        $this->call(UserCommentsTableSeeder::class);
        $this->call(OrganizerLeaderTableSeeder::class);
        $this->call(TourVariantTableSeeder::class);
    }
}
