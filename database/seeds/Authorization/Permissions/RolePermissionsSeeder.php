<?php
use Illuminate\Database\Seeder;
use App\Platform\Base\Authorization\Permission;


class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Permission::class)->create([
            'ability' => 'VIEW_ROLE',
            'model'=> 'Role',
            'description' => 'View Roles.'
        ]);

        factory(Permission::class)->create([
            'ability' => 'ADD_ROLE',
            'model'=> 'Role',
            'description' => 'Add new Roles.'
        ]);

        factory(Permission::class)->create([
            'ability' => 'UPDATE_ROLE',
            'model'=> 'Role',
            'description' => 'Edit Roles.'
        ]);

        factory(Permission::class)->create([
            'ability' => 'DELETE_ROLE',
            'model'=> 'Role',
            'description' => 'Delete Roles.'
        ]);
    }
}
