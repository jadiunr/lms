<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PostsTableSeeder::class);
        $this->call(ThreadsTableSeeder::class);
        // $this->call(UsersTableSeeder::class);
        $this->call(users::class);
        $this->call(ProblemsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ExamsTableSeeder::class);
        $this->call(BlocksTableSeeder::class);
        $this->call(ChangelogsTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
    }
}
