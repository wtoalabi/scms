<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Platform\Admin\Settings\SettingsGroup;
use Faker\Generator as Faker;

$factory->define(SettingsGroup::class, function (Faker $faker) {
    return [
        'name' => "Product"
    ];
});
