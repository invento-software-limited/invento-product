<x-default-layout>

    @section('title')
        {{ __('blog::categories.add_category') }}
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('blogs.categories.create') }}
    @endsection

    {!! Form::open(array('route' =>'admin.blogs.categories.store', 'method'=>'post','class'=>'form d-flex flex-column flex-lg-row' ,'id' => 'kt_blog_category_form')) !!}
    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10 me-lg-10">
        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title">
                    <h2>{{ __('blog::categories.category_details') }}</h2>
                </div>
            </div>

            <div class="card-body pt-0">

                <div class="mb-10 fv-row">
                    <label class="required form-label">{{ __('blog::categories.name') }}</label>
                    <input type="text" name="name" id="name" class="form-control mb-2 meta_title meta_url @error('name') is-invalid @enderror" value=""/>

                    @error('name')
                    <div id="name-error" class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div class="text-muted fs-7">{{ __('blog::categories.name_text') }}</div>

                </div>

                <div class="mb-10 fv-row">
                    <label class="required form-label">{{ __('blog::categories.display_order') }}</label>
                    <input type="number" name="display_order" id="display_order" class="form-control mb-2 @error('display_order') is-invalid @enderror" value=""/>

                    @error('display_order')
                    <div id="name-error" class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div class="text-muted fs-7">{{ __('blog::categories.display_order_text') }}</div>

                </div>

                <div class="mb-10 fv-row">
                    <label class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input" name="status" type="checkbox" checked/>
                        <span class="form-check-label fw-semibold text-muted">{{ __('blog::categories.status') }}</span>
                    </label>
                </div>


                @include('backend.partials.seo-field',['model' => 'Invento-Blog-Models-Category','column' => 'slug','seo' => $category])

                @custom_fields(\App\Models\CustomField::MODULES['Blog Category'], null)

                <div class="mt-10 fv-row">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary"><span class="indicator-label">{{__('blog::categories.submit')}}</span>
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

        {!! JsValidator::formRequest('Invento\Blog\Requests\CategoryRequest', '#kt_blog_category_form') !!}

    @endpush

</x-default-layout>
