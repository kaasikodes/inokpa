<?php

use Illuminate\Database\Seeder;

class Course_User_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       foreach (App\User::all() as $user) {
           $user->courses()->save(

            factory(App\Course::class, rand(1,5))->make()



           );
           # code...
       }
    }
}
