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
      $totalUser = App\User::count();

        $user = App\User::firstOrNew([
          'firstname'=>'admin',
          'lastname' => 'admin',
          'user_type' => 'Admin',
          'email' => 'admin@admin.com',
          'password' => bcrypt('test'),
          'contact' => '23232',
          'address' => 'Kathmandu',
          'gender' => 'Male'
        ]);

        if($totalUser == 0):
        $category = ['Education','Sports','Entertainment','Politics','International','Fashoin'];

        foreach ($category as  $category)
        {
            $cat = new App\category;
            $cat->category_name = $category;
            $cat->save();
        }
      endif;
        factory(App\User::class,30)->create();
        factory(App\News::class,30)->create();
    }
}
