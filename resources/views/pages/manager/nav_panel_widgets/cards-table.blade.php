

<div class="card-header flex-wrap border-0 pt-6 pb-0">
    <div class="card-title">
        <h3 class="card-label">Карты
            <div class="text-muted pt-2 font-size-sm">{{ request()->user()->company->name }}</div>
        </h3>
    </div>
</div>
<div class="card-body">
    <!--begin: Search Form-->
    <!--begin::Search Form-->
    <div class="mb-7">
        <div class="row align-items-center">
            <div class="col-lg-9 col-xl-10">
                <div class="row align-items-center">
                    <div class="col-md-4 my-2 my-md-0">
                        <div class="input-icon">
                            <input type="text" class="form-control" placeholder="Search..." id="add_cards_datatable_search_query"/>
                            <span><i class="flaticon2-search-1 text-muted"></i></span>
                        </div>
                    </div>
                    <div class="col-md-4 my-2 my-md-0">
                        <div class="d-flex align-items-center">
                            <label class="mr-3 mb-0 d-none d-md-block">Статус:</label>
                            <select class="form-control" id="add_cards_datatable_search_status">
                                <option value="{{ \App\Models\Bank\Card::ACTIVE }}">Активные</option>
                                <option value="{{ \App\Models\Bank\Card::PENDING }}">В процессе</option>
                                <option value="{{ \App\Models\Bank\Card::CLOSE }}">Зыкрытые</option>
                                <option value="">Все</option>
                            </select>
                        </div>
                    </div>
                    @isset($searchUser)
                        <div class="col-md-4 my-2 my-md-0">
                            <div class="d-flex align-items-center">
                                <label class="mr-3 mb-0 d-none d-md-block">Пользователь:</label>
                                <select class="form-control" id="add_cards_datatable_search_type">
                                    <option value="">Все пользователи</option>
                                    <option value="null">Без пользователей</option>
                                    @foreach(request()->user()->company->users()->get() as $user)
                                        <option value="{{ $user->id }}">{{ $user->fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endisset
                </div>
            </div>
            <div class="col-lg-2 col-xl-2 text-center">
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
                            @if(\Illuminate\Support\Facades\Route::is('profile_cards') and
                    request()->user()->hasPermission(\App\Interfaces\OptionsPermissions::ACCESS_TO_REMOVE_CARDS['slug']) or
                    request()->user()->hasPermission(\App\Interfaces\OptionsPermissions::ADMIN_ROLE_SET['slug']))
                                <li class="navi-item">
                                    <a href="#" id="remove-cards" class="navi-link disabled">
                                        <span class="navi-icon"><i class="flaticon2-reply text-muted"></i></span>
                                        <span class="navi-text">Отвязать</span>
                                    </a>
                                </li>
                            @endif
                            @if(\Illuminate\Support\Facades\Route::is('profile_cards') and
                    request()->user()->hasPermission(\App\Interfaces\OptionsPermissions::ACCESS_TO_CLOSE_CARDS['slug']) or
                    request()->user()->hasPermission(\App\Interfaces\OptionsPermissions::ADMIN_ROLE_SET['slug']))
                                <li class="navi-item">
                                    <a href="#" data-toggle="modal" data-target="#close-cards-remove-modal" class="navi-link disabled">
                                        <span class="navi-icon"><i class="flaticon2-delete text-danger"></i></span>
                                        <span class="navi-text">Закрыть</span>
                                    </a>
                                </li>
                            @endif
                            @if(
                    request()->user()->hasPermission(\App\Interfaces\OptionsPermissions::OWNER['slug']))
                                <li class="navi-item">
                                    <a href="#" data-toggle="modal" data-target="#close-cards-modal" class="navi-link disabled">
                                        <span class="navi-icon"><i class="flaticon2-delete text-danger"></i></span>
                                        <span class="navi-text">Подать заявку на закрытие</span>
                                    </a>
                                </li>


                            @endif
                            @if(\Illuminate\Support\Facades\Route::is('profile_cards') or
                    request()->user()->hasPermission(\App\Interfaces\OptionsPermissions::ADMIN_ROLE_SET['slug']))
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
                        url: '{{ route('datatables.company-cards') }}',
                        method: 'POST',
                        contentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        timeout: 60000,
                        map: function map(raw) {
                            var dataSet = raw;
                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;
                            }

                            return dataSet;
                        }
                    }
                },
                pageSize: 10,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true
            },
            layout: {
                scroll: true,
            },
            rows: {
                autoHide: false,
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
            sortable: true,
            pagination: true,
            search: {
                input: $('#add_cards_datatable_search_query'),
                key: 'generalSearch'
            },

            columns: [
                {
                    field: 'id',
                    title: '<label class="checkbox event_click_checkbox">' +
                        '<input  id="check_all" type="checkbox" value="" name="checkboxes"/>' +
                        '<span></span>' +
                        '</label>',
                    width: 20,
                    sortable: false,
                    template: function template(row) {
                        return '<label class="checkbox event_click_checkbox">'+
                            '<input class="check_cards" type="checkbox" value="'+row.id+'" name="checkboxes"/>'+
                            '<span></span>'+
                            '</label>'
                    },
                },
                {
                    field: 'number',
                    title: 'Номер карты',
                    template: function template(row) {
                        if (row.state === '{{ \App\Models\Bank\Card::ACTIVE }}') {
                            color = 'text-success';
                        }
                        else if (row.state === '{{ \App\Models\Bank\Card::PENDING }}') {
                            color = 'text-light-danger';
                        }
                        else {
                            color = 'text-danger';
                        }

                        return '<a class="text-dark" href="'+ row.numberLink +'">'+ row.number +'</a><span class="'+
                            color +' ">*</span>';
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
                    field: 'project',
                    title: 'Проект',
                },
                {
                    field: 'amount',
                    title: 'Сумма платежей',
                },
                {
                    field: 'issue_at',
                    title: 'Дата выдачи',
                },
            ],
        });
        $('#check_all').on('click', function () {
            $(".check_cards").prop('checked', this.checked);
        });

        $('#add_cards_datatable_search_status').on('change', function () {
            datatable.search($(this).val().toLowerCase(), 'state');
        });
        $('#add_cards_datatable_search_type').on('change', function () {
            datatable.search($(this).val().toLowerCase(), 'type');
        });
        $('#add_cards_datatable_search_status, #add_cards_datatable_search_type').selectpicker();

        $('#adding_random_cards').on('click', function () {
            datatable.search(sliderInput.value, 'countCards');
        });

        $('.event_click_checkbox').on('click', function () {
            var status_check = 0;
            $('input[name="checkboxes"]').each(function (input) {
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

    });
</script>
<script>
    // var status_check = 0;
    //
    // $('.event_click_checkbox').on('click', function () {
    //     $('input[name="checkboxes"]').each(function (input) {
    //         //if($(this).is(":checked")) {
    //         if (this.checked) {
    //             status_check = 1;
    //         }
    //     });
    //     if (status_check) {
    //         $('#checkbox-parameter').removeClass('d-none');
    //     } else {
    //         $('#checkbox-parameter').addClass('d-none');
    //     }
    // });
</script>
@endsection


