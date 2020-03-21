<?php
use Illuminate\Database\Seeder;
use App\Platform\Base\Authorization\Permission;

class PhonePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Permission::class)->create([
            'ability' => 'VIEW_PHONE',
            'model'=> 'Phone',
            'description' => 'View Phones.'
        ]);

        factory(Permission::class)->create([
            'ability' => 'ADD_PHONE',
            'model'=> 'Phone',
            'description' => 'Add new Phones.'
        ]);

        factory(Permission::class)->create([
            'ability' => 'UPDATE_PHONE',
            'model'=> 'Phone',
            'description' => 'Edit Phones.'
        ]);

        factory(Permission::class)->create([
            'ability' => 'DELETE_PHONE',
            'model'=> 'Phone',
            'description' => 'Delete Phones.'
        ]);
    }
}
