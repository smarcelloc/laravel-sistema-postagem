<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\News;
use Faker\Generator as Faker;
use App\User;

$factory->define(News::class, function (Faker $faker) {

    $users = User::all()->pluck('id')->toArray();
    $datetime = $faker->dateTimeBetween('-2 years');
    return [
        'title' => $faker->sentence(3),
        'description' => $faker->text(2000),
        'user_id' => $faker->randomElement($users),
        'created_at' => $datetime,
        'updated_at' => $datetime
    ];
});
