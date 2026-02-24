<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrow_histories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('borrow_book_id');
            $table->bigInteger('borrow_user_id');
            $table->smallInteger('borrow_university_id');
            $table->string('borrow_status');
            $table->bigInteger('borrow_returned_admin_id');
            $table->string('borrow_book_inv_number')->nullable();
            $table->date('borrow_when_take');
            $table->date('borrow_when_must_return');
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
        Schema::dropIfExists('borrow_histories');
    }
}
