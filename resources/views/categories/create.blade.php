<x-default-layout>

    @section('title')
        {{ __('doctor::departments.add_department') }}
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('doctors.departments.create') }}
    @endsection

    {!! Form::open(array('route' =>'admin.doctors.departments.store', 'method'=>'post','class'=>'form d-flex flex-column flex-lg-row' ,'id' => 'kt_doctor_department_form')) !!}
    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10 me-lg-10">
        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title">
                    <h2>{{ __('doctor::departments.department_details') }}</h2>
                </div>
            </div>

            <div class="card-body pt-0">

                <div class="mb-10 fv-row">
                    <label class="required form-label">{{ __('doctor::departments.name') }}</label>
                    <input type="text" name="name" id="name"
                           class="form-control mb-2 meta_title meta_url @error('name') is-invalid @enderror" value=""/>

                    @error('name')
                    <div id="name-error" class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div class="text-muted fs-7">{{ __('doctor::departments.name_text') }}</div>

                </div>


                <div class="mb-10 fv-row">
                    <label class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input" name="status" type="checkbox" checked/>
                        <span class="form-check-label fw-semibold text-muted">{{ __('doctor::departments.status') }}</span>
                    </label>
                </div>


                @include('backend.partials.seo-field',['model' => 'Invento-Doctor-Models-Department','column' => 'slug','seo' => $department])

                @custom_fields(\App\Models\CustomField::MODULES['Doctor Department'], null)

                <div class="mt-10 fv-row">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary"><span
                                    class="indicator-label">{{__('doctor::departments.submit')}}</span>
                        </button>
                    </div>
                </div>

            </div>

        </div>
    </div>
    {!! Form::close() !!}


    @push('scripts')

        <!-- Laravel Javascript Validation -->
        <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

        {!! JsValidator::formRequest('Invento\Doctor\Requests\CategoryRequestRequest', '#kt_doctor_department_form') !!}

    @endpush

</x-default-layout>
