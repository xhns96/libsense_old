<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUniversitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('universities', function (Blueprint $table) {
            $table->id();
            $table->string('univer_name');
            $table->string('univer_short_name')->nullable();
            $table->smallInteger('univer_course_count')->nullable();
            $table->smallInteger('univer_sirtqi_course_count')->nullable();
            $table->smallInteger('univer_kechki_course_count')->nullable();
            $table->integer('univer_rating')->nullable();
            $table->string('univer_web_site')->nullable();
            $table->string('univer_logo')->nullable();
            $table->integer('univer_unique_book_count')->nullable();
            $table->integer('univer_unique_book_copy_count')->nullable();
            $table->integer('univer_users_count')->nullable();
            $table->smallInteger('univer_payment')->default(0);
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
        Schema::dropIfExists('universities');
    }
}
