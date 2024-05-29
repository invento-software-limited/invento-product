<?php

namespace Invento\Blog\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Spatie\Valuestore\Valuestore;
use App\Http\Controllers\Controller;
class ConfigController extends Controller
{
    public function index(){
        $this->store = Valuestore::make(resource_path('settings/settings.json'));
        $data['status'] = $this->store->has('blog') ? $this->store->get('blog')['status'] : '';
        return view('blog::config',$data);
    }


    public function store(Request $request){
        $this->store = Valuestore::make(resource_path('settings/settings.json'));

        $data['blog'] = [
            'status' => $request->has('status')
        ];

        $this->store->put($data);

        Toastr::success(__('blog::blogs.update_configuration'),__('blog:blogs.blog'));

        return back();
    }

}
