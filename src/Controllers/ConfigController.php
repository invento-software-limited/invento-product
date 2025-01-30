<?php

namespace Invento\Product\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Spatie\Valuestore\Valuestore;
use App\Http\Controllers\Controller;
class ConfigController extends Controller
{
    public function index(){
        $this->store = Valuestore::make(resource_path('settings/settings.json'));
        $data['status'] = $this->store->has('doctor') ? $this->store->get('doctor')['status'] : '';
        return view('doctor::config',$data);
    }


    public function store(Request $request){
        $this->store = Valuestore::make(resource_path('settings/settings.json'));

        $data['doctor'] = [
            'status' => $request->has('status')
        ];

        $this->store->put($data);

        Toastr::success(__('doctor::doctors.update_configuration'),__('doctor:doctors.blog'));

        return back();
    }

}
