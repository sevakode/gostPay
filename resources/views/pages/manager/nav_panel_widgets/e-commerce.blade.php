<div class="d-flex align-items-center pb-9">
    <!--begin::Symbol-->
    <div class="symbol symbol-45 symbol-light mr-4">
        <span class="symbol-label">
            <span class="svg-icon svg-icon-2x svg-icon-dark-50">
                <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Group.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>
                        <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
                        <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
                        <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
                    </g>
                </svg>
                <!--end::Svg Icon-->
            </span>
        </span>
    </div>
    <!--end::Symbol-->
    <!--begin::Text-->
    <div class="d-flex flex-column flex-grow-1">
        <a href="{{ route('cards') }}" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Bank Cards</a>
        <span class="text-muted font-weight-bold">Работа с банком</span>
    </div>
    <!--end::Text-->
    <!--begin::label-->
    <span class="font-weight-bolder label label-xl label-light-success label-inline px-3 py-5 min-w-45px mr-1">
        {{ \Illuminate\Support\Facades\Auth::user()->company->cards()->whereActive()->count() }}
    </span>
    <span class="font-weight-bolder label label-xl label-light-info label-inline px-3 py-5 min-w-45px">
        {{ \Illuminate\Support\Facades\Auth::user()->company->cards()->free()->count() }}
    </span>
    <!--end::label-->
</div>
