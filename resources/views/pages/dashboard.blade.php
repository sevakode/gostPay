{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    {{-- Dashboard 1 --}}
    <div class="row">
{{--        <div class="col-lg-6 col-xxl-4">--}}
{{--            @include('pages.widgets._widget-1', ['class' => 'card-stretch gutter-b'])--}}
{{--        </div>--}}

{{--        <div class="col-lg-6 col-xxl-4">--}}
{{--            @include('pages.widgets._widget-2', ['class' => 'card-stretch gutter-b'])--}}
{{--        </div>--}}

        <div class="col-lg-6 col-xxl-6">
            @include('pages.widgets._widget-3', ['class' => 'card-stretch gutter-b'])
        </div>
        <div class="col-lg-6 col-xxl-6"></div>
        <div class="col-lg-6 col-xxl-2 order-1 order-xxl-1">
            @include('pages.widgets._widget-4', ['class' => 'card-stretch gutter-b'])
        </div>

{{--        <div class="col-lg-6 col-xxl-4 order-1 order-xxl-1">--}}
{{--            @include('pages.widgets._widget-5', ['class' => 'card-stretch gutter-b'])--}}
{{--        </div>--}}

{{--        <div class="col-xxl-8 order-2 order-xxl-1">--}}
{{--            @include('pages.widgets._widget-6', ['class' => 'card-stretch gutter-b'])--}}
{{--        </div>--}}

{{--        <div class="col-lg-6 col-xxl-4 order-1 order-xxl-2">--}}
{{--            @include('pages.widgets._widget-7', ['class' => 'card-stretch gutter-b'])--}}
{{--        </div>--}}

{{--        <div class="col-lg-6 col-xxl-4 order-1 order-xxl-2">--}}
{{--            @include('pages.widgets._widget-8', ['class' => 'card-stretch gutter-b'])--}}
{{--        </div>--}}

{{--        <div class="col-lg-12 col-xxl-4 order-1 order-xxl-2">--}}
{{--            @include('pages.widgets._widget-9', ['class' => 'card-stretch gutter-b'])--}}
{{--        </div>--}}
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
{{--    <script src="{{ asset('js\pages\widgets.js') }}" type="text/javascript"></script>--}}
    <script>
    jQuery(document).ready(function () {
        $.ajax({
        type:'post',
        url:'{{ route('datatables.payment-chart') }}',
        dataType: "json",
        data:{
            '_token':$('meta[name="csrf-token"]').attr('content'),
        },
        success: function (data) {

                var element = document.getElementById("kt_stats_widget_7_chart");

                if (!element) {
                    return;
                }

                var options = {
                    series: [{
                        name: 'Расход по всем картам пользователя',
                        data: data['amount']
                    }],
                    chart: {
                        type: 'area',
                        height: 150,
                        toolbar: {
                            show: false
                        },
                        zoom: {
                            enabled: false
                        },
                        sparkline: {
                            enabled: true
                        }
                    },
                    plotOptions: {},
                    legend: {
                        show: false
                    },
                    dataLabels: {
                        enabled: false
                    },
                    fill: {
                        type: 'solid',
                        opacity: 1
                    },
                    stroke: {
                        curve: 'smooth',
                        show: true,
                        width: 3,
                        colors: [KTApp.getSettings()['colors']['theme']['base']['success']]
                    },
                    xaxis: {
                        categories: data['users'],
                        axisBorder: {
                            show: false,
                        },
                        axisTicks: {
                            show: false
                        },
                        labels: {
                            show: false,
                            style: {
                                colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                                fontSize: '12px',
                                fontFamily: KTApp.getSettings()['font-family']
                            }
                        },
                        crosshairs: {
                            show: false,
                            position: 'front',
                            stroke: {
                                color: KTApp.getSettings()['colors']['gray']['gray-300'],
                                width: 1,
                                dashArray: 3
                            }
                        },
                        tooltip: {
                            enabled: true,
                            formatter: undefined,
                            offsetY: 0,
                            style: {
                                fontSize: '12px',
                                fontFamily: KTApp.getSettings()['font-family']
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            show: false,
                            style: {
                                colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                                fontSize: '12px',
                                fontFamily: KTApp.getSettings()['font-family']
                            }
                        }
                    },
                    states: {
                        normal: {
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        },
                        hover: {
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        },
                        active: {
                            allowMultipleDataPointsSelection: false,
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        }
                    },
                    tooltip: {
                        style: {
                            fontSize: '12px',
                            fontFamily: KTApp.getSettings()['font-family']
                        },
                        y: {
                            formatter: function (val) {
                                return "₽" + val;
                            }
                        }
                    },
                    colors: [KTApp.getSettings()['colors']['theme']['light']['success']],
                    markers: {
                        colors: [KTApp.getSettings()['colors']['theme']['light']['success']],
                        strokeColor: [KTApp.getSettings()['colors']['theme']['base']['success']],
                        strokeWidth: 3
                    }
                };

                var chart = new ApexCharts(element, options);
                chart.render();
        },
        error: function (data) {
            console.log('error')
        }
    });
    });
    </script>
@endsection
