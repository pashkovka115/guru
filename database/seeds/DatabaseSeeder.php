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
        $this->call(ProfileTableSeeder::class);
        $this->call(CategoryToursTableSeeder::class);
        $this->call(TourTableSeeder::class);
        $this->call(TourVariantTableSeeder::class);
        $this->call(TourLeaderTableSeeder::class);
        $this->call(OrganizerLeaderTableSeeder::class);
        $this->call(ToursTagsTableSeeder::class);
        $this->call(TourTagsTourTableSeeder::class);
        $this->call(TourRatingTableSeeder::class);
        $this->call(UserCommentsTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(PostTableSeeder::class);
        $this->call(PageTableSeeder::class);

//        $this->call(CategoryPostTableSeeder::class);
//        $this->call(TourUserTableSeeder::class);
//        $this->call(OrganizerLeaderTableSeeder::class);
    }
}
