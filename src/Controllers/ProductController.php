<?php

namespace Invento\Product\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Invento\Product\Models\Product;
use Invento\Product\Models\ProductCategory;
use Invento\Product\Requests\ProductRequest;
use Invento\Product\Services\ProductService;
use Brian2694\Toastr\Facades\Toastr;
use Invento\Product\Resource\ProductResource;
use App\Helpers\ApiResponse;

class ProductController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware(['permission:view products'])->only(['index', 'apiIndex', 'apiShow']);
    //     $this->middleware(['permission:add and update product'])->only(['create','store','edit','update']);
    //     $this->middleware(['permission:delete product'])->only(['destroy']);
    // }
    
    public function index()
    {
        $data['products'] = Product::query()
            ->search(request()->input('query'))
            ->orderByDesc('created_at')
            ->paginate(10);

        return view("product::products.index",$data);
    }

    public function create()
    {
        $data['categories'] = ProductCategory::active()->pluck('name','id')->toArray();
        $data['product'] = new Product();

        return view('product::products.create',$data);
    }

    public function store(ProductRequest $request)
    {

        $response = ProductService::store($request);

        return $response ?  redirect()->route('admin.products.index') : back()->withInput();
    }

    public function show($id)
    {
        //
    }

    public function edit(Product $product) {

        $data['categories'] = ProductCategory::active()->pluck('name','id')->toArray();
        $data['product'] = $product;

        return view('product::products.edit', $data);
    }

    public function update(Request $request, Product $product) {

        if ($request->has('switch_status')) {
            $product->update([
                'status' => !$product->status,
            ]);

            Toastr::success(__('product::products.product_updated_successfully'), __('product::products.product'));

            return back();
        } else {
            $response = ProductService::update($request, $product);
            return $response ? back() : back()->withInput();
        }
    }

    public function destroy(Product $product) {
        $product->delete();
        Toastr::success(__('product::products.product_deleted_successfully'), __('product::products.product'));
        return back();
    }

    public function apiIndex()
    {
        $products = Product::with('categories')->paginate(10);

        $products->through(function ($product) {
            return new ProductResource($product);
        });

        return ApiResponse::successWithPagination(
            $products,
            'Products retrieved successfully.',
            200
        );
    }

    public function apiShow($id)
    {
        $product = Product::with('categories')->find($id);

        if($product){
            return ApiResponse::success(
                new ProductResource($product),
                'Product retrieved successfully.',
                200
            );
        }else{
            return ApiResponse::notFound(
                'Product not found.'
            );
        }
        
    }
}
