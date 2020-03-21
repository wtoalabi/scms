<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Platform\Phones\Phone;
use Faker\Generator as Faker;

$factory->define(Phone::class, function (Faker $faker) {
    return [
        'contact_id' => 1,
        'prefix' => 234,
        'number' => rand(11999999999,99999999999),
        'default' => false,

    ];
});
