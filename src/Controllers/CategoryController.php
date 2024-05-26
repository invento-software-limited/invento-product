<?php

namespace Invento\Blog\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application as ApplicationAlias1;
use Illuminate\Contracts\View\Factory as FactoryAlias;
use Illuminate\Contracts\View\View as ViewAlias;
use Illuminate\Foundation\Application as ApplicationAlias;
use Illuminate\Http\Request;
use Invento\Blog\Models\BCategory;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = BCategory::query()
            ->search(request()->input('query'))
            ->orderByDesc('id')
            ->paginate(10);

        return view("bcategory::index")->with('categories', $categories);
    }
}
