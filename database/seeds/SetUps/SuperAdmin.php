<?php
  
  use App\Platform\Accounts\Admins\Admin;
  use App\Platform\Base\Authorization\Permission;
  use App\Platform\Base\Authorization\Role;
  use Illuminate\Database\Seeder;

class SuperAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::first();
        $admin = factory(Admin::class)->create([
          'isSuper' => true
        ]);
        $admin->roles()->attach($role->id);
  
      $permissions = Permission::all()->pluck('id');
      foreach($permissions as $permission){
        $role->permissions()->attach($permission);
      }
    }
}
