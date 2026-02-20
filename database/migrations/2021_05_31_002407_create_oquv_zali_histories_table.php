<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOquvZaliHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oquv_zali_histories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ozh_user_id');
            $table->integer('ozh_campus_id');
            $table->smallInteger('ozh_university_id');
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
        Schema::dropIfExists('oquv_zali_histories');
    }
}
