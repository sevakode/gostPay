{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
    {{-- Dashboard 1 --}}


    <div class="card card-custom gutter-b">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Последние транзакции
                    <div class="text-muted pt-2 font-size-sm">{{ \Illuminate\Support\Facades\Auth::user()->company->name }}</div>
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
                                    <input type="text" class="form-control" placeholder="Search..." id="payments_datatable_search_query"/>
                                    <span><i class="flaticon2-search-1 text-muted"></i></span>
                                </div>
                            </div>
                            @if(request()->user()->hasPermission(\App\Interfaces\OptionsPermissions::MANAGER_ROLE_SET['slug']))
                                <div id="users" class="col-md-4 my-2 my-md-0">
                                    <div class="d-flex align-items-center">
                                        <label class="mr-3 mb-0 d-none d-md-block">Пользователь:</label>
                                        <select class="form-control" id="payments_datatable_search_users">
                                            <option value="">Все пользователи</option>
                                            <option value="null">Без пользователей</option>
                                            @foreach(\Illuminate\Support\Facades\Auth::user()->company->usersAll()->get() as $user)
                                                <option value="{{ $user->id }}">{{ $user->fullname }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Search Form-->
            <!--end: Search Form-->
            <!--begin: Datatable-->
            <table class="datatable datatable-bordered datatable-head-custom" id="payments_datatable">
            </table>
            <!--end: Datatable-->
        </div>
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script>
        window.addEventListener('load', function () {
            var datatable = $('#payments_datatable').KTDatatable({
                data: {
                    serverPaging: true,
                    type: 'remote',
                    source: {
                        read: {
                            url: '{{ route('datatables.dashboard.payments') }}',
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
                    // pageSize: 10,
                    serverFiltering: true,
                    serverSorting: true
                },
                layout: {
                    height: 400,
                    scroll: true,
                    footer: false, // display/hide footer
                },
                rows: {
                    autoHide: false,
                },
                sortable: true,
                translate: {
                    records:{
                        noRecords: "Ничего не найдено."
                    }
                },
                pagination: true,

                search: {
                    input: $('#payments_datatable_search_query'),
                    key: 'generalSearch'
                },
                toolbar: {
                    items: {
                        info: true,
                        default: {
                            first: 'First',
                            prev: 'Previous',
                            next: 'Nexccct',
                            last: 'Last',
                            more: 'More pages',
                            input: 'Page number',
                            select: 'Select page size'
                        },
                        pagination: {
                            pageSizeSelect: [10, 20, 30, 50, 100, 500],
                            type: 'default',
                            pages: {}
                        }
                    },
                },
                columns: [
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
                        field: 'description',
                        title: 'Описание',
                    },
                    {
                        field: 'amount',
                        title: 'Сумма платежей',
                        template: function template(row) {
                            let color = 'text-success';

                             if(row.type === 'expenditure') {
                                 color = 'text-danger'
                             }

                             return '<span class=" '+color+' pr-0 pt-7 text-right align-middle">'+row.amount+row.currency+'</span>'
                         }
                    },
                    {
                        field: 'operation_at',
                        title: 'Дата операции',
                    },
                ],
            });

            $('#payments_datatable').on('datatable-on-goto-page', function(e, args) {

            });

            $('#payments_datatable_search_users').on('change', function () {
                datatable.search($(this).val().toLowerCase(), 'user_id');
            });
        });

    </script>
@endsection
