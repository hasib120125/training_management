<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTrainingSystemTrainingBrandsToTrainingHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('training_histories', function (Blueprint $table) {
            $table->unsignedInteger('training_system_id')-> nullable()-> default(null);
            $table->unsignedInteger('training_brand_id')-> nullable()-> default(null);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('training_histories', function (Blueprint $table) {
            $table->dropColumn('training_system_id');
            $table->dropColumn('training_brand_id');
        });
    }
}
