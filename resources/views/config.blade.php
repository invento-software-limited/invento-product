<x-default-layout>

    @section('title')
        {{ __('blog::blogs.blog_configuration') }}
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('blog.config') }}
    @endsection

    <div class="card card-flush">
        <div class="card-header">
            <div class="card-title">
                <h4>{{ __('blog::blogs.configuration') }}</h4>
            </div>
        </div>

        <div class="card-body py-4" id="analytics_config">

            <form action="{{ route('admin.packages.blog.store') }}" method="post">
                @csrf

                <div class="mb-10">
                    <label class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input" name="status" type="checkbox" {{(  isset($status ) && $status) ? "checked"  : ''  }} />
                        <span class="form-check-label fw-semibold text-muted">{{ __('blog::blogs.status') }}</span>
                    </label>
                </div>

                <div class="d-flex justify-content-end mb-4">
                    <button type="submit" class="btn btn-info"><span class="indicator-label">{{ __('blog::blogs.submit') }}</span></button>
                </div>

            </form>

        </div>
    </div>


</x-default-layout>

