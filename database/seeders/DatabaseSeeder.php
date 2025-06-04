<?php

namespace Database\Seeders;

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
        $this->call(UserTableSeeder::class);
        $this->call(ChatsTableSeeder::class);
        $this->call(FollowersTableSeeder::class);
        $this->call(LikesTableSeeder::class);
        $this->call(PublicationsTableSeeder::class);
        $this->call(PublicationImagesTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(NotificationsTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(RolePermissionsTableSeeder::class);
    }
}
