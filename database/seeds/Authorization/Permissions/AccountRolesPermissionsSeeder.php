<?php
use Illuminate\Database\Seeder;
use App\Platform\Base\Authorization\Permission;

class AccountRolesPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Permission::class)->create([
            'ability' => 'VIEW_ACCOUNT_ROLE',
            'model'=> 'Account Role',
            'description' => 'View Account Role.'
        ]);

        factory(Permission::class)->create([
            'ability' => 'ADD_ACCOUNT_ROLE',
            'model'=> 'Account Role',
            'description' => 'Add new Account Role.'
        ]);

        factory(Permission::class)->create([
            'ability' => 'UPDATE_ACCOUNT_ROLE',
            'model'=> 'Account Role',
            'description' => 'Edit Account Role.'
        ]);

        factory(Permission::class)->create([
            'ability' => 'DELETE_ACCOUNT_ROLE',
            'model'=> 'Account Role',
            'description' => 'Delete Account Role.'
        ]);
    }
}
