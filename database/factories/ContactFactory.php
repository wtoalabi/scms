<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Platform\Contacts\Contact;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'birthday' => ['day' => 13, 'month' => 10],
        'dateAdded' => $faker->dateTimeBetween('-12 months', '-2 months'),
        'address' => $faker->address
    ];
});

