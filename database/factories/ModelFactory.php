<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
  $userTypes = ['Admin','Reporter'];
    return [
        'firstname' => $faker->name,
        'lastname' => $faker->name,
        'user_type' => $userTypes[array_rand($userTypes)],
        'email' => $faker->email,
        'password' => bcrypt('test'),
        'remember_token' => str_random(10),
        'contact' => $faker->phoneNumber,
        'address' => $faker->address,
        'gender' => 'Male'
    ];
});

$factory->define(App\News::class, function(Faker\Generator $faker){
    $files = scandir(public_path('news'));
    $category = App\category::all()->random()->lists('category_id')->toArray();
    return [
      'create_by' => 1,
      'title' => $faker->sentence,
      'body' => $faker->paragraph,
      'image' => $files[array_rand($files)],
      'status' => 0,
      'category_type' => $category[array_rand($category)]
    ];
});
