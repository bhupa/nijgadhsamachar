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
      echo 'Ok';
        factory(App\User::class,30)->create();
        // $this->call(UserTableSeeder::class);
    }
}
