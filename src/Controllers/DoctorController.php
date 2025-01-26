<?php

namespace Invento\Doctor\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Invento\Doctor\Models\Doctor;
use Invento\Doctor\Models\Department;
use Invento\Doctor\Requests\DoctorRequest;
use Invento\Doctor\Services\DoctorService;
use Spatie\Tags\Tag;
use App\Models\TagManager;
use Brian2694\Toastr\Facades\Toastr;

class DoctorController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:view doctors'])->only(['index']);
        $this->middleware(['permission:add and update doctor'])->only(['create','store','edit','update']);
        $this->middleware(['permission:delete doctor'])->only(['destroy']);
    }
    
    public function index()
    {
        $data['doctors'] = Doctor::query()
            ->search(request()->input('query'))
            ->orderByDesc('created_at')
            ->paginate(10);

        return view("doctor::doctors.index",$data);
    }

    public function create()
    {
        $data['departments'] = Department::active()->pluck('name','id')->toArray();
        $data['doctor'] = new Doctor();

        return view('doctor::doctors.create',$data);
    }

    public function store(DoctorRequest $request)
    {

        $response = DoctorService::store($request);

        return $response ?  redirect()->route('admin.doctors.index') : back()->withInput();
    }

    public function show($id)
    {
        //
    }

    public function edit(Doctor $doctor)
    {
        $data['departments'] = Department::active()->pluck('name','id')->toArray();
        $data['doctor'] = $doctor;

        return view('doctor::doctors.edit',$data);
    }



    public function update(Request $request, Doctor $doctor)
    {
        if($request->has('status_switch')){
            $doctor->update([
                'status' => !$doctor->status,
            ]);

            Toastr::success(__('blog::blogs.blog_updated_successfully'),__('blog::blogs.blog'));

            return back();
        }else{

            $response = DoctorService::update($request,$doctor);
            return $response ?  back() : back()->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Doctor $doctor
     * @return Response
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        Toastr::success(__('doctor::doctors.doctor_deleted_successfully'),__('doctor::doctors.doctor'));
        return back();
    }

}
