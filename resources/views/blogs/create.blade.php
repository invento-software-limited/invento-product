<x-default-layout>

    @section('title')
        {{ __('blog::blogs.add_blog') }}
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('breadcrumbs.blogs.create') }}
    @endsection

        {!! Form::open(array('route' =>'admin.blogs.store', 'method'=>'post','class'=>'form d-flex flex-column flex-lg-row' ,'id' => 'kt_ecommerce_add_category_form')) !!}

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
                            <input type="text" name="title" id="title" class="form-control mb-2" value="" />
                            <div class="text-muted fs-7">A category name is required and recommended to be unique.</div>

                        </div>

                        <div class="mb-10 fv-row">
                            <label class="required form-label">{{ __('blog::blogs.short_description') }}</label>
                            <textarea rows="5" name="short_description" id="short_description" class="form-control mb-2" placeholder="Product name" > </textarea>
                            <div class="text-muted fs-7">A category name is required and recommended to be unique.</div>

                        </div>

                        <div class="mb-10 fv-row">
                            <label class="form-label">Description</label>
                            <div id="kt_ecommerce_add_category_description" name="content" class="min-h-200px mb-2"></div>

                            <div class="text-muted fs-7">Set a description to the category for better visibility.</div>
                        </div>

                        <div class="mb-10 fv-row">
                            <label class="form-label">{{ __('blog::blogs.tags') }}</label>
                            <input type="text" name="tag" id="tag" class="form-control mb-2" value="" />
                            <div class="text-muted fs-7">A category name is required and recommended to be unique.</div>

                        </div>

                    </div>
                </div>



                @include('partials.seo-field',['module' => 'blogs'])



                <div class="d-flex justify-content-end">

                    <button type="submit" class="btn btn-primary"><span class="indicator-label">Save Changes</span></button>

                </div>
            </div>

            <div class="d-flex flex-column gap-7 gap-lg-10 w-100  mb-7 w-lg-400px">

                <!--begin::Thumbnail settings-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>Thumbnail</h2>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body text-center pt-0">
                        <!--begin::Image input-->
                        <!--begin::Image input placeholder-->
                        <style>.image-input-placeholder { background-image: url('{{ asset('assets/media/svg/files/blank-image.svg') }}'); } [data-bs-theme="dark"] .image-input-placeholder { background-image: url('assets/media/svg/files/blank-image-dark.svg'); }</style>
                        <!--end::Image input placeholder-->
                        <!--begin::Image input-->
                        <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                            <!--begin::Preview existing avatar-->
                            <div class="image-input-wrapper w-150px h-150px"></div>
                            <!--end::Preview existing avatar-->
                            <!--begin::Label-->
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                <!--begin::Icon-->
                                <i class="ki-duotone ki-pencil fs-7">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <!--end::Icon-->
                                <!--begin::Inputs-->
                                <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                <input type="hidden" name="avatar_remove" />
                                <!--end::Inputs-->
                            </label>
                            <!--end::Label-->
                            <!--begin::Cancel-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
															<i class="ki-duotone ki-cross fs-2">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</span>
                            <!--end::Cancel-->
                            <!--begin::Remove-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
															<i class="ki-duotone ki-cross fs-2">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</span>
                            <!--end::Remove-->
                        </div>
                        <!--end::Image input-->
                        <!--begin::Description-->
                        <div class="text-muted fs-7">Set the category thumbnail image. Only *.png, *.jpg and *.jpeg image files are accepted</div>
                        <!--end::Description-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Thumbnail settings-->
                <!--begin::Status-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>Category</h2>
                        </div>
                        <!--end::Card title-->

                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Select2-->
                        <select class="form-select mb-2" name="category" id="category" data-control="select2" data-hide-search="false" data-placeholder="Select an option">
                            <option></option>
                            <option value="published">Published</option>
                            <option value="scheduled">Scheduled</option>
                        </select>
                        <!--end::Select2-->

                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Status-->


                <!--begin::Status-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>Status</h2>
                        </div>
                        <!--end::Card title-->

                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Select2-->
                        <select name="status" id=status class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" >
                            <option></option>
                            <option value="published" selected="selected">Published</option>
                            <option value="scheduled">Scheduled</option>
                        </select>
                        <!--end::Select2-->

                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Status-->

            </div>

        {!! Form::close() !!}


        @push('scripts')

            <script src="{{ asset('vendor/invento-blog/js/init.js') }}"></script>

            <!-- Laravel Javascript Validation -->
            <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

            {!! JsValidator::formRequest('Invento\Blog\Requests\BlogRequest', '#kt_ecommerce_add_category_form') !!}


        @endpush

</x-default-layout>
