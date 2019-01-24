<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 250);
            $table->string('description', 3072)->nullable();
            $table->unsignedInteger('training_mode_id');
            $table->unsignedInteger('status_id');
            $table->datetime('started_at');
            $table->datetime('ended_at');
            $table->unsignedInteger('company_id');
            $table->unsignedInteger('training_type_id');
            $table->unsignedInteger('training_system')->nullable()->dafault(null);
            $table->unsignedInteger('training_brand')->nullable()->dafault(null);
            $table->timestamps();
            $table->unsignedInteger('created_by')-> nullable()->default(null);
            $table->unsignedInteger('updated_by')-> nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trainings');
    }
}
