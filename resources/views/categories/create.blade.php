<x-default-layout>

    @section('title')
        {{ __('product::categories.add_category') }}
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('products.categories.create') }}
    @endsection

    {!! Form::open(array('route' =>'admin.products.categories.store', 'method'=>'post','class'=>'form d-flex flex-column flex-lg-row' ,'id' => 'kt_product_category_form')) !!}
    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10 me-lg-10">
        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title">
                    <h2>{{ __('product::categories.category_details') }}</h2>
                </div>
            </div>

            <div class="card-body pt-0">

                <div class="mb-5 fv-row">
                    <label class="required form-label">{{ __('product::categories.name') }}</label>
                    <input type="text" name="name" id="name"
                           class="form-control mb-2 meta_title meta_url @error('name') is-invalid @enderror" value=""/>

                    @error('name')
                    <div id="name-error" class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div class="text-muted fs-7">{{ __('product::categories.name_text') }}</div>

                </div>

                <div class="mb-5 fv-row">
                    <label class="form-label">{{ __('product::categories.parent_category') }}</label>

                    <select class="form-select mb-2" name="parent_category" id="parent_category" data-control="select2"
                            data-hide-search="false" data-placeholder="{{  __('product::categories.no_parent_category') }}">
                        <option></option>
                        @foreach($categories as $key => $val)
                            <option value="{{ $key }}">{{ $val }}</option>
                        @endforeach
                    </select>

                    <div class="text-muted fs-7">{{ __('product::categories.parent_category_text') }}</div>
                </div>

                <div class="mb-10 fv-row">
                    <label class="form-label">{{ __('product::categories.icon') }}</label>
                    <input type="text" name="icon" id="icon"
                           class="form-control mb-2 @error('icon') is-invalid @enderror" value=""/>

                    @error('icon')
                    <div id="icon-error" class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div class="text-muted fs-7">{{ __('product::categories.icon_text') }}</div>

                </div>


                <div class="mb-10 fv-row">
                    <label class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input" name="status" type="checkbox" checked/>
                        <span class="form-check-label fw-semibold text-muted">{{ __('product::categories.status') }}</span>
                    </label>
                </div>
                
                @custom_fields(\App\Models\CustomField::MODULES['Product Category'], null)

                <div class="mt-10 fv-row">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary"><span
                                    class="indicator-label">{{__('product::categories.submit')}}</span>
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

        {!! JsValidator::formRequest('Invento\Product\Requests\CategoryRequestRequest', '#kt_product_category_form') !!}

    @endpush

</x-default-layout>
