<?php

namespace Invento\Blog\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Invento\Blog\Models\Blog;
use Invento\Blog\Models\BCategory;
use Invento\Blog\Requests\BlogRequest;
use Spatie\Tags\Tag;

class BlogController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application|Response
     */
    public function index()
    {
        if (request()->has('query')){
            $blogs = Blog::query()
                ->search(request()->input('query'))
                ->orderByDesc('created_at')
                ->paginate(10);
        }else{
            $blogs = Blog::query()
                ->orderByDesc('created_at')
                ->paginate(10);
        }

        return view("blog::blogs.index")->with('blogs', $blogs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application|Response
     */
    public function create()
    {
//        $data['categories'] = BCategory::active()->pluck('name','id')->toArray();
//        $data['tags'] = Tag::where('status', true)->pluck('name', 'id')->toArray();

        return view('blog::blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        dd($request);
        $category = BCategory::where('id',$request->category)
            ->active()
            ->first();
        if(!$category){
            Helpers::toastMsg(__('blogs.CategoryNotFound'), __('blogs.Blog'),Helpers::SUCCESS);
            return back()->withInput();
        }
        $response = BlogService::store($request,$category);
        return $response ?  redirect()->route('admin.blogs.index') : back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Blog $blog
     * @return Response
     */
    public function edit(Blog $blog)
    {
        $data = [
            'blog'          => $blog,
            'categories'    => BCategory::active()->pluck('name','id')->toArray(),
            'tags'          => Tag::where('status', true)->pluck('name', 'id')->toArray()
        ];

        return view('backend.blogs.blogs.edit',$data);
    }


    /**
     * @param BlogRequest $request
     * @param Blog $blog
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(BlogRequest $request, Blog $blog)
    {
        $category = BCategory::where('id',$request->category)
            ->active()
            ->first();
        if(!$category){
            Helpers::toastMsg(__('blogs.CategoryNotFound'), __('blogs.Blog'),Helpers::SUCCESS);
            return back()->withInput();
        }
        $response = BlogService::update($request,$blog,$category);
        return $response ?  back() : back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Blog $blog
     * @return Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        Helpers::toastMsg(__('blogs.BlogDelete'), __('blogs.Blog'),Helpers::SUCCESS);
        return back();
    }

    public function activeBlog(Blog $blog){

    }
}
