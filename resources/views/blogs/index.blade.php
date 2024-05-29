<x-default-layout>

    @section('title')
        {{ __('blog::blogs.blog_list') }}
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('blogs.index') }}
    @endsection

    <div class="card card-flush pt-3 mb-5 mb-lg-10">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">{{ __('blog::blogs.blog_list') }}</span>
            </h3>
            <div class="card-toolbar">
                <a href="{{ route('admin.blogs.create') }}" class="btn btn-sm btn-primary">
                    <i class="ki-duotone ki-plus fs-2"></i>{{ __('blog::blogs.add_blog') }}</a>
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
                            <th>{{ __('blog::blogs.blog_title') }}</th>
                            <th>{{ __('blog::blogs.category') }}</th>
                            <th class="text-center">{{ __('blog::blogs.publish_status') }}</th>
                            <th class="text-center">{{ __('blog::blogs.is_featured') }}</th>
                            <th class="text-center">{{ __('blog::blogs.display_order') }}</th>
                            <th class="text-center">{{ __('blog::blogs.created_at') }}</th>
                            <th class="pr-0 text-end w-10">{{ __('blog::blogs.action') }}</th>
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
                                <td class="w-25">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-45px me-5">
                                            <img src="{{ $blog->thumbnail }}" alt="{{ __('blog::blogs.thumbnail') }}">
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="{{ route('admin.blogs.edit',$blog->id) }}" class="text-dark text-hover-info fs-6">{{ $blog->title }}</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('admin.blogs.categories.edit',$blog->blog_category_id) }}" class="text-dark text-hover-info d-block fs-6">{{ $blog->category_name }}</a>
                                </td>
                                <td class="text-center d-flex justify-content-center align-items-center border-0">
                                    <label class="form-check form-switch form-check-custom form-check-solid mt-3">
                                        <input class="form-check-input statusCheckbox" name="status" data-id="{{ $blog->id }}" onclick="event.preventDefault(); document.getElementById('statusForm-{{$blog->id}}').submit();"
                                               type="checkbox" {{ $blog->status ? 'checked' : '' }} />
                                    </label>

                                    {!! Form::open(array('route' =>['admin.blogs.update',$blog->id], 'method'=>'patch' ,'id' => 'statusForm-'.$blog->id)) !!}
                                    <input type="hidden" name="status_switch" value="{{ $blog->status }}">
                                    {!! Form::close() !!}
                                </td>

                                <td class="text-center">
                                    <a class="text-dark text-hover-info d-block fs-6">{{ $blog->is_featured ? 'True' : 'False' }}</a>
                                </td>

                                <td class="text-center">
                                    <a class="text-dark text-hover-info d-block fs-6">{{ $blog->display_order }}</a>
                                </td>

                                <td class="text-center">
                                    <a class="text-dark text-hover-info d-block fs-6">{{ date('M d, Y',strtotime($blog->created_at)) }}</a>
                                </td>

                                <td class="text-end">
                                    <a href="#"
                                       class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                                       data-kt-menu-trigger="click"
                                       data-kt-menu-placement="bottom-end">{{ __('blog::blogs.action') }}
                                        <i class="ki-duotone ki-down fs-5 ms-1"></i></a>

                                    <div
                                            class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                            data-kt-menu="true">

                                        <div class="menu-item px-3">
                                            <a href="{{ route('admin.blogs.edit',$blog->id) }}"
                                               class="menu-link px-3">{{ __('blog::blogs.edit') }}</a>
                                        </div>

                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3 delete_table_row"
                                               data-row="{{ $blog->id }}">{{  __('blog::blogs.delete')  }}</a>
                                        </div>

                                        <form id="delete_form_{{ $blog->id }}" method="post"
                                              action="{{ route('admin.blogs.destroy',$blog->id) }}">
                                            @csrf
                                            @method('delete')
                                        </form>

                                    </div>

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
                       class="btn btn-primary">{{ __('blog::blogs.add_blog') }}</a>
                    <!--end::Action-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Illustration-->
                <div class="text-center px-4">
                    <img class="mw-100 mh-300px" alt="" src="{{ asset('vendor/blog/media/empty_blog.png') }}">
                </div>
                <!--end::Illustration-->
            </div>
        @endif
        <!--end::Card body-->
    </div>


</x-default-layout>
