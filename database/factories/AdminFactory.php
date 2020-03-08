<?php

/* @var $factory Factory */

use App\Platform\Accounts\Admins\Admin;
use Faker\Generator as Faker;
    use Illuminate\Database\Eloquent\Factory;
    use Illuminate\Support\Str;

  $factory->define(Admin::class, function (Faker $faker) {
    return [
      'name' => $faker->name,
      'email' => $faker->email,
      'email_verified_at' => now(),
      'password' => bcrypt('abc123'),
      'remember_token' => Str::random(10),
      'approved' => true,
    ];
});
