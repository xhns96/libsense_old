<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email',64)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('admin_university_id')->nullable();
            $table->integer('admin_campus_id')->nullable();
            $table->string('admin_phone_number')->nullable();
            $table->string('admin_profile_image')->nullable();
            $table->integer('admin_added_book_count')->nullable();
            $table->string('admin_iss')->default('no');
            $table->string('admin_status')->default('offline');
            $table->string('admin_profile_status')->default('inactive');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
