<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Model\Index\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'mobile' => '17625597538',
        'password' => bcrypt("123456"), // secret
        // 'remember_token' => str_random(10),
    ];
});

$factory->define(App\Model\Admin\Admin::class, function (Faker $faker) {
    static $password;
    return [
        'username' => $faker->username,
        'password' => $password?:$password=bcrypt("123456"), // secret
        'email'    => $faker->email,
    ];
});

$factory->define(App\Model\Index\GoodsCat::class, function (Faker $faker) {
    static $password;
    return [
        'cat_name' => $faker->username,
        'cat_id'    => '1',
    ];
});

