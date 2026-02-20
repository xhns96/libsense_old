<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbonementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abonements', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ab_user_id');
            $table->integer('ab_campus_id');
            $table->smallInteger('ab_university_id');
            $table->smallInteger('ab_status')->nullable();
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
        Schema::dropIfExists('abonements');
    }
}
