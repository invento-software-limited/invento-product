<?php

namespace Invento\Product\Controllers;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Invento\Product\Models\ProductCategory;
use Invento\Product\Requests\CategoryRequestRequest;
use App\Services\CustomFieldService;
use Invento\Product\Resource\ProductCategoryResource;

class ProductCategoryController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['permission:view product categories'])->only(['index']);
    //     $this->middleware(['permission:add and update product category'])->only(['create', 'store', 'edit', 'update']);
    //     $this->middleware(['permission:delete product category'])->only(['destroy']);
    // }

    public function index()
    {
        $data['categories'] = ProductCategory::query()
            ->with('parent:id,name')
            ->search(request()->input('query'))
            ->orderByDesc('id')
            ->paginate(10);

        return view("product::categories.index", $data);
    }

    public function create()
    {
        $data['categories'] = ProductCategory::active()->pluck('name', 'id')->toArray();
        return view("product::categories.create", $data);
    }

    public function store(CategoryRequestRequest $request)
    {
        $category = ProductCategory::create([
            'name' => $request->name,
            'parent_id' => $request->parent_category,
            'icon' => $request->icon,
            'status' => $request->has('status')
        ]);

        CustomFieldService::add($request->custom_fields, $category, \App\Models\CustomField::MODULES['Product Category']);

        Toastr::success(__('product::categories.category_added_successfully'), __('product::categories.category'));

        return redirect()->route('admin.products.categories.index');
    }

    public function edit(ProductCategory $category)
    {
        $data['category'] = $category;
        $data['categories'] = ProductCategory::active()->pluck('name', 'id')->toArray();
        return view("product::categories.edit", $data);
    }

    public function update(Request $request, ProductCategory $category)
    {
        if ($request->has('status_switch')) {
            $category->update([
                'status' => !$category->status,
            ]);
            Toastr::success(__('product::categories.category_status_updated_successfully'), __('product::categories.category'));
        } else {
            $category->update([
                'name' => $request->name,
                'parent_id' => $request->parent_category,
                'icon' => $request->icon,
                'status' => $request->has('status')
            ]);

            CustomFieldService::add($request->custom_fields, $category, \App\Models\CustomField::MODULES['Product Category']);
            Toastr::success(__('product::categories.category_updated_successfully'), __('product::categories.category'));
        }


        return back();
    }

    public function destroy(ProductCategory $category)
    {
        $category->delete();
        Toastr::success(__('product::categories.category_deleted'), __('blog::categories.category'));

        return back();
    }

    public function apiIndex()
    {
        $categories = ProductCategory::paginate(10);
        return ApiResponse::success(
            ProductCategoryResource::collection($categories),
            'Products retrieved successfully.',
            200
        );;
    }
}
