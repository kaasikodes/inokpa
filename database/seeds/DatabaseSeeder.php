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
        //$this->call(UsersTableSeeder::class);
        //$this->call(CoursesTableSeeder::class);
        //$this->call(Course_User_TableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
       

    }
}
