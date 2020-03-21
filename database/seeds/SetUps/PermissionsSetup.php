<?php

    use App\Platform\Base\Authorization\Permission;
    use Illuminate\Database\Seeder;

class PermissionsSetup extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
      $this->call(PhonePermissionSeeder::class);
      $this->call(GroupPermissionSeeder::class);
      $this->call(ContactPermissionSeeder::class);
      $this->call(PermissionsPermissionSeeder::class);
      $this->call(AccountRolesPermissionSeeder::class);
      $this->call(RolePermissionSeeder::class);
      $this->call(AdminPermissionSeeder::class);
      $this->call(UserPermissionSeeder::class);
        factory(Permission::class)->create([
            'ability' => 'VIEW_ACTIVITY', 'model'=> 'Activity', 'description' => 'View Activities'
        ]);
    }
}
