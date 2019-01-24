<?php

use Illuminate\Database\Seeder;
use App\Company;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = [
            [
                'name' => 'Robi'
            ],
            [
                'name' => 'Airtel'
            ]
        ];
        foreach ($companies as $company) {
            Company::create($company);
        }
    }
}
