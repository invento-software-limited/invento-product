<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->unsignedBigInteger('parent_id')->index()->nullable();
            $table->string('slug');
            $table->string('icon')->nullable();
            $table->integer('display_order')->nullable();
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('sku')->nullable();
            $table->longText('description')->nullable();
            $table->text('short_description')->nullable();
            $table->decimal('cost_price', 23, 2)->nullable();
            $table->decimal('sale_price', 23, 2)->nullable();
            $table->decimal('discount_price', 23, 2)->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('other_images')->nullable();
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('product_category_product', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('product_category_id');

            // Optional: Add created_at timestamp if needed
            $table->timestamps();

            // Foreign Keys
            $table->foreign('product_id')
                  ->references('id')->on('products')
                  ->onDelete('cascade');

            $table->foreign('product_category_id')
                  ->references('id')->on('product_categories')
                  ->onDelete('cascade');

            // Composite primary key
            $table->primary(['product_id', 'product_category_id']);
        });

        // Insert permissions for the blog module
        $permissions_list = [
            'products' => ['view product categories','add and update product category','delete product category','view products','add and update product','delete product']
        ];

        foreach ($permissions_list as $key => $permissions) {
            foreach ($permissions as $permission) {
                Permission::create([
                    'name' => $permission,
                    'prefix' => $key,
                    'guard_name' => 'web',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_category_product');
        Schema::dropIfExists('product_categories');
        Schema::dropIfExists('products');

        $permissions =  DB::table('permissions')->where('prefix', 'products')->pluck('id')->toArray();
        DB::table('role_has_permissions')->whereIn('permission_id', $permissions)->delete();
        DB::table('model_has_permissions')->whereIn('permission_id', $permissions)->delete();
        DB::table('permissions')->whereIn('id', $permissions)->delete();
    }
};
