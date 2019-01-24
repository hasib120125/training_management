<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 200);
            $table->string('username', 100)->unique();
            $table->string('email', 100)->nullable();
            $table->string('password', 200);
            $table->boolean('is_default_password')->default(true);
			$table->string('mobile',13)->nullable();
            $table->string('address',120)->nullable();
            $table->string('id_number',60)->nullable();
            $table->string('secondary_contact',50)->nullable();
            $table->boolean('is_locked')->default(false);
            $table->boolean('is_active')->default(true);
            $table->rememberToken();
            $table->unsignedInteger('company_id')->nullable();
            $table->timestamps();
            $table->unsignedInteger('created_by')-> nullable()-> default(null);
            $table->unsignedInteger('updated_by')-> nullable()-> default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
