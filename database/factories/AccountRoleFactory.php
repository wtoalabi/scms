<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */
  
  use App\Platform\Accounts\Users\User;
  use App\Platform\Base\Authorization\AccountRole;
use Faker\Generator as Faker;
  
  $factory->define(AccountRole::class, function (Faker $faker) {
    return [
        'role_id' => 1,
        'account_id' => 1,
        'account_type' => get_class(new User())
    ];
});