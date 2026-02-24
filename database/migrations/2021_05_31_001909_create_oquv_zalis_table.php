<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOquvZalisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oquv_zalis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('oz_user_id');
            $table->integer('oz_campus_id');
            $table->smallInteger('oz_university_id');
            $table->smallInteger('oz_status')->nullable();
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
        Schema::dropIfExists('oquv_zalis');
    }
}
