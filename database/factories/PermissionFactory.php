<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */
  
  use App\Platform\Base\Authorization\Permission;
  use Faker\Generator as Faker;

$factory->define(Permission::class, function (Faker $faker) {
  return [
    'ability' => "CAN_VIEW",
    'model' => "User",
    'description' => 'Can view user',
  ];
});
