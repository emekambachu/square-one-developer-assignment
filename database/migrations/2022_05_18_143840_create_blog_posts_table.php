<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', static function (Blueprint $table) {
            $table->id()->unique()->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('name')->nullable();
            $table->string('title')->unique()->index();
            $table->string('slug')->unique();
            $table->longText('description');
            $table->string('publication_date');
            $table->boolean('published')->default(0);
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
        Schema::dropIfExists('blog_posts');
    }
}
