<?php

use Illuminate\Database\Seeder;
use App\Training;
use App\TrainingMode;
use App\TrainingType;

class TraingingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TrainingMode::create([
            'id' => 1,
            'active_status' => '1',
            'name' => 'Others',
        ]);
        TrainingType::create([
            'id' => 1,
            'active_status' => '1',
            'name' => 'Others',
        ]);
        $trainings = [
            [
                'id' => 1,
                'title' => 'Others',
                'training_mode_id' => '1',
                'status_id' => '1',
                'active_status' => '1',
                'started_at' => now(),
                'ended_at' => now()->addYears(40),
                'company_id' => '1',
                'training_type_id' => '1',
            ],           
        ];
        foreach ($trainings as $key => $value) {
            Training::create($value);
        }
    }
}
