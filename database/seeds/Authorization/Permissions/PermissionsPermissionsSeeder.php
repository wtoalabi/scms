<?php
use Illuminate\Database\Seeder;
use App\Platform\Base\Authorization\Permission;

class PermissionsPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Permission::class)->create([
            'ability' => 'VIEW_PERMISSION',
            'model'=> 'Permission',
            'description' => 'View Permissions.'
        ]);

        factory(Permission::class)->create([
            'ability' => 'ADD_PERMISSION',
            'model'=> 'Permission',
            'description' => 'Add new Permissions.'
        ]);

        factory(Permission::class)->create([
            'ability' => 'UPDATE_PERMISSION',
            'model'=> 'Permission',
            'description' => 'Edit Permissions.'
        ]);

        factory(Permission::class)->create([
            'ability' => 'DELETE_PERMISSION',
            'model'=> 'Permission',
            'description' => 'Delete Permissions.'
        ]);
    }
}
