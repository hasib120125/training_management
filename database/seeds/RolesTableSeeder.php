<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'admin',
                'display_name' => 'Admin',
                'guard_name' => 'admin'
            ],
            [
                'name' => 'trainer',
                'display_name' => 'Trainer',
                'guard_name' => 'admin'
            ]
        ];

        $permissions = Permission::get();
        foreach ($roles as $key => $value) {
            $role = Role::create($value);
            if($value['name'] == 'admin'){
              foreach ($permissions as $permission) {
                $role->givePermissionTo($permission);
              }
            }
        }
    }
}
