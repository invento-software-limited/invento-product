<x-default-layout>

    @section('title')
        {{ __('doctor::doctors.doctor_configuration') }}
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('doctor.config') }}
    @endsection

    <div class="card card-flush">
        <div class="card-header">
            <div class="card-title">
                <h4>{{ __('doctor::doctors.configuration') }}</h4>
            </div>
        </div>

        <div class="card-body py-4" id="analytics_config">

            <form action="{{ route('admin.packages.doctors.store') }}" method="post">
                @csrf

                <div class="mb-10">
                    <label class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input" name="status" type="checkbox" {{(  isset($status ) && $status) ? "checked"  : ''  }} />
                        <span class="form-check-label fw-semibold text-muted">{{ __('doctor::doctors.status') }}</span>
                    </label>
                </div>

                <div class="d-flex justify-content-end mb-4">
                    <button type="submit" class="btn btn-info"><span class="indicator-label">{{ __('doctor::doctors.submit') }}</span></button>
                </div>

            </form>

        </div>
    </div>


</x-default-layout>

