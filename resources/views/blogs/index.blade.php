<x-default-layout>

    @section('title')
        {{ __('blog::blogs.blog_list') }}
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('breadcrumbs.blogs.index') }}
    @endsection

    <div class="card card-flush pt-3 mb-5 mb-lg-10">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">{{ __('blog::blogs.blog_list') }}</span>
            </h3>
            <div class="card-toolbar">
                <a href="{{ route('admin.blogs.create') }}" class="btn btn-sm btn-primary">
                    <i class="ki-duotone ki-plus fs-2"></i>{{ __('blog::blogs.ad_blog') }}</a>
            </div>
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        @if(count($blogs))
            <div class="card-body py-4">
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <!--begin::Table head-->
                        <thead>
                        <tr class="fw-bold text-muted">
                            <th class="w-25px">
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="1" data-kt-check="true"
                                           data-kt-check-target=".widget-9-check">
                                </div>
                            </th>
                            <th>{{ __('blog::blogs.Thumbnail') }}</th>
                            <th>{{ __('blog::blogs.BlogTitle') }}</th>
                            <th>{{ __('blog::blogs.Category') }}</th>
                            <th>{{ __('blog::blogs.PublishStatus') }}</th>
                            <th>{{ __('blog::blogs.DisplayOrder') }}</th>
                            <th class="pr-0">{{ __('blog::blogs.Status') }}</th>
                            <th>{{ __('blog::blogs.AddedLastModifiedDate') }}</th>
                            <th class="pr-0 text-right w-10">{{ __('blog::blogs.Action') }}</th>
                        </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                        @foreach($blogs as $blog)
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input name="id" class="form-check-input widget-9-check" type="checkbox"
                                               value="{{ $blog->id }}">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-45px me-5">
                                            <img src="assets/media/avatars/300-14.jpg" alt="">
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-dark fw-bold text-hover-primary fs-6">Ana
                                                Simmons</a>
                                            <span
                                                class="text-muted fw-semibold text-muted d-block fs-7">HTML, JS, ReactJS</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="#" class="text-dark fw-bold text-hover-primary d-block fs-6">Intertico</a>
                                    <span
                                        class="text-muted fw-semibold text-muted d-block fs-7">Web, UI/UX Design</span>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex flex-column w-100 me-2">
                                        <div class="d-flex flex-stack mb-2">
                                            <span class="text-muted me-2 fs-7 fw-bold">50%</span>
                                        </div>
                                        <div class="progress h-6px w-100">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 50%"
                                                 aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <a href="#"
                                       class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                                       data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                        <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div
                                        class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                        data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/user-management/users/view.html"
                                               class="menu-link px-3">Edit</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-users-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>

            </div>
        @else
            <div class="card-body p-0">
                <!--begin::Wrapper-->
                <div class="card-px text-center">
                    <!--begin::Title-->
                    <h2 class="fs-2x fw-bold mb-10">{{ __('blog::blogs.welcome_to_blog') }}</h2>
                    <!--end::Title-->

                    <!--begin::Action-->
                    <a href="{{ route('admin.blogs.create') }}"
                       class="btn btn-primary">{{ __('blog::blogs.AddBlog') }}</a>
                    <!--end::Action-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Illustration-->
                <div class="text-center px-4">
                    <img class="mw-100 mh-300px" alt="" src="{{ asset('vendor/invento-blog/media/empty_blog.png') }}">
                </div>
                <!--end::Illustration-->
            </div>
        @endif
    <!--end::Card body-->
    </div>


</x-default-layout>
