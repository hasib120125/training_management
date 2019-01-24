<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_user', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('training_id');
            $table->datetime('started_at');
            $table->datetime('ended_at');
            $table->unsignedInteger('status_id');
            $table->datetime('completed_at')->nullable();
            $table->timestamps();
            $table->unsignedInteger('created_by')-> nullable()-> default(null);
            $table->unsignedInteger('updated_by')-> nullable()-> default(null);
        });
        Schema::table('training_user', function (Blueprint $table) {
            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade');
            $table->foreign('training_id')
            ->references('id')->on('trainings')
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
        Schema::table('training_user', function (Blueprint $table) {
           $table->dropForeign(['user_id']);
           $table->dropForeign(['training_id']);
        });
        Schema::dropIfExists('training_user');
    }
}
