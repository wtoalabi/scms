<?php

    use App\Platform\Groups\Group;
    use Faker\Factory as Faker;
    use Illuminate\Database\Seeder;

    class GroupsSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run() {
            $groups = collect(['Ushering', 'Choir', 'Technical', 'Sanctuary']);
            $faker = Faker::create();
            $groups->each(function ($group) use ($faker) {
                factory(Group::class)->create([
                    'user_id' => 1,
                    'name' => $group
                ]);
            });
        }
    }
