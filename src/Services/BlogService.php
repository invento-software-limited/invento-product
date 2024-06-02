<?php

namespace Invento\Blog\Services;

use App\Services\CustomFieldService;
use Illuminate\Support\Facades\DB;
use Invento\Blog\Models\Blog;
use App\Models\TagManager;
use Brian2694\Toastr\Facades\Toastr;
class BlogService
{
    public static function store($request, $category)
    {
        DB::beginTransaction();

        try {
            $validateData = $request->only(['title', 'short_description', 'content', 'thumbnail', 'meta_title', 'meta_description', 'display_order']);

            $validateData['status'] = $request->status == Blog::STATUS['Published'];
            $validateData['is_featured'] = $request->has('is_featured');
            $validateData['blog_category_id'] = $category->id;
            $validateData['category_name'] = $category->name;

            $blog = Blog::create($validateData);

            CustomFieldService::add($request->custom_fields,$blog,\App\Models\CustomField::MODULES['Blog']);

            if ($request->input('tag')) {
                $blog->syncTagsWithType($request->input('tag'),TagManager::TYPE['Blog']);
            }

            DB::commit();
            Toastr::success(__('blog::blogs.blog_added_successfully'),__('blog::blogs.blog'));
            return true;

        } catch (\Exception $exception) {
            Toastr::success(__('blog::blogs.something_wrong'),__('blog::blogs.blog'));
            DB::rollBack();
            return false;
        }
    }


    public static function update($request, $blog, $category)
    {
        DB::beginTransaction();

        try {
            $validateData = $request->only(['title', 'short_description','content', 'thumbnail', 'meta_title', 'meta_description','display_order']);

            $validateData['status'] = $request->status == Blog::STATUS['Published'];
            $validateData['is_featured'] = $request->has('is_featured');
            $validateData['blog_category_id'] = $category->id;
            $validateData['category_name'] = $category->name;

            $blog->update($validateData);

            CustomFieldService::add($request->custom_fields,$blog,\App\Models\CustomField::MODULES['Blog']);

            if ($request->input('tag')) {
                $blog->syncTagsWithType($request->input('tag'),TagManager::TYPE['Blog']);
            }

            Toastr::success(__('blog::blogs.blog_updated_successfully'),__('blog::blogs.blog'));
            DB::commit();
            return true;

        } catch (\Exception $exception) {
            Toastr::success(__('blog::blogs.something_wrong'),__('blog::blogs.blog'));
            DB::rollBack();
            return false;
        }
    }
}
