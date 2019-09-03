<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Employee;
use App\Position;
use App\User;
use Faker\Factory as FakerFactory;

$faker = new Faker\Generator();

$factory->define(Employee::class, function ($faker, $formats) {
    $faker->addProvider(new Faker\Provider\uk_UA\PhoneNumber($faker));
    $faker->addProvider(new Faker\Provider\en_US\Person($faker));
    $faker->addProvider(new Faker\Provider\Image($faker));
    $faker->addProvider(new Faker\Provider\DateTime($faker));
    $faker->addProvider(new Faker\Provider\Base($faker));
    $faker->addProvider(new Faker\Provider\Internet($faker));

    $firstname = $faker->firstname;
    $lastname = $faker->lastname;
    $name = $firstname . ' ' . $lastname;

    return [
        'name' => $name,
        'phone' => $faker->phoneNumber(),
        'photo' => $faker->imageUrl($width = 300, $height = 300),
        'email' => strtolower($firstname . $lastname) .'@' . $faker->freeEmailDomain(),
        'salary' => $faker->numberBetween($min = 0, $max = 500),
        // 'employed_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'employed_at' => $faker->dateTime($max = 'now', $timezone = null),
        'position_id' => Position::all()->random()->id,
        'admin_created_id' => User::all()->random()->id,
        'admin_updated_id' => User::all()->random()->id,
    ];
});
