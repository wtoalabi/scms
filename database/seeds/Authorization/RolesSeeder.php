<?php

    use App\Platform\Base\Authorization\AccountRole;
    use App\Platform\Base\Authorization\Role;
    use Illuminate\Database\Seeder;

    class RolesSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run() {

            factory(Role::class)->create([
                'title' => 'Super Admin',
                'description' => 'A super admin with all the privileges',
                'isCore' => true
            ]);

            $admin = factory(Role::class)->create([
                'title' => 'Admin',
                'description' => 'An admin with some privileges',
                'isCore' => true
            ]);

            $accountant = factory(Role::class)->create([
                'title' => 'Accountant',
                'description' => 'An admin with certain privileges relating to money management',
                'isCore' => true
            ]);


            factory(Role::class)->create([
                'title' => 'User',
                'description' => 'A user account. The default role for every registered users',
                'isCore' => true
            ]);

            factory(Role::class)->create([
                'title' => 'Deactivated',
                'description' => 'A user with a former, deactivated  account.exit',
                'isCore' => true
            ]);

            factory(Role::class)->create([
                'title' => 'Guest',
                'description' => 'A user with very limited rights',
                'isCore' => true
            ]);
        }
    }
