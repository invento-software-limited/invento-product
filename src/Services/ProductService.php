<?php

namespace Invento\Product\Services;

use App\Services\CustomFieldService;
use Illuminate\Support\Facades\DB;
use App\Models\TagManager;
use Brian2694\Toastr\Facades\Toastr;
use Invento\Product\Models\ProductCategory;
use Invento\Product\Models\Product;

class ProductService
{
    public static function store($request)
    {
        DB::beginTransaction();

        try {
            $validateData = $request->only(['first_name', 'last_name', 'designation', 'qualification','email','phone','gender','dob','description','id_number','image','meta_title', 'meta_description', 'display_order']);

            if(!$validateData['meta_title']){
                $validateData['meta_title'] = $request->first_name.' '.$request->last_name;
            }

            if(!$validateData['meta_description']){
                $validateData['meta_description'] = $request->description;
            }

            $validateData['status'] = $request->status == Product::STATUS['Published'];

            $department = ProductCategory::where('id',$request->department)
                ->active()
                ->first();

            $validateData['doctor_department_id'] = $department->id;
            $validateData['department_name'] = $department->name;
            try {
                $doctor = Product::create($validateData);
            }catch (\Exception $exception){
                dd($exception->getMessage());
            }

            CustomFieldService::add($request->custom_fields,$doctor,\App\Models\CustomField::MODULES['Doctor']);

            DB::commit();
            Toastr::success(__('doctor::doctors.doctor_added_successfully'),__('doctor::doctors.doctor'));
            return true;

        } catch (\Exception $exception) {
            Toastr::success(__('doctor::doctors.something_wrong'),__('doctor::doctors.doctor'));
            DB::rollBack();
            return false;
        }
    }


    public static function update($request, $doctor)
    {
        DB::beginTransaction();

        try {
            $validateData = $request->only(['first_name', 'last_name', 'designation', 'qualification','email','phone','gender','dob','id_number','description','image','meta_title', 'meta_description', 'display_order']);

            if(!$validateData['meta_title']){
                $validateData['meta_title'] = $request->title;
            }

            if(!$validateData['meta_description']){
                $validateData['meta_description'] = $request->short_description;
            }

            $validateData['status'] = $request->status == Product::STATUS['Published'];

            $department = ProductCategory::where('id',$request->department)
                ->active()
                ->first();

            $validateData['doctor_department_id'] = $department->id;
            $validateData['department_name'] = $department->name;

            $doctor->update($validateData);

            CustomFieldService::add($request->custom_fields,$doctor,\App\Models\CustomField::MODULES['Doctor']);

            Toastr::success(__('doctor::doctors.doctor_updated_successfully'),__('doctor::doctors.doctor'));
            DB::commit();
            return true;

        } catch (\Exception $exception) {
            Toastr::success(__('doctor::doctors.something_wrong'),__('doctor::doctors.Doctor'));
            DB::rollBack();
            return false;
        }
    }
}
