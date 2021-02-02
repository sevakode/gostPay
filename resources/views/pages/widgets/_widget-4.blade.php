{{-- Stats Widget 12 --}}

{{--<div class="card card-custom {{ @$class }}">--}}
{{--    --}}{{-- Body --}}
{{--    <div class="card-body d-flex flex-column p-0">--}}
{{--        <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">--}}
{{--            <span class="symbol symbol-50 symbol-light-primary mr-2">--}}
{{--                <span class="symbol-label">--}}
{{--                    {{ Metronic::getSVG("media/svg/icons/Communication/Group.svg", "svg-icon-xl svg-icon-primary") }}--}}
{{--                </span>--}}
{{--            </span>--}}
{{--            <div class="d-flex flex-column text-right">--}}
{{--                <span class="text-dark-75 font-weight-bolder font-size-h3">+6,5K</span>--}}
{{--                <span class="text-muted font-weight-bold mt-2">New Users</span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div id="kt_stats_widget_12_chart" class="card-rounded-bottom"  style="height: 150px"></div>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="card card-custom bg-light-info card-stretch gutter-b">
    <!--begin::Body-->
    <div class="card-body">
        <span class="svg-icon svg-icon-2x svg-icon-info">
            <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Media/Equalizer.svg-->
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
        <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">
            ₽{{ request()->user()->company->sumCardsPayments() }}
        </span>
        <span class="font-weight-bold text-muted font-size-sm">Всего расходов компании</span>
    </div>
    <!--end::Body-->
</div>
