<?php
use Illuminate\Database\Seeder;
use App\Platform\Base\Authorization\Permission;

class GroupPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Permission::class)->create([
            'ability' => 'VIEW_GROUP',
            'model'=> 'Group',
            'description' => 'View Groups.'
        ]);

        factory(Permission::class)->create([
            'ability' => 'ADD_GROUP',
            'model'=> 'Group',
            'description' => 'Add new Groups.'
        ]);

        factory(Permission::class)->create([
            'ability' => 'UPDATE_GROUP',
            'model'=> 'Group',
            'description' => 'Edit Groups.'
        ]);

        factory(Permission::class)->create([
            'ability' => 'DELETE_GROUP',
            'model'=> 'Group',
            'description' => 'Delete Groups.'
        ]);
    }
}
