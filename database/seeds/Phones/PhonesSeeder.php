<?php

  use App\Platform\Phones\Phone;
  use Faker\Factory as Faker;
  use Illuminate\Database\Seeder;

class PhonesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
      //factory(Phone::class)->create();
    }
}
