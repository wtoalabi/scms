<?php

    use App\Platform\Accounts\Users\User;
    use App\Platform\Base\Authorization\Role;
    use Illuminate\Database\Seeder;
    use Faker\Factory as Faker;

    class UsersSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run() {
            $userRoleID = Role::where('title', 'User')->first()->id;
            $count = 20;
            $faker = Faker::create();
            {
                $user = factory(User::class)->create([
                    'email' => 'u@u.com',
                    'approved' => true,
                ]);
                $user->roles()->attach($userRoleID);
            }
            while ($count > 0) {
                $user = factory(User::class)->create();
                $user->roles()->attach($userRoleID);
                $count--;
            }
        }
    }
