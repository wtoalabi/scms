<?php
  
  use App\Platform\Base\Authorization\Permission;
  use Illuminate\Database\Seeder;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Permission::class)->create([
            'ability' => 'VIEW_USER',
            'model'=> 'User',
            'description' => 'View Users.'
        ]);

        factory(Permission::class)->create([
            'ability' => 'ADD_USER',
            'model'=> 'User',
            'description' => 'Add new Users.'
        ]);

        factory(Permission::class)->create([
            'ability' => 'UPDATE_USER',
            'model'=> 'User',
            'description' => 'Edit Users.'
        ]);

        factory(Permission::class)->create([
            'ability' => 'DELETE_USER',
            'model'=> 'User',
            'description' => 'Delete Users.'
        ]);
    }
}
