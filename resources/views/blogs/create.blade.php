<x-default-layout>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/custom.css') }}">

        <style>
            .select2-hidden-accessible.is-invalid + div{
                position: absolute;
                top:130px
            }

            .is-invalid ~ .select2-container .select2-selection--single {
                border-color: #f1416c !important;
            }
        </style>
    @endpush

    @section('title')
        {{ __('blog::blogs.add_blog') }}
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('blogs.create') }}
    @endsection

    {!! Form::open(array('route' =>'admin.blogs.store', 'method'=>'post','class'=>'form d-flex flex-column flex-lg-row' ,'id' => 'kt_blog_form')) !!}

    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10 me-lg-10">

        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title">
                    <h2>{{ __('blog::blogs.blog_details') }}</h2>
                </div>
            </div>

            <div class="card-body pt-0">

                <div class="mb-10 fv-row">
                    <label class="required form-label">{{ __('blog::blogs.blog_title') }}</label>
                    <input type="text" name="title" id="title" class="form-control mb-2 meta_title" value=""/>
                    <div class="text-muted fs-7">A category name is required and recommended to be unique.</div>

                </div>

                <div class="mb-10 fv-row">
                    <label class="required form-label">{{ __('blog::blogs.short_description') }}</label>
                    <textarea rows="5" name="short_description" id="short_description"
                              class="form-control mb-2 meta_description" placeholder="Product name"> </textarea>
                    <div class="text-muted fs-7">A category name is required and recommended to be unique.</div>

                </div>

                <div class="mb-10 fv-row">
                    <label class="form-label">Description</label>
                    <div id="quill-editor" class="min-h-200px mb-2" style="height: 300px;"></div>
                    <textarea rows="3" class="mb-3 d-none" name="content" id="quill-editor-area">

                    </textarea>
                    <div class="text-muted fs-7">Write page content here.You can also use html mode</div>
                </div>

                <div class="mb-10 fv-row">
                    <label class="form-label">{{ __('blog::blogs.tags') }}</label>

                    <select class="form-select mb-2" name="tag[]" id="tag" data-control="select2" multiple
                            data-hide-search="false" data-placeholder="Select appropriate tag">
                        <option></option>
                        @foreach($tags as $key => $tag)
                            <option value="{{ $key }}">{{ $tag }}</option>
                        @endforeach
                    </select>

                    <div class="text-muted fs-7">A category name is required and recommended to be unique.</div>

                </div>

                @include('backend.partials.seo-field',['model' => 'Invento-Blog-Models-Blog','column' => 'slug','seo' => $blog])

                <div class="mt-10 fv-row">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary"><span class="indicator-label">Submit</span>
                        </button>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <div class="d-flex flex-column gap-7 gap-lg-10 w-100  mb-7 w-lg-400px">
        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title">
                    <h2>Thumbnail</h2>
                </div>
            </div>

            <div class="card-body text-center pt-0">
                @include('backend.pages.filemanager.input')
            </div>
        </div>

        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title">
                    <h2>Category</h2>
                </div>

            </div>

            <div class="card-body pt-0">
                <select class="form-select mb-2" name="category" id="category" data-control="select2"
                        data-hide-search="false" data-placeholder="Select an category">
                    <option></option>
                    @foreach($categories as $key => $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title">
                    <h2>Status</h2>
                </div>
            </div>

            <div class="card-body pt-0">
                <select name="status" id=status class="form-select mb-2" data-control="select2" data-hide-search="true"
                        data-placeholder="Select an option">
                    @foreach(\Invento\Blog\Models\Blog::STATUS as $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    {!! Form::close() !!}


    @push('scripts')
        <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
        <script src="{{ asset('vendor/file-manager/js/custom-file-manager.js') }}"></script>

        <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

        {!! JsValidator::formRequest('Invento\Blog\Requests\BlogRequest', '#kt_blog_form') !!}


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
