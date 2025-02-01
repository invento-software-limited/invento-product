<x-default-layout>

    @section('title')
        {{ __('product::products.product_list') }}
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('products.index') }}
    @endsection

    <div class="card card-flush pt-3 mb-5 mb-lg-10">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">{{ __('product::products.product_list') }}</span>
            </h3>
            <div class="card-toolbar">
                <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-primary">
                    <i class="ki-duotone ki-plus fs-2"></i>{{ __('product::products.add_product') }}</a>
            </div>
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        @if(count($products))
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
                            <th>{{ __('product::products.name') }}</th>
                            <th class="text-center">{{ __('product::products.designation') }}</th>
                            <th class="text-center">{{ __('product::products.department') }}</th>
                            <th class="text-center">{{ __('product::products.status') }}</th>
                            <th class="text-center">{{ __('product::products.display_order') }}</th>
                            <th class="text-center">{{ __('product::products.created_at') }}</th>
                            <th class="pr-0 text-end w-10">{{ __('product::products.action') }}</th>
                        </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>

                        @foreach($products as $product)
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input name="id" class="form-check-input widget-9-check" type="checkbox"
                                               value="{{ $product->id }}">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">

                                        <div class="symbol symbol-45px me-5">
                                            <img src="{{ $product->image }}" alt="image">
                                        </div>

                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="{{ route('admin.products.edit',$product->id) }}"
                                               class="text-dark text-hover-info fs-6">
                                                {{ $product->name }}
                                                @if($product->id_number)
                                                    <br>
                                                    <span class="fs-10px">{{ $product->id_number }}</span>
                                                @endif
                                            </a>
                                        </div>
                                    </div>
                                </td>

                                <td class="text-center">
                                    <a class="text-dark text-hover-info d-block fs-6">{{ $product->designation }}</a>
                                </td>

                                <td class="text-center">
                                    <a href="{{ route('admin.products.departments.edit',$product->product_department_id) }}"
                                       class="text-dark text-hover-info d-block fs-6">{{ $product->department_name }}</a>
                                </td>


                                <td class="text-center d-flex justify-content-center align-items-center border-0">
                                    <label class="form-check form-switch form-check-custom form-check-solid mt-3">
                                        <input class="form-check-input statusCheckbox" name="status"
                                               data-id="{{ $product->id }}"
                                               onclick="event.preventDefault(); document.getElementById('statusForm-{{$product->id}}').submit();"
                                               type="checkbox" {{ $product->status ? 'checked' : '' }} />
                                    </label>

                                    {!! Form::open(array('route' =>['admin.products.update',$product->id], 'method'=>'patch' ,'id' => 'statusForm-'.$product->id)) !!}
                                    <input type="hidden" name="status_switch" value="{{ $product->status }}">
                                    {!! Form::close() !!}
                                </td>

                                <td class="text-center">
                                    <a class="text-dark text-hover-info d-block fs-6">{{ $product->display_order }}</a>
                                </td>

                                <td class="text-center">
                                    <a class="text-dark text-hover-info d-block fs-6">{{ date('M d, Y',strtotime($product->created_at)) }}</a>
                                </td>

                                <td class="text-end">
                                    <a href="#"
                                       class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                                       data-kt-menu-trigger="click"
                                       data-kt-menu-placement="bottom-end">{{ __('product::products.action') }}
                                        <i class="ki-duotone ki-down fs-5 ms-1"></i></a>

                                    <div
                                            class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                            data-kt-menu="true">

                                        <div class="menu-item px-3">
                                            <a href="{{ route('admin.products.edit',$product->id) }}"
                                               class="menu-link px-3">{{ __('product::products.edit') }}</a>
                                        </div>

                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3 delete_table_row"
                                               data-row="{{ $product->id }}">{{  __('product::products.delete')  }}</a>
                                        </div>

                                        <form id="delete_form_{{ $product->id }}" method="post"
                                              action="{{ route('admin.products.destroy',$product->id) }}">
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
                    <h2 class="fs-2x fw-bold mb-10">{{ __('product::products.product_list_is_empty') }}</h2>
                    <!--end::Title-->

                    <!--begin::Action-->
                    <a href="{{ route('admin.products.create') }}"
                       class="btn btn-primary">{{ __('product::products.add_product') }}</a>
                    <!--end::Action-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Illustration-->
                <div class="text-center px-4">
                    <img class="mw-100 mh-300px" alt="" src="{{ asset('vendor/product/media/empty_product.png') }}">
                </div>
                <!--end::Illustration-->
            </div>
        @endif
        <!--end::Card body-->
    </div>


</x-default-layout>
