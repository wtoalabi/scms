<?php
use Illuminate\Database\Seeder;
use App/Platform/Base/Authorization/Permission;

class ContactPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Permission::class)->create([
            'ability' => 'VIEW_CONTACT',
            'model'=> 'Contact',
            'description' => 'View Contacts.'
        ]);

        factory(Permission::class)->create([
            'ability' => 'ADD_CONTACT',
            'model'=> 'Contact',
            'description' => 'Add new Contacts.'
        ]);

        factory(Permission::class)->create([
            'ability' => 'UPDATE_CONTACT',
            'model'=> 'Contact',
            'description' => 'Edit Contacts.'
        ]);

        factory(Permission::class)->create([
            'ability' => 'DELETE_CONTACT',
            'model'=> 'Contact',
            'description' => 'Delete Contacts.'
        ]);
    }
}
