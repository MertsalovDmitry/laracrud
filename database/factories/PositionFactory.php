<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Position;
use App\User;
use Faker\Generator as Faker;

$factory->define(Position::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->jobTitle,
        'admin_created_id' => User::all()->random()->id,
        'admin_updated_id' => User::all()->random()->id,
    ];
});
