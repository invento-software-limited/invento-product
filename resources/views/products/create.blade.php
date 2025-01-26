<x-default-layout>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/custom.css') }}">
    @endpush

    @section('title')
        {{ __('doctor::doctors.add_doctor') }}
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('doctors.create') }}
    @endsection

    {!! Form::open(array('route' =>'admin.doctors.store', 'method'=>'post','class'=>'form' ,'id' => 'kt_doctor_form')) !!}


    <div class="row">
        <div class="col-lg-9">
            <div class="card card-flush py-4">
                <div class="card-header">
                    <div class="card-title">
                        <h2>{{ __('doctor::doctors.doctor_details') }}</h2>
                    </div>
                </div>

                <div class="card-body pt-0">

                    <div class="row mb-5">
                        <div class="col-md-6 fv-row">
                            <label class="required form-label">{{ __('doctor::doctors.first_name') }}</label>
                            <input type="text" name="first_name" id="first_name" class="form-control mb-2 meta_title"
                                   value=""/>
                            <div class="text-muted fs-7">{{ __('doctor::doctors.first_name_text') }}</div>
                        </div>


                        <div class="col-md-6 fv-row">
                            <label class="form-label">{{ __('doctor::doctors.last_name') }}</label>
                            <input type="text" name="last_name" id="last_name" class="form-control mb-2" value=""/>
                            <div class="text-muted fs-7">{{ __('doctor::doctors.last_name_text') }}</div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-6 fv-row">
                            <label class="form-label">{{ __('doctor::doctors.designation') }}</label>
                            <input type="text" name="designation" id="designation" class="form-control mb-2" value=""/>
                            <div class="text-muted fs-7">{{ __('doctor::doctors.designation_text') }}</div>
                        </div>


                        <div class="col-md-6 fv-row">
                            <label class="form-label">{{ __('doctor::doctors.qualification') }}</label>
                            <input type="text" name="qualification" id="qualification" class="form-control mb-2"
                                   value=""/>
                            <div class="text-muted fs-7">{{ __('doctor::doctors.qualification_text') }}</div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-6 fv-row">
                            <label class="form-label">{{ __('doctor::doctors.email') }}</label>
                            <input type="email" name="email" id="email" class="form-control mb-2" value=""/>
                            <div class="text-muted fs-7">{{ __('doctor::doctors.email_text') }}</div>
                        </div>

                        <div class="col-md-6 fv-row">
                            <label class="form-label">{{ __('doctor::doctors.phone') }}</label>
                            <input type="text" name="phone" id="phone" class="form-control mb-2" value=""/>
                            <div class="text-muted fs-7">{{ __('doctor::doctors.phone_text') }}</div>
                        </div>
                    </div>


                    <div class="row mb-5">
                        <div class="col-md-6 fv-row">
                            <label class="form-label">{{ __('doctor::doctors.gender') }}</label>

                            <select class="form-select mb-2" name="gender" id="gender" data-control="select2"
                                    data-hide-search="true"
                                    data-placeholder="{{  __('doctor::doctors.select_gender') }}">
                                <option></option>
                                @foreach(\Invento\Doctor\Models\Product::GENDER as $key => $val)
                                    <option value="{{ $key }}">{{ $val }}</option>
                                @endforeach
                            </select>

                            <div class="text-muted fs-7">{{ __('doctor::doctors.gender_text') }}</div>
                        </div>

                        <div class="col-md-6 fv-row">
                            <label class="form-label">{{ __('doctor::doctors.dob') }}</label>
                            <input type="text" name="dob" id="dob" class="form-control mb-2" value=""/>
                            <div class="text-muted fs-7">{{ __('doctor::doctors.dob_text') }}</div>
                        </div>
                    </div>


                    <div class="mb-5 fv-row">
                        <label class="form-label">{{ __('doctor::doctors.description') }}</label>
                        <div id="quill-editor" class="min-h-200px mb-2" style="height: 300px;"></div>
                        <textarea rows="3" class="mb-3 d-none" name="description" id="quill-editor-area">

                    </textarea>
                    </div>


                    @include('backend.partials.seo-field',['model' => 'Invento-Doctor-Models-Doctor','column' => 'slug','seo' => $doctor])

                    @custom_fields(\App\Models\CustomField::MODULES['Doctor'], null)

                    <div class="mt-10 fv-row">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary"><span
                                        class="indicator-label">{{ __('doctor::doctors.submit') }}</span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-3 sidebar">
            <div class="card card-flush">
                <div class="card-header">
                    <div class="card-title">
                        <h4>{{ __('doctor::doctors.upload_image') }} <span
                                    class="fs-1rem">{{ __('doctor::doctors.image_dimension') }}</span></h4>
                    </div>
                </div>

                <div class="card-body text-center pt-0">
                    @include('backend.pages.filemanager.input',['image' => '','name' => 'image'])
                </div>
            </div>

            <div class="card card-flush">
                <div class="card-header">
                    <div class="card-title">
                        <h4>{{ __('doctor::doctors.department') }}</h4>
                    </div>

                </div>

                <div class="card-body pt-0">
                    <select class="form-select mb-2" name="department" id="department" data-control="select2"
                            data-hide-search="false" data-placeholder="{{  __('doctor::doctors.department_text') }}">
                        <option></option>
                        @foreach($departments as $key => $val)
                            <option value="{{ $key }}">{{ $val }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="card card-flush">
                <div class="card-header">
                    <div class="card-title">
                        <h4>{{ __('doctor::doctors.id_number') }}</h4>
                    </div>

                </div>

                <div class="card-body pt-0">
                    <input type="text" name="id_number" id="id_number"
                           placeholder="{{ __('doctor::doctors.id_number_text') }}" class="form-control" value=""/>
                </div>
            </div>

            <div class="card card-flush">
                <div class="card-header">
                    <div class="card-title">
                        <h4>{{ __('doctor::doctors.display_order') }}</h4>
                    </div>

                </div>

                <div class="card-body pt-0">
                    <input type="number" name="display_order" id="display_order"
                           placeholder="{{ __('doctor::doctors.display_order_text') }}" class="form-control" value=""/>
                </div>
            </div>

            <div class="card card-flush">
                <div class="card-header">
                    <div class="card-title">
                        <h4>{{ __('doctor::doctors.status') }}</h4>
                    </div>
                </div>

                <div class="card-body pt-0">
                    <select name="status" id=status class="form-select mb-2" data-control="select2"
                            data-hide-search="true"
                            data-placeholder="{{ __('doctor::doctor.status_text') }}">
                        @foreach(\Invento\Doctor\Models\Product::STATUS as $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>


    {!! Form::close() !!}


    @push('scripts')
        <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
        <script src="{{ asset('vendor/file-manager/js/custom-file-manager.js') }}"></script>

        <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

        {!! JsValidator::formRequest('Invento\Doctor\Requests\ProductRequest', '#kt_doctor_form') !!}


        <script>
            document.addEventListener('DOMContentLoaded', function () {
                if (document.getElementById('quill-editor-area')) {
                    var editor = new Quill('#quill-editor', {
                        modules: {
                            toolbar: [
                                ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                                ['blockquote', 'code-block'],
                                ['link', 'image', 'video', 'formula'],

                                [{'header': 1}, {'header': 2}],               // custom button values
                                [{'list': 'ordered'}, {'list': 'bullet'}, {'list': 'check'}],
                                [{'script': 'sub'}, {'script': 'super'}],      // superscript/subscript
                                [{'indent': '-1'}, {'indent': '+1'}],          // outdent/indent
                                [{'direction': 'rtl'}],                         // text direction

                                [{'size': ['small', false, 'large', 'huge']}],  // custom dropdown
                                [{'header': [1, 2, 3, 4, 5, 6, false]}],

                                [{'color': []}, {'background': []}],          // dropdown with defaults from theme
                                [{'font': []}],
                                [{'align': []}],

                                ['clean']
                            ]
                        },
                        placeholder: 'Type your text here...',
                        theme: 'snow' // or 'bubble'
                    });
                    var quillEditor = document.getElementById('quill-editor-area');
                    editor.on('text-change', function () {
                        quillEditor.value = editor.root.innerHTML;
                    });

                    quillEditor.addEventListener('input', function () {
                        editor.root.innerHTML = quillEditor.value;
                    });
                }
            });
        </script>
    @endpush

</x-default-layout>
