<x-default-layout>

    @section('title')
        {{ __('product::categories.category_list') }}
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('products.categories.index') }}
    @endsection

    <div class="card card-flush pt-3 mb-5 mb-lg-10">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">{{ __('product::categories.category_list') }}</span>
            </h3>
            <div class="card-toolbar">
                <a href="{{ route('admin.products.categories.create') }}" class="btn btn-sm btn-primary">
                    <i class="ki-duotone ki-plus fs-2"></i>{{ __('product::categories.add_category') }}</a>
            </div>
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        @if(count($categories))
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
                            <th>{{ __('product::categories.name') }}</th>
                            <th class="text-center">{{ __('product::categories.parent_name') }}</th>
                            <th class="text-center">{{ __('product::categories.status') }}</th>
                            <th class="text-center">{{ __('product::categories.created_at') }}</th>
                            <th class="pr-0 text-end w-10">{{ __('product::categories.action') }}</th>
                        </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input name="id" class="form-check-input widget-9-check" type="checkbox"
                                               value="{{ $category->id }}">
                                    </div>
                                </td>

                                <td>
                                    <a href="{{ route('admin.products.categories.edit',$category->id) }}"
                                       class="text-dark fw-bold text-hover-primary d-block fs-6">{{ $category->name }}</a>
                                </td>

                                <td>
                                    <a class="text-dark fw-bold text-hover-primary d-block fs-6">{{ $category->name }}</a>
                                </td>

                                <td class="text-center d-flex justify-content-center align-items-center border-0">
                                    <label class="form-check form-switch form-check-custom form-check-solid mt-3">
                                        <input class="form-check-input statusCheckbox" name="status" data-id="{{ $category->id }}" onclick="event.preventDefault(); document.getElementById('statusForm-{{$category->id}}').submit();"
                                               type="checkbox" {{ $category->status ? 'checked' : '' }} />
                                    </label>

                                    {!! Form::open(array('route' =>['admin.products.categories.update',$category->id], 'method'=>'patch' ,'id' => 'statusForm-'.$category->id)) !!}
                                    <input type="hidden" name="status_switch" value="{{ $category->status }}">
                                    {!! Form::close() !!}

                                </td>

                                <td class="text-center">
                                    {{ date('M d, Y',strtotime($category->created_at)) }}
                                </td>

                                <td class="text-end">
                                    <a href="#"
                                       class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                                       data-kt-menu-trigger="click"
                                       data-kt-menu-placement="bottom-end">{{ __('product::categories.action') }}
                                        <i class="ki-duotone ki-down fs-5 ms-1"></i></a>

                                    <div
                                            class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                            data-kt-menu="true">

                                        <div class="menu-item px-3">
                                            <a href="{{ route('admin.products.categories.edit',$category->id) }}"
                                               class="menu-link px-3">{{ __('product::categories.edit') }}</a>
                                        </div>

                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3 delete_table_row"
                                               data-row="{{ $category->id }}">{{  __('product::categories.delete')  }}</a>
                                        </div>

                                        <form id="delete_form_{{ $category->id }}" method="post"
                                              action="{{ route('admin.products.categories.destroy',$category->id) }}">
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
                    <h2 class="fs-2x fw-bold mb-10">{{ __('product::categories.welcome_to_category') }}</h2>
                    <!--end::Title-->

                    <!--begin::Action-->
                    <a href="{{ route('admin.products.categories.create') }}"
                       class="btn btn-primary">{{ __('product::categories.add_category') }}</a>
                    <!--end::Action-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Illustration-->
                <div class="text-center px-4">
                    <img class="mw-100 mh-300px" alt="" src="{{ asset('vendor/product/media/empty_category.png') }}">
                </div>
                <!--end::Illustration-->
            </div>
        @endif
        <!--end::Card body-->
    </div>


</x-default-layout>
