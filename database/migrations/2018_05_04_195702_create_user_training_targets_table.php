<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTrainingTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_targets', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('started_at');
            $table->datetime('ended_at');
            $table->integer('target_hour');
            $table->integer('achieved_hour')->nullable()->default(0);
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->unsignedInteger('created_by')-> nullable()-> default(null);
            $table->unsignedInteger('updated_by')-> nullable()-> default(null);
        });
        Schema::table('training_targets', function (Blueprint $table) {
            $table->foreign('user_id')
            ->references('id')->on('users')
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
        Schema::table('training_targets', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('training_targets');
    }
}
