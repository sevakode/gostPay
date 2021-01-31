

<div class="card-header flex-wrap border-0 pt-6 pb-0">
    <div class="card-title">
        <h3 class="card-label">Карты
            <div class="text-muted pt-2 font-size-sm">{{ \Illuminate\Support\Facades\Auth::user()->company->name }}</div>
        </h3>
    </div>

    <div class="card-title">
        <h6 id="amount-all-cards"></h6>
    </div>

</div>
<div class="card-body">
    <!--begin: Search Form-->
    <!--begin::Search Form-->
    <div class="mb-7">
        <div class="row align-items-center">
            <div class="col-lg-6 col-xl-5">
                <div class="row align-items-center">
                    <div class="col-md-6 my-2 my-md-0">
                        <div class="input-icon">
                            <input type="text" class="form-control" placeholder="Search..." id="add_cards_datatable_search_query"/>
                            <span><i class="flaticon2-search-1 text-muted"></i></span>
                        </div>
                    </div>
                    <div class="col-md-5 my-2 my-md-0">
                        <div class="d-flex align-items-center">
                            <label class="mr-3 mb-0 d-none d-md-block">Статус:</label>
                            <select class="form-control" id="add_cards_datatable_search_status">
                                <option value="">Все</option>
                                <option value="1">Активная</option>
                                <option value="0">Пассивный</option>
                            </select>
                        </div>
                    </div>
                    @isset($searchUser)
                        <div class="col-md-4 my-2 my-md-0">
                            <div class="d-flex align-items-center">
                                <label class="mr-3 mb-0 d-none d-md-block">Пользователь:</label>
                                <select class="form-control" id="add_cards_datatable_search_type">
                                    <option value="">All</option>
                                    @foreach(\Illuminate\Support\Facades\Auth::user()->company->users()->get() as $user)
                                        <option value="{{ $user->id }}">{{ $user->fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endisset
                </div>
            </div>

            <div class="col-lg-4 col-md-9 col-sm-12">
                <div class="input-daterange input-group" id="kt_datepicker_5">
                    <input type="text" id="date-start" class="form-control" name="start">
                    <input type="text" id="date-end" class="form-control" name="end">
                </div>
            </div>
{{--            @if(\Illuminate\Support\Facades\Auth::user()->hasPermission(\App\Interfaces\OptionsPermissions::ACCESS_TO_REMOVE_CARDS['title']))--}}
{{--            <div class="col-lg-1 col-xl-1" style="padding-left: 0px; padding-right: 0px;">--}}
{{--                <a href="#" id="remove-cards" class="btn btn-light-danger px-6 font-weight-bold">Отсоединить</a>--}}
{{--            </div>--}}
{{--            @endif--}}
{{--            @if(\Illuminate\Support\Facades\Auth::user()->hasPermission(\App\Interfaces\OptionsPermissions::ACCESS_TO_REMOVE_CARDS['title']))--}}
{{--            <div class="col-lg-1 col-xl-1" style="padding-left: 0px; padding-right: 0px;">--}}
{{--                <a href="#" id="remove-cards" class="btn btn-light-danger px-6 font-weight-bold">--}}
{{--                    <img src="{{ asset('media/svg/icons/Navigation/Minus.svg') }}"/>--}}
{{--                    {{ Metronic::getSVG('media/svg/icons/Navigation/Minus.svg') }}--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            @endif--}}

            <div class="col-lg-1 col-xl-1" style="padding-left: 0px; padding-right: 0px;">
            </div>
            <div class="col-lg-1 col-xl-1" style="padding-left: 0px; padding-right: 0px;">
            </div>
            <div class="col-lg-1 col-xl-1" style="padding-left: 0px; padding-right: 0px;">
                <div id="checkbox-parameter" class="dropdown dropdown-inline d-none">
                <a href="javascript:;" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" data-toggle="dropdown">
                    <span class="svg-icon svg-icon-md">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="svg-icon">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"></path>
                                <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"></path>
                            </g>
                        </svg>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                    <ul class="navi flex-column navi-hover py-2">
                        <li class="navi-header font-weight-bolder text-uppercase font-size-xs text-primary pb-2">
                            Выберите действие:
                        </li>
                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission(\App\Interfaces\OptionsPermissions::ACCESS_TO_REMOVE_CARDS['title']))
                        <li class="navi-item">
                            <a href="#" id="remove-cards" class="navi-link disabled">
                                <span class="navi-icon"><i class="flaticon-circle text-danger"></i></span>
                                <span class="navi-text">Убрать</span>
                            </a>
                        </li>
                        @endif
                        @if(\Illuminate\Support\Facades\Route::is('profile_cards'))
                        <li class="navi-item">
                            <a href="#" id="download-cards-txt" class="navi-link disabled">
                                <span class="navi-icon"><i class="flaticon-doc text-warning"></i></span>
                                <span class="navi-text">Скачать</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!--end::Search Form-->
    <!--end: Search Form-->
    <!--begin: Datatable-->
    <table class="datatable datatable-bordered datatable-head-custom" id="add_cards_datatable">
    </table>
    <!--end: Datatable-->
</div>


@section('scripts_next')

    <script>
        window.addEventListener('load', function () {
            var datatable = $('#add_cards_datatable').KTDatatable({
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            url: '{{ route('datatables.user-cards') }}',
                            method: 'POST',
                            contentType: 'application/json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            params: {
                                id: {{ $user->id }},
                                access_cards: {{ $access_cards ?? '0' }},
                            },
                            timeout: 60000,
                            map: function map(raw) {
                                var dataSet = raw;
                                if (typeof raw.data !== 'undefined') {
                                    dataSet = raw.data;
                                }

                                if(typeof $('#amount-all-cards') !== 'undefined'){
                                    $('#amount-all-cards').html('Всего: ' + raw.amountAll)
                                }

                                if (typeof slider !== 'undefined') {
                                    if(raw.countCardsNoUser >= 0){
                                        slider.noUiSlider.options.range.max = raw.countCardsNoUser;
                                        slider.noUiSlider.updateOptions.length = raw.countCardsNoUser;
                                        slider.noUiSlider.updateOptions('max', raw.countCardsNoUser);
                                    }
                                }

                                return dataSet;
                            }
                        }
                    },
                    pageSize: 10,
                    serverPaging: true,
                    serverFiltering: true,
                    serverSorting: true,
                },

                sortable: true,
                pagination: true,
                search: {
                    input: $('#add_cards_datatable_search_query'),
                    key: 'generalSearch'
                },
                rows: {
                    autoHide: true,
                    afterTemplate: function (row, data, index) {
                        $('.event_click_checkbox').on('click', function () {
                            var status_check = 0;
                            $('input[name="checkboxes"]').each(function () {
                                if (this.checked) {
                                    status_check = 1;
                                }
                            });
                            if (status_check) {
                                $('#checkbox-parameter').removeClass('d-none');
                            } else {
                                $('#checkbox-parameter').addClass('d-none');
                            }
                        });
                    }
                },

                columns: [
                    {
                        field: 'id',
                        title: '№',
                        width: 20,
                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission(\App\Interfaces\OptionsPermissions::ACCESS_TO_REMOVE_CARDS['title']))
                        template: function template(row) {
                            return '<label class="checkbox event_click_checkbox">'+
                                '<input type="checkbox" value="'+row.id+'" name="checkboxes"/>'+
                                '<span></span>'+
                                '</label>'
                        }
                        @endif
                    },
                    {
                        field: 'number',
                        title: 'Номер карты',
                        template: function template(row) {
                            return '<a class="text-dark" href="'+ row.numberLink +'">'+ row.number +'</a>'
                        }
                    },
                    {
                        field: 'user',
                        title: 'Пользователь',
                        template: function template(row) {
                            if(row.user !== 'none') {
                                return '<a class="text-dark" href="'+ row.userLink +'">'+ row.user +'</a>'
                            }
                            else {
                                return row.user
                            }
                        }
                    },
                    {
                        field: 'type',
                        title: 'Тип карты',
                    },
                    {
                        field: 'state',
                        title: 'Статус',
                        template: function template(row) {
                            return row.state;
                        }
                    },
                    {
                        field: 'countPayments',
                        title: 'Количество платежей',
                    },
                    {
                        field: 'expiredAt',
                        title: 'Дата истечения срока',
                    },
                    {
                        field: 'amount',
                        title: 'Сумма платежей',
                    },
                ],
            });
            $('#add_cards_datatable_search_status').on('change', function () {
                datatable.search($(this).val().toLowerCase(), 'state');
            });
            $('#add_cards_datatable_search_type').on('change', function () {
                datatable.search($(this).val().toLowerCase(), 'Type');
            });
            $('#add_cards_datatable_search_status, #add_cards_datatable_search_type').selectpicker();

            $('#adding_random_cards').on('click', function () {
                datatable.setDataSourceParam('query.removeCards', '');
                datatable.setDataSourceParam('query.downloadCardsTxt', '');
                datatable.search(sliderInput.value, 'countCards');
                datatable.setDataSourceParam('query.countCards', '')
            });

            $('#adding_cards').on('click', function () {
                datatable.setDataSourceParam('query.removeCards', '');
                datatable.setDataSourceParam('query.downloadCardsTxt', '');
                datatable.setDataSourceParam('query.countCards', '')
                datatable.search($('#kt_select2_3').select2('data'), 'listCartForAdding');
                $('#kt_select2_3').val(null).trigger('change');
            });

            $('#remove-cards').on('click', function () {
                var checkboxes_value = [];
                $('input[name="checkboxes"]').each(function(){
                    //if($(this).is(":checked")) {
                    if(this.checked) {
                        checkboxes_value.push($(this).val());
                    }
                });
                checkboxes_value = checkboxes_value.toString();
                datatable.search(checkboxes_value, 'removeCards');
            });

            $('#download-cards-txt').on('click', function () {
                var checkboxes_value = [];
                $('input[name="checkboxes"]').each(function(){
                    //if($(this).is(":checked")) {
                    if(this.checked) {
                        checkboxes_value.push($(this).val());
                    }
                });
                // checkboxes_value = checkboxes_value.toString();

                $.ajax({
                    type:'post',
                    url:'{{ route('cards.download.txt') }}',
                    data:{
                        '_token':$('meta[name="csrf-token"]').attr('content'),
                        'cards': checkboxes_value,
                        'id': {{ $user->id }}
                    },
                    success: function(t) {
                        if(t) {
                            var link = document.createElement('a');
                            link.setAttribute('href', t);
                            link.setAttribute('download', 'download.txt');
                            link.click();
                        }
                        return false;
                    },
                });
            });


            $('#kt_datepicker_5').datepicker().on('changeDate', function(e) {
                date_start = $("#date-start").val();
                date_end = $("#date-end").val();

                date = {
                    'start': date_start,
                    'end': date_end
                };
                datatable.search(date, 'date');
            });
        });
    </script>
    <script>
        var arrows = {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
        var demos = function () {
                $('#kt_datepicker_5').datepicker({
                    rtl: KTUtil.isRTL(),
                    todayHighlight: true,
                    templates: arrows
                });
            };
    </script>
    <script>
        console.log($('.event_click_checkbox'));
            $('.event_click_checkbox').on('click', function () {
                var status_check = 0;
                $('input[name="checkboxes"]').each(function () {
                    //if($(this).is(":checked")) {
                    if (this.checked) {
                        status_check = 1;
                    }
                });
                if (status_check) {
                    $('#checkbox-parameter').removeClass('d-none');
                } else {
                    $('#checkbox-parameter').addClass('d-none');
                }
            });
    </script>
@endsection
{{--@endsection--}}


