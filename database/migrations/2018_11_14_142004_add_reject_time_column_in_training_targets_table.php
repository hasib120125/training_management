<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRejectTimeColumnInTrainingTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('training_targets', function (Blueprint $table) {
            $table->string('reject_hours')->nullable()->after('achieved_hour');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('training_targets', function (Blueprint $table) {
            $table->dropColumn('reject_hours');
        });
    }
}
