<?php

    use App\Platform\Base\Helpers\Date\FormatTime;
    use App\Platform\Contacts\Contact;

    use App\Platform\Groups\Group;
    use App\Platform\Phones\Phone;
    use Faker\Factory as Faker;
    use Illuminate\Database\Seeder;

    class ContactsSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run() {
            $count = 350;
            $faker = Faker::create();
            $groups = Group::all()->pluck('id')->toArray();
            while ($count > 0) {
                [$birthday, $birthday_weight] = $this->getRandomBirthday();
                $contact = factory(Contact::class)->create([
                    'dateAdded' => FormatTime::GetRandomDateStamp(),
                    'birthday' => $birthday,
                    'birthday_weight' => $birthday_weight,
                ]);
                $groupsID = $faker->randomElements($groups,rand(1,3));
                $contact->groups()->sync($groupsID);
                $sampleGroup = $contact->groups->random();
                $contact->groups()->updateExistingPivot($sampleGroup->id,['default'=>true]);
                $randPhoneCount = rand(1,4);
                $default = true;
                while($randPhoneCount>0){
                    factory(Phone::class)->create([
                        'contact_id' => $contact->id,
                        'default' => $default
                    ]);
                    $default = false;
                    $randPhoneCount--;
                }
                $count--;
            }

        }

        private function getRandomBirthday() {
            $monthWeight = [
                1 => 100,
                2 => 150,
                3 => 200,
                4 => 250,
                5 => 300,
                6 => 350,
                7 => 400,
                8 => 450,
                9 => 500,
                10 => 550,
                11 => 600,
                12 => 650
            ];
            $faker = Faker::create();
            $day = $faker->randomElement(
                [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30]
            );
            $month = $faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]);
            $weight = ($monthWeight[$month] * $month) + ($day);
            return [['day'=>$day,'month'=>$month], $weight];
            //Contact::all()->sortBy(function($a){return $a->birthday['weight'];})->pluck(['birthday'])*/
        }

    }
