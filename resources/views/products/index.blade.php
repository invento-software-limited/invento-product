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
                            <th class="w-80px">{{ __('product::products.thumbnail') }}</th>
                            <th>{{ __('product::products.title') }}</th>
                            <th class="text-center">{{ __('product::products.sku') }}</th>
                            <th class="text-center">{{ __('product::products.status') }}</th>
                            <th class="text-center">{{ __('product::products.created_at') }}</th>
                            <th class="pr-0 text-end w-10">{{ __('product::products.action') }}</th>
                        </tr>
                        </thead>
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
                                    <div class="symbol symbol-50px">
                                        <img src="{{ $product->thumbnail_url ?? asset('assets/media/svg/files/blank-image.svg') }}" alt="{{ $product->title }}" class="w-100">
                                    </div>
                                </td>

                                <td>
                                    <a href="{{ route('admin.products.edit',$product->id) }}"
                                       class="text-dark fw-bold text-hover-primary d-block fs-6">{{ $product->title }}</a>
                                </td>

                                <td class="text-center">
                                    <span class="text-dark fw-bold d-block fs-6">{{ $product->sku }}</span>
                                </td>


                                <td class="text-center d-flex justify-content-center align-items-center border-0">
                                    <label class="form-check form-switch form-check-custom form-check-solid mt-3">
                                        <input class="form-check-input statusCheckbox" name="status" data-id="{{ $product->id }}" onclick="event.preventDefault(); document.getElementById('statusForm-{{$product->id}}').submit();"
                                               type="checkbox" {{ $product->status ? 'checked' : '' }} />
                                    </label>

                                    {!! Form::open(array('route' =>['admin.products.update',$product->id], 'method'=>'patch' ,'id' => 'statusForm-'.$product->id)) !!}
                                    <input type="hidden" name="switch_status" value="{{ $product->status }}">
                                    {!! Form::close() !!}

                                </td>

                                <td class="text-center">
                                    {{ date('M d, Y',strtotime($product->created_at)) }}
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
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--begin::Pagination-->
                <div class="d-flex flex-stack flex-wrap pt-10">
                    <div class="fs-6 fw-semibold text-gray-700">
                        {{ __('product::products.showing_results', ['from' => $products->firstItem() ?: 0, 'to' => $products->lastItem() ?: 0, 'total' => $products->total()]) }}
                    </div>
                    <ul class="pagination">
                        {{-- Previous Page Link --}}
                        @if ($products->onFirstPage())
                            <li class="page-item previous disabled">
                                <span class="page-link"><i class="previous"></i></span>
                            </li>
                        @else
                            <li class="page-item previous">
                                <a class="page-link" href="{{ $products->appends(request()->except('page'))->previousPageUrl() }}">
                                    <i class="previous"></i>
                                </a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($products->onEachSide(1)->links()->elements as $element)
                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $products->currentPage())
                                        <li class="page-item active">
                                            <span class="page-link">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $products->appends(request()->except('page'))->url($page) }}">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($products->hasMorePages())
                            <li class="page-item next">
                                <a class="page-link" href="{{ $products->appends(request()->except('page'))->nextPageUrl() }}">
                                    <i class="next"></i>
                                </a>
                            </li>
                        @else
                            <li class="page-item next disabled">
                                <span class="page-link"><i class="next"></i></span>
                            </li>
                        @endif
                    </ul>
                </div>
                <!--end::Pagination-->
            </div>
        @else
            <div class="card-body">
                <div class="card-px text-center py-20 my-10">
                    <h2 class="fs-2x fw-bold mb-10">{{ __('product::products.welcome_products') }}</h2>
                    <p class="text-gray-400 fs-4 fw-semibold mb-10">{{ __('product::products.no_products') }}</p>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                        <i class="ki-duotone ki-plus fs-2"></i>{{ __('product::products.add_product') }}</a>
                </div>
            </div>
        @endif
        <!--end::Card body-->
    </div>

    @push('scripts')
        <script>
            $(document).ready(function () {
                $('.delete_table_row').click(function(e) {
                    e.preventDefault();
                    var id = $(this).attr('data-row');

                    Swal.fire({
                        text: "{{ __('product::products.delete_confirm') }}",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "{{ __('product::products.delete_yes') }}",
                        cancelButtonText: "{{ __('product::products.delete_no') }}",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        }
                    }).then(function (result) {
                        if (result.value) {
                            Swal.fire({
                                text: "{{ __('product::products.deleted') }}",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "{{ __('product::products.ok_got_it') }}",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            }).then(function () {
                                // delete row
                                var url = '{{ route("admin.products.destroy", ":id") }}';
                                url = url.replace(':id', id);

                                $.ajax({
                                    type: "DELETE",
                                    url: url,
                                    data: {
                                        "_token": "{{ csrf_token() }}",
                                    },
                                    success: function (response) {
                                        if (response.status) {
                                            location.reload();
                                        }
                                    }
                                });
                            });
                        }
                    });
                });
            });
        </script>
    @endpush
</x-default-layout>
