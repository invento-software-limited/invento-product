<?php

namespace Invento\Doctor\Controllers;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Foundation\Application as ApplicationAlias1;
use Illuminate\Contracts\View\Factory as FactoryAlias;
use Illuminate\Contracts\View\View as ViewAlias;
use Illuminate\Foundation\Application as ApplicationAlias;
use Illuminate\Http\Request;
use Invento\Doctor\Models\Category;
use Invento\Doctor\Requests\CategoryRequestRequest;
use App\Services\CustomFieldService;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:view doctor departments'])->only(['index']);
        $this->middleware(['permission:add and update doctor department'])->only(['create', 'store', 'edit', 'update']);
        $this->middleware(['permission:delete doctor department'])->only(['destroy']);
    }

    public function index()
    {
        $data['departments'] = Category::query()
            ->search(request()->input('query'))
            ->orderByDesc('id')
            ->paginate(10);

        return view("doctor::departments.index", $data);
    }

    public function create()
    {
        $data['department'] = new Category();
        return view("doctor::departments.create", $data);
    }

    public function store(CategoryRequestRequest $request)
    {
        $category = Category::create([
            'name' => $request->name,
            'status' => $request->has('status'),
            'meta_title' => $request->meta_title ?? $request->name,
            'meta_description' => $request->meta_description ?? '',
        ]);

        CustomFieldService::add($request->custom_fields, $category, \App\Models\CustomField::MODULES['Doctor Department']);

        Toastr::success(__('doctor::departments.department_added_successfully'), __('doctor::departments.department'));

        return redirect()->route('admin.doctors.departments.index');
    }

    public function edit(Category $department)
    {
        $data['department'] = $department;
        return view("doctor::departments.edit", $data);
    }

    public function update(Request $request, Category $department)
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

    public function destroy(Category $category)
    {
        $category->delete();
        Toastr::success(__('blog::categories.blog_category_deleted'), __('blog::categories.blog_category'));

        return back();
    }
}
