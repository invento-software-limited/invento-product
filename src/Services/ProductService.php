<?php

namespace Invento\Product\Services;

use Invento\Product\Models\Product;
use Illuminate\Support\Str;

class ProductService
{
    public static function store($request)
    {
        try {
            // Begin transaction
            \DB::beginTransaction();
            
            // Prepare product data
            $productData = [
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'sku' => $request->sku,
                'description' => $request->description,
                'short_description' => $request->short_description,
                'cost_price' => $request->cost_price,
                'sale_price' => $request->sale_price,
                'discount_price' => $request->discount_price,
                'thumbnail' => $request->thumbnail
            ];
            
            // Create new product
            $product = Product::create($productData);
            
            // Attach categories if any
            if ($request->has('categories')) {
                $product->categories()->sync($request->categories);
            }
            
            // Commit transaction
            \DB::commit();
            
            return [
                'status' => true,
                'message' => __('product::products.created_successfully'),
                'data' => $product
            ];
            
        } catch (\Exception $e) {
            // Rollback transaction
            \DB::rollBack();
            return [
                'status' => false,
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }
    
    public static function update($request, $product)
    {
        try {
            // Begin transaction
            \DB::beginTransaction();
            
            // Prepare product data
            $productData = [
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'sku' => $request->sku,
                'description' => $request->description,
                'short_description' => $request->short_description,
                'cost_price' => $request->cost_price,
                'sale_price' => $request->sale_price,
                'discount_price' => $request->discount_price,
                'thumbnail' => $request->thumbnail
            ];
            
            // Update existing product
            $product->update($productData);
            
            // Sync categories if any
            if ($request->has('categories')) {
                $product->categories()->sync($request->categories);
            }
            
            // Commit transaction
            \DB::commit();
            
            return [
                'status' => true,
                'message' => __('product::products.updated_successfully'),
                'data' => $product
            ];
            
        } catch (\Exception $e) {
            // Rollback transaction
            \DB::rollBack();
            return [
                'status' => false,
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }
}
