<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->text('book_name');
            $table->string('book_author');
            $table->string('book_isbn')->nullable();
            $table->smallInteger('book_year');
            $table->string('book_publishing');
            $table->smallInteger('book_page_count');
            $table->integer('book_copy_count');
            $table->integer('book_copy_count_now')->default(0);
            $table->string('book_type');
            $table->string('book_for_home');
            $table->string('book_lang');
            $table->string('book_category');
            $table->string('book_science_type');
            $table->integer('book_campus_id');
            $table->integer('book_added_admin_id')->nullable();
            $table->smallInteger('book_university_id')->nullable();
            $table->integer('book_rating')->default(0);
            $table->string('book_image')->nullable();
            $table->string('book_file')->nullable();
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
        Schema::dropIfExists('books');
    }
}
