<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Str;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'nickname' => $faker->name,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'position_id' => random_int(1, 4)
    ];
});

$factory->define(Order::class, function (Faker $faker) {
    return [
        'oid' => random_int(2, 2000000),
        'recipient_information' => '123',
        'note' => '123',
        'sofa_cover_id' => 1,
        'sofa_cover_item_id' => 1,
        'user_id' => 2,
    ];
});
