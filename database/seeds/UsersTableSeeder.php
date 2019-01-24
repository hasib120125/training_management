<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Permission;
use App\Client;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Robi Admin',
                'username' => 'robi_admin',
                'email' => 'admin@robi.com',
                'is_default_password' => false,
                'is_locked' => false,
                'is_active' => true,
                'company_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'password' => bcrypt('admin')
            ],           
            [
                'name' => 'Robi Trainer',
                'username' => 'robi_trainer',
                'email' => 'trainer@robi.com',
                'is_default_password' => false,
                'is_locked' => false,
                'is_active' => true,
                'company_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'password' => bcrypt('trainer')
            ],           
        ];

        $roles = Role::get();
        foreach ($users as $key => $value) {
            $user = User::create($value);
            if($value['username'] == 'robi_admin')
            {
                $user->assignRole(Role::where('name', 'admin')->first());
            }
            else
            {
                $user->assignRole(Role::where('name', 'trainer')->first());
            }
        }
    }
}
