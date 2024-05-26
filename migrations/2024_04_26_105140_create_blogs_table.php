<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('slug');
            $table->boolean('status')->default(true);
            $table->integer('display_order')->nullable();
            $table->string('meta_title')->nullable();
            $table->mediumText('meta_description')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->mediumText('short_description')->nullable();
            $table->text('content')->nullable();
            $table->boolean('status')->default(1);
            $table->integer('display_order')->nullable();
            $table->boolean('is_featured')->default(0);
            $table->unsignedBigInteger('blog_category_id');
            $table->string('category_name')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('slug')->nullable();
            $table->string('banner')->nullable();
            $table->string('meta_title')->nullable();
            $table->mediumText('meta_description')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('blog_categories');
    }
};
