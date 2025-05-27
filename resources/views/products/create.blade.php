<x-default-layout>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/custom.css') }}">
    @endpush

    @section('title')
        {{ __('product::products.add_product') }}
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('products.create') }}
    @endsection

    {!! Form::open(array('route' =>'admin.products.store', 'method'=>'post','class'=>'form' ,'id' => 'kt_product_form')) !!}

    <div class="row">
        <div class="col-lg-9">
            <div class="card card-flush py-4">
                <div class="card-header">
                    <div class="card-title">
                        <h2>{{ __('product::products.product_details') }}</h2>
                    </div>
                </div>

                <div class="card-body pt-0">
                    <!-- Product Title -->
                    <div class="mb-5 fv-row">
                        <label class="required form-label">{{ __('product::products.title') }}</label>
                        <input type="text" name="title" id="title" class="form-control mb-2 meta_title" value=""/>
                        <div class="text-muted fs-7">{{ __('product::products.title_text') }}</div>
                    </div>

                    <!-- SKU -->
                    <div class="mb-5 fv-row">
                        <label class="form-label">{{ __('product::products.sku') }}</label>
                        <input type="text" name="sku" id="sku" class="form-control mb-2" value=""/>
                        <div class="text-muted fs-7">{{ __('product::products.sku_text') }}</div>
                    </div>

                    <!-- Pricing -->
                    <div class="row mb-5">
                        <div class="col-md-4 fv-row">
                            <label class="form-label">{{ __('product::products.cost_price') }}</label>
                            <input type="number" step="0.01" name="cost_price" id="cost_price" class="form-control mb-2" value=""/>
                            <div class="text-muted fs-7">{{ __('product::products.cost_price_text') }}</div>
                        </div>

                        <div class="col-md-4 fv-row">
                            <label class="form-label">{{ __('product::products.sale_price') }}</label>
                            <input type="number" step="0.01" name="sale_price" id="sale_price" class="form-control mb-2" value=""/>
                            <div class="text-muted fs-7">{{ __('product::products.sale_price_text') }}</div>
                        </div>

                        <div class="col-md-4 fv-row">
                            <label class="form-label">{{ __('product::products.discount_price') }}</label>
                            <input type="number" step="0.01" name="discount_price" id="discount_price" class="form-control mb-2" value=""/>
                            <div class="text-muted fs-7">{{ __('product::products.discount_price_text') }}</div>
                        </div>
                    </div>

                    <!-- Short Description -->
                    <div class="mb-5 fv-row">
                        <label class="form-label">{{ __('product::products.short_description') }}</label>
                        <textarea rows="3" name="short_description" id="short_description" class="form-control mb-2"></textarea>
                        <div class="text-muted fs-7">{{ __('product::products.short_description_text') }}</div>
                    </div>

                    <!-- Full Description -->
                    <div class="mb-5 fv-row">
                        <label class="form-label">{{ __('product::products.description') }}</label>
                        <div id="quill-editor" class="min-h-200px mb-2" style="height: 300px;"></div>
                        <textarea rows="3" class="mb-3 d-none" name="description" id="quill-editor-area"></textarea>
                    </div>

                    <!-- SEO Fields -->
                    @include('backend.partials.seo-field',['model' => 'App-Models-Product','column' => 'slug','seo' => null])

                    <!-- Custom Fields -->
                    @custom_fields(\App\Models\CustomField::MODULES['Product'], null)

                    <div class="mt-10 fv-row">
                        <div class="d-flex justify-content-start">
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">{{ __('product::products.submit') }}</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 sidebar">
            <!-- Product Categories -->
            <div class="card card-flush mb-4">
                <div class="card-header">
                    <div class="card-title">
                        <h4>{{ __('product::products.categories') }}</h4>
                    </div>
                </div>

                <div class="card-body pt-0">
                    <select class="form-select mb-2" name="categories[]" id="categories" data-control="select2" 
                            multiple data-placeholder="{{ __('product::products.select_categories') }}">
                        @foreach($categories as $key => $category)
                            <option value="{{ $key }}">{{ $category }}</option>
                        @endforeach
                    </select>
                    <div class="text-muted fs-7">{{ __('product::products.categories_text') }}</div>
                </div>
            </div>

            <!-- Product Thumbnail -->
            <div class="card card-flush mb-4">
                <div class="card-header">
                    <div class="card-title">
                        <h4>{{ __('product::products.thumbnail') }}</h4>
                    </div>
                </div>

                <div class="card-body text-center pt-0">
                    @include('backend.pages.filemanager.input',['image' => '','name' => 'thumbnail'])
                </div>
            </div>

            <!-- Product Status -->
            <div class="card card-flush">
                <div class="card-header">
                    <div class="card-title">
                        <h4>{{ __('product::products.status') }}</h4>
                    </div>
                </div>

                <div class="card-body pt-0">
                    <select name="status" id="status" class="form-select mb-2" data-control="select2"
                            data-hide-search="true" data-placeholder="{{ __('product::products.status_text') }}">
                        <option value="1">{{ __('product::products.active') }}</option>
                        <option value="0">{{ __('product::products.inactive') }}</option>
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

        {!! JsValidator::formRequest('Invento\Product\Requests\ProductRequest', '#kt_product_form') !!}

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                if (document.getElementById('quill-editor-area')) {
                    var editor = new Quill('#quill-editor', {
                        modules: {
                            toolbar: [
                                ['bold', 'italic', 'underline', 'strike'],
                                ['blockquote', 'code-block'],
                                ['link', 'image', 'video', 'formula'],
                                [{'header': 1}, {'header': 2}],
                                [{'list': 'ordered'}, {'list': 'bullet'}, {'list': 'check'}],
                                [{'script': 'sub'}, {'script': 'super'}],
                                [{'indent': '-1'}, {'indent': '+1'}],
                                [{'direction': 'rtl'}],
                                [{'size': ['small', false, 'large', 'huge']}],
                                [{'header': [1, 2, 3, 4, 5, 6, false]}],
                                [{'color': []}, {'background': []}],
                                [{'font': []}],
                                [{'align': []}],
                                ['clean']
                            ]
                        },
                        placeholder: 'Type your product description here...',
                        theme: 'snow'
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
