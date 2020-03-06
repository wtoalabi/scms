<?php

    use App\Platform\Accounts\Users\User;
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
            $count = 20;
            $faker = Faker::create();
            factory(User::class)->create([
              'email' => 'u@u.com',
              'approved' => true,
            ]);

            while ($count > 0) {
                $count--;
                factory(User::class)->create();
            }
            /*$users = User::all()->shuffle();

            $users->each(function ($user){
                factory(Phone::class, rand(1, 2))->create([
                    'phoneable_id' => $user->id,
                    'phoneable_type' => get_class($user)
                ]);

                factory(Address::class, rand(1,2))->create([
                    'addressable_id' => $user->id,
                    'addressable_type' => get_class($user)
                ]);
            });*/

        }
    }
