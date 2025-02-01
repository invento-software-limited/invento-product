<?php

namespace Invento\Product\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Invento\Product\Models\Product;
use Invento\Product\Models\ProductCategory;
use Invento\Product\Requests\ProductRequest;
use Invento\Product\Services\ProductService;
use Spatie\Tags\Tag;
use App\Models\TagManager;
use Brian2694\Toastr\Facades\Toastr;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:view products'])->only(['index']);
        $this->middleware(['permission:add and update product'])->only(['create','store','edit','update']);
        $this->middleware(['permission:delete product'])->only(['destroy']);
    }
    
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

    public function edit(Product $doctor)
    {
        $data['departments'] = ProductCategory::active()->pluck('name','id')->toArray();
        $data['doctor'] = $doctor;

        return view('doctor::doctors.edit',$data);
    }



    public function update(Request $request, Product $doctor)
    {
        if($request->has('status_switch')){
            $doctor->update([
                'status' => !$doctor->status,
            ]);

            Toastr::success(__('blog::blogs.blog_updated_successfully'),__('blog::blogs.blog'));

            return back();
        }else{

            $response = ProductService::update($request,$doctor);
            return $response ?  back() : back()->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product $doctor
     * @return Response
     */
    public function destroy(Product $doctor)
    {
        $doctor->delete();
        Toastr::success(__('doctor::doctors.doctor_deleted_successfully'),__('doctor::doctors.doctor'));
        return back();
    }

}
