<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('training_id');
			$table->string('training_type_id')->nullable();
            $table->unsignedInteger('training_mode_id');
            $table->unsignedInteger('training_user_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('no_of_trainees');
            $table->unsignedInteger('user_duration');
            $table->unsignedInteger('approved_duration');
            $table->unsignedInteger('status_id');
            $table->datetime('started_at');
            $table->datetime('ended_at');
            $table->string('location', 1000)->nullable();
            $table->unsignedInteger('training_audience_id')->nullable();
            $table->string('description', 3072)->nullable();
            $table->datetime('created_at');
            $table->datetime('updated_at');
            $table->unsignedInteger('created_by')->nullable()-> default(null);
            $table->unsignedInteger('updated_by')->nullable()-> default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('training_histories');
    }
}
