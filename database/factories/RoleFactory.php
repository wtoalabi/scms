<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Platform\Base\Authorization\Role;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'title' => 'Guest',
        'description' => 'Guest user with very few priviledge',
        'isCore' => false
    ];
});
