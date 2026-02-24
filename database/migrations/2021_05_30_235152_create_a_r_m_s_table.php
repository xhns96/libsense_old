<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateARMSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('a_r_m_s', function (Blueprint $table) {
            $table->id();
            $table->string('campus_name');
            $table->string('campus_image')->nullable();
            $table->integer('campus_book_count')->nullable();
            $table->integer('campus_book_copy_count')->nullable();
            $table->smallInteger('campus_university_id');
            $table->smallInteger('campus_admins_count')->nullable();
            $table->string('campus_type')->nullable();
            $table->integer('campus_users_count')->nullable();
            $table->smallInteger('campus_daily_users_count')->nullable();
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
        Schema::dropIfExists('a_r_m_s');
    }
}
