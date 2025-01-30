<?php

namespace Invento\Product\Controllers;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Foundation\Application as ApplicationAlias1;
use Illuminate\Contracts\View\Factory as FactoryAlias;
use Illuminate\Contracts\View\View as ViewAlias;
use Illuminate\Foundation\Application as ApplicationAlias;
use Illuminate\Http\Request;
use Invento\Product\Models\ProductCategory;
use Invento\Product\Requests\CategoryRequestRequest;
use App\Services\CustomFieldService;

class ProductCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:view product categories'])->only(['index']);
        $this->middleware(['permission:add and update product category'])->only(['create', 'store', 'edit', 'update']);
        $this->middleware(['permission:delete product category'])->only(['destroy']);
    }

    public function index()
    {
        $data['categories'] = ProductCategory::query()
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
            'parent_id' => $request->parent_id,
            'icon' => $request->icon,
            'status' => $request->has('status')
        ]);

        CustomFieldService::add($request->custom_fields, $category, \App\Models\CustomField::MODULES['Product Category']);

        Toastr::success(__('product::categories.category_added_successfully'), __('product::categories.category'));

        return redirect()->route('admin.products.categories.index');
    }

    public function edit(ProductCategory $department)
    {
        $data['department'] = $department;
        return view("doctor::departments.edit", $data);
    }

    public function update(Request $request, ProductCategory $department)
    {
        if ($request->has('status_switch')) {
            $department->update([
                'status' => !$department->status,
            ]);
            Toastr::success(__('doctor::departments.department_status_updated_successfully'), __('doctor::departments.department'));
        } else {
            $department->update([
                'name' => $request->name,
                'status' => $request->has('status'),
                'meta_title' => $request->meta_title ?? $request->name,
                'meta_description' => $request->meta_description ?? '',
            ]);

            CustomFieldService::add($request->custom_fields, $department, \App\Models\CustomField::MODULES['Doctor Department']);
            Toastr::success(__('doctor::departments.department_updated_successfully'), __('doctor::departments.department'));
        }


        return back();
    }

    public function destroy(ProductCategory $category)
    {
        $category->delete();
        Toastr::success(__('blog::categories.blog_category_deleted'), __('blog::categories.blog_category'));

        return back();
    }
}
