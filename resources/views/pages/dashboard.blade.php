{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    {{-- Dashboard 1 --}}
    <div class="row" >
        @if(request()->user()->company and request()->user()->hasPermission(\App\Interfaces\OptionsPermissions::MANAGER_ROLE_SET['title']))
            <div class="col-lg-6 col-xxl-6">
                @include('pages.widgets._widget-3', ['class' => 'card-stretch gutter-b'])
            </div>
            <div class="col-lg-6 col-xxl-6">
                @include('pages.widgets._widget-2', ['class' => 'card-stretch gutter-b'])
            </div>

            <div class="col-lg-12 col-xxl-12">
                @include('pages.widgets._widget-1', ['class' => 'card-stretch gutter-b'])
            </div>
            <div class="col-lg-6 col-xxl-2 order-1 order-xxl-1">
                @include('pages.widgets._widget-4', ['class' => 'card-stretch gutter-b'])
            </div>
        @endif
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script>
        var chart = {};
        var getOptions = function (data) {
            return  {
                series: [{
                    name: 'Расход по всем картам',
                    data: data['amount']
                }],
                    chart: {
                type: 'area',
                    height: 300,
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
                        colors: [data['colors'][0]]
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
                colors: [data['colors'][1]],
                    markers: {
                colors: [KTApp.getSettings()['colors']['theme']['light']['success']],
                    strokeColor: [KTApp.getSettings()['colors']['theme']['base']['success']],
                    strokeWidth: 3
            }
            }
        };
        var chartArea = function (date_start = null, date_end = null){
            $.ajax({
                type: 'post',
                url: '{{ route('charts.areas') }}',
                dataType: "json",
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    date_end: date_end,
                    date_start: date_start
                },
                success: function (data) {
                    $.each(data ,function (key, chartOptions) {
                        var element = document.getElementById(chartOptions.title);
                        if (!element) {
                            return;
                        }

                        chart[chartOptions.title] = new ApexCharts(element, getOptions(chartOptions));
                        chart[chartOptions.title].render();
                    })
                    $("#sum-cards").html(data[0].amounts)
                },
                error: function (data) {
                    console.log('error')
                }
            })
        };
        jQuery(document).ready(function () {
            chartArea();
            $('#datepicker_chart').datepicker().on('changeDate', function(e) {
                console.log(chart);
                date_start = $("#date-start").val();
                date_end = $("#date-end").val();

                $.ajax({
                    type: 'post',
                    url: '{{ route('charts.areas') }}',
                    dataType: "json",
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        date_end: date_end,
                        date_start: date_start
                    },
                    success: function (data) {
                        $.each(data ,function (key, chartOptions) {
                            chart[chartOptions.title].updateOptions(getOptions(chartOptions))
                        });
                        $("#sum-cards").html(data[0].amounts)
                    }
                });
            });
        });

    </script>

@endsection
