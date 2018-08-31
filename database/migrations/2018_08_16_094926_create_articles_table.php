<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',50)->comment('标题');
            $table->text('body')->comment('文章内容');
            $table->unsignedInteger('user_id')->comment('用户ID');
            // $table->unsignedInteger('category_id')->default(0)->comment('分类ID');
            $table->unsignedInteger('pageviews_count')->default(0)->comment('浏览量总数');
            $table->unsignedInteger('comments_count')->default(0)->comment('评论总数');
            $table->unsignedInteger('favorites_count')->default(0)->comment('收藏总数');
            $table->boolean('close_comment')->default(0)->comment('是否关闭评论');
            $table->boolean('is_hidden')->default(0)->comment('是否隐藏该诗文');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
            $table->index(['user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
