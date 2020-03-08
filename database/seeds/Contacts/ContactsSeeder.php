<?php

  use App\Platform\Contacts\Contact;
  use Faker\Factory as Faker;
  use Illuminate\Database\Seeder;

class ContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
      factory(Contact::class)->create();
    }
}
