<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaidToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string("user_university_name")->nullable();
            $table->string("user_faculty_name")->nullable();
            $table->string("user_specialty_name")->nullable();
            $table->string("user_course_name")->nullable();
            $table->string("user_group_name")->nullable();
            $table->string("passport_number")->nullable();
            $table->string("passport_pin")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
