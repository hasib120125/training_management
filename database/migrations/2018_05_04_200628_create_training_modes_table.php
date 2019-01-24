<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingModesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_modes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
            $table->unsignedInteger('created_by')-> nullable()-> default(null);
            $table->unsignedInteger('updated_by')-> nullable()-> default(null);
        });

        Schema::table('trainings', function (Blueprint $table) {
            $table->foreign('training_mode_id')
            ->references('id')->on('training_modes')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trainings', function (Blueprint $table) {
            $table->dropForeign(['training_mode_id']);
        });
        Schema::dropIfExists('training_modes');
    }
}
