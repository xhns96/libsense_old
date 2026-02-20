<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('email',64)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->smallInteger('user_university_id')->nullable();
            $table->integer('user_faculty_id')->nullable();
            $table->integer('user_specialty_id')->nullable();
            $table->integer('user_course_number')->nullable();
            $table->integer('user_group_id')->nullable();
            $table->string('user_passport_id')->nullable();
            $table->string('user_phone')->nullable();
            $table->string('user_type')->default('student');
            $table->string('user_status')->default('offline');
            $table->string('user_profile_status')->default('inactive');
            $table->integer('user_borrow_count')->default(0);
            $table->integer('user_down_count')->default(0);
            $table->integer('user_borrow_expired_count')->default(0);
            $table->string('user_profile_image')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->string('hashed_user_id')->nullable();
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
