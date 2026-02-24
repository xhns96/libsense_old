<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_books', function (Blueprint $table) {
            $table->id();
            $table->string('ebook_name');
            $table->string('ebook_author');
            $table->string('ebook_isbn')->nullable();
            $table->smallInteger('ebook_year');
            $table->string('ebook_publishing');
            $table->smallInteger('ebook_page_count');
            $table->string('ebook_type');
            $table->string('ebook_lang');
            $table->string('ebook_category');
            $table->string('ebook_science_type');
            $table->integer('ebook_campus_id');
            $table->integer('ebook_added_admin_id');
            $table->smallInteger('ebook_university_id');
            $table->integer('ebook_rating')->default(0);
            $table->string('ebook_image')->nullable();
            $table->string('ebook_file')->nullable();
            $table->timestamps();
            $table->string('is_book_primary')->default(2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('e_books');
    }
}
