<?php

    use Illuminate\Database\Seeder;

    class DatabaseSeeder extends Seeder
    {
        /**
         * Seed the application's database.
         *
         * @return void
         */
        public function run() {
            // $this->call(UsersTableSeeder::class);
            $this->call(InitialSetUp::class);
            $this->call(UsersSeeder::class);
            $this->call(GroupsSeeder::class);
            $this->call(ContactsSeeder::class);
      $this->call(PhonesSeeder::class);
            //$this->call(SettingsSeeder::class);
            // $this->call(AdminsSeeder::class);
        }
    }
