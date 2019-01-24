<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = [
             [
                'name' => 'user-list',
                'display_name' => 'List Users',
                'category' => 'user',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'user-create',
                'display_name' => 'Create Users',
                'category' => 'user',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'user-edit',
                'display_name' => 'Edit Users',
                'category' => 'user',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'user-delete',
                'display_name' => 'Delete Users',
                'category' => 'user',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'training-list',
                'display_name' => 'List trainings',
                'category' => 'training',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'training-create',
                'display_name' => 'Create trainings',
                'category' => 'training',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'training-edit',
                'display_name' => 'Edit trainings',
                'category' => 'training',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'training-delete',
                'display_name' => 'Delete trainings',
                'category' => 'training',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'training-assign',
                'display_name' => 'Assign trainings',
                'category' => 'training',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'training-target-set',
                'display_name' => 'Set training target',
                'category' => 'training',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'training-mode-list',
                'display_name' => 'List training Modes',
                'category' => 'training-mode',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'training-mode-create',
                'display_name' => 'Create training Mode',
                'category' => 'training-mode',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'training-mode-edit',
                'display_name' => 'Edit training Mode',
                'category' => 'training-mode',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'training-mode-delete',
                'display_name' => 'Delete training Mode',
                'category' => 'training-mode',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'training-type-list',
                'display_name' => 'List training Type',
                'category' => 'training-type',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'training-type-create',
                'display_name' => 'Create Training Type',
                'category' => 'training-type',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'training-type-edit',
                'display_name' => 'Edit Training Type',
                'category' => 'training-type',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'training-type-delete',
                'display_name' => 'Delete training Type',
                'category' => 'training-type',
                'guard_name' => 'admin',
            ],
        ];

        foreach ($permission as $key => $value) {
            Permission::create($value);
        }
    }
}
