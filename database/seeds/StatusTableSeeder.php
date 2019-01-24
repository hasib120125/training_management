<?php

use Illuminate\Database\Seeder;
use App\Status;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            [
                'id' => 1,
                'name' => 'open',
                'display_name' => 'Open',
                'display_order' => 1,
                'whose' => 'training'
            ],
            [
                'id' => 2,
                'name' => 'close',
                'display_name' => 'Close',
                'display_order' => 2,
                'whose' => 'training'
            ],
            [
                'id' => 3,
                'name' => 'open',
                'display_name' => 'Open',
                'display_order' => 1,
                'whose' => 'training_user'
            ],
            [
                'id' => 4,
                'name' => 'close',
                'display_name' => 'Close',
                'display_order' => 2,
                'whose' => 'training_user'
            ],
            [
                'id' => 5,
                'name' => 'pending',
                'display_name' => 'Pending',
                'display_order' => 1,
                'whose' => 'training_history'
            ],
            [
                'id' => 6,
                'name' => 'approved',
                'display_name' => 'Approved',
                'display_order' => 2,
                'whose' => 'training_history'
            ],
            [
                'id' => 7,
                'name' => 'rejected',
                'display_name' => 'rejected',
                'display_order' => 3,
                'whose' => 'training_history'
            ]
        ];
        foreach ($statuses as $status) {
            Status::create($status);
        }
    }
}
