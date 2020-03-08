<?php
  
  use App\Platform\Base\Authorization\Permission;
  use Illuminate\Database\Seeder;

class AdminPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Permission::class)->create([
            'ability' => 'VIEW_ADMIN',
            'model'=> 'Admin',
            'description' => 'View Admins.'
        ]);

        factory(Permission::class)->create([
            'ability' => 'ADD_ADMIN',
            'model'=> 'Admin',
            'description' => 'Add new Admins.'
        ]);

        factory(Permission::class)->create([
            'ability' => 'UPDATE_ADMIN',
            'model'=> 'Admin',
            'description' => 'Edit Admins.'
        ]);

        factory(Permission::class)->create([
            'ability' => 'DELETE_ADMIN',
            'model'=> 'Admin',
            'description' => 'Delete Admins.'
        ]);
    }
}
