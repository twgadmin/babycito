<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->string('title', 50);
            $table->text('content')->nullable();
            $table->string('blog_media', 65);
            $table->boolean('is_featured')->default(0);
            $table->unsignedBigInteger('blog_category_id')->default(0);
            $table->string('tags', 65)->nullable();
            $table->boolean('is_index')->default(0);
            $table->boolean('is_follow')->default(0);
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
        Schema::dropIfExists('blogs');
    }
}
