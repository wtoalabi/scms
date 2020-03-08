<?php

use Illuminate\Database\Seeder;

class InitialSetUp extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(PermissionsSetup::class);
        //$this->call(SuperAdmin::class);
    }
}
