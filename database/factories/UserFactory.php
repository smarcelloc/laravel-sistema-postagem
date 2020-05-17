<?php
/**
 * @link https://github.com/fzaninotto/Faker
 */

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
    $datetime = $faker->dateTimeBetween('-2 years');

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        //'email_verified_at' => now(),
        'password' => Hash::make('admin@123'),
        //'remember_token' => Str::random(10),
        'timezone' => $faker->timezone,
        'created_at' => $datetime,
        'updated_at' => $datetime
    ];
});
