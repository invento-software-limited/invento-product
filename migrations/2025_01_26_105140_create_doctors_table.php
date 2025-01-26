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
            $table->string('product_sku')->nullable();
            $table->longText('product_desc')->nullable();
            $table->text('product_short_desc')->nullable();
            $table->decimal('product_cost_price', 23, 2)->nullable();
            $table->decimal('product_sale_price', 23, 2)->nullable();
            $table->decimal('product_discount_price', 23, 2)->nullable();
            $table->string('product_image')->nullable();
            $table->text('product_return_policy')->nullable();
            $table->string('product_video_url')->nullable();
            $table->boolean('product_allow_seo')->nullable();
            $table->string('product_seo_keyword')->nullable();
            $table->string('product_estimate_time')->nullable();
            $table->string('product_condition')->nullable();
            $table->string('shipping_type')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->string('brand_name')->nullable();
            $table->string('product_tags')->nullable();

            $table->string('catalog_visibility')->nullable();
            $table->string('tax_status')->nullable();

            $table->boolean('reviews_allowed')->default(true);
            $table->text('purchase_note')->nullable();
            $table->integer('total_sale')->nullable();
            $table->string('backorders')->nullable();
            $table->boolean('backorders_allowed')->default(true);
            $table->decimal('average_rating', 23, 10)->nullable();
            $table->integer('rating_count')->nullable();
            $table->json('related_ids')->nullable();

            $table->boolean('product_featured')->nullable();
            $table->string('product_type')->nullable();
            $table->string('product_file')->nullable();
            $table->string('product_external_url')->nullable();
            $table->decimal('product_local_shipping_fee', 23, 2)->nullable();
            $table->decimal('product_global_shipping_fee', 23, 2)->nullable();
            $table->string('product_attribute_type')->nullable();
            $table->string('product_attribute')->nullable();
            $table->integer('product_stock')->nullable();
            $table->boolean('is_stock')->default(1);
            $table->boolean('flash_deals')->nullable();
            $table->timestamp('flash_deal_start_date')->nullable();
            $table->timestamp('flash_deal_end_date')->nullable();
            $table->timestamp('product_date')->nullable();
            $table->boolean('product_status')->default(true);
            $table->boolean('is_fcommerce')->default(false);
            $table->unsignedBigInteger('facebook_category_id')->nullable();
            $table->unsignedBigInteger('google_category_id')->nullable();
            $table->string('published_status')->default(\App\Models\Product::PUBLISHED_STATUS['Published']);

            $table->double('weight', 8, 2)->nullable();
            $table->double('length', 8, 2)->nullable();
            $table->double('wide', 8, 2)->nullable();
            $table->double('height', 8, 2)->nullable();
            $table->string('weight_unit')->nullable();
            $table->string('length_unit')->nullable();
            $table->boolean('has_variation')->default(0);
            $table->boolean('allow_checkout_when_stock_out')->default(0);
            $table->boolean('with_storehouse_management')->default(1);
            $table->string('stock_status')->nullable();

            $table->unsignedBigInteger('tax_id')->nullable();
            $table->string('tax_title')->nullable();

            $table->text('product_meta_desc')->nullable();
            $table->text('product_meta_long_desc')->nullable();
            $table->text('product_meta_title')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        // Insert permissions for the blog module
        $permissions_list = [
            'products' => ['view categories','add and update category','delete category','view products','add and update product','delete product']
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
        Schema::dropIfExists('doctors');
        Schema::dropIfExists('doctor_departments');

        $permissions =  DB::table('permissions')->where('prefix', 'manage doctor')->pluck('id')->toArray();
        DB::table('role_has_permissions')->whereIn('permission_id', $permissions)->delete();
        DB::table('model_has_permissions')->whereIn('permission_id', $permissions)->delete();
        DB::table('permissions')->whereIn('id', $permissions)->delete();
    }
};
