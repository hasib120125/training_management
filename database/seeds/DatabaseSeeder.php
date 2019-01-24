<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(CompanyTableSeeder::class);
        // $this->call(StatusTableSeeder::class);
        // $this->call(PermissionsTableSeeder::class);
        // $this->call(RolesTableSeeder::class);
        // $this->call(UsersTableSeeder::class);
		 $this->call(TraingingTableSeeder::class);
    }
}
