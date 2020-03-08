<?php

/* @var $factory Factory */

use App\Platform\Admin\Settings\Setting;
  use App\Platform\Admin\Settings\SettingsGroup;
  use Faker\Generator as Faker;
  use Illuminate\Database\Eloquent\Factory;
  
  $factory->define(Setting::class, function (Faker $faker) {
    return [
        'settings_group_id' => factory(SettingsGroup::class)->create()->id,
        'setting' => 'send_mail',
        'value' => 'true',
    ];
});
