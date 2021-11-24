{{-- Extends layout --}}
@extends('pages.account_bank.layout')

{{-- Content --}}
@section('content-widget')
    <div class="card card-custom gutter-b">
        <div class="row justify-content-center">
            <div class="col-xl-9">
                @include('pages.account_bank.widgets.insert', [
                        'route' => route('bank.account.updating', $account->id),
                         'company' => request()->user()->company,
                         'status' => 'edit',
                         'account' => $account
                    ])
            </div>
        </div>
    </div>
    @if(request()->user()->hasPermissionTo(App\Interfaces\OptionsPermissions::ACCESS_TO_SHOW_BALANCE_FOR_COMPANY['slug'])
     and request()->user()->hasPermissionTo(App\Interfaces\OptionsPermissions::ACCESS_TO_SHOW_BALANCE_FOR_COMPANY_USERS['slug']))
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <div class="form-group row mb-6">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Пополнить счет для компании</label>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <select class="form-control select2" id="select_companies" name="param" ></select>
                    </div>
                    <div class="row">
                        <div class="col-lg-9 ml-lg-auto">
                            <button type="button" class="btn btn-primary" id="button-pay" data-toggle="modal" data-target="#addBalanceModal">
                                Пополнить
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addBalanceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Пополнить баланс</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-form-label text-right col-lg-3 col-sm-12">Счет</label>
                            <div class="col-lg-8 col-md-8 col-sm-12">
                                <select class="form-control select2" id="selectpicker_invoices" name="param" ></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label text-right col-lg-3 col-sm-12">Сумма</label>
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <input class="form-control" id="summa_mask" type="text"/>
                                <span class="form-text text-muted">Тип оплаты <code>€ ___.__1.234,56</code></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="reset" data-dismiss="modal" id="pay_company" class="btn btn-primary mr-2">Добавить</button>
                    </div>
                </div>
            </div>
        </div>

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
                            @if(request()->user()->hasPermission(\App\Interfaces\OptionsPermissions::ADMIN_ROLE_SET['slug']))
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
    @endif
@endsection

@push('scripts')

    <script>
        window.addEventListener('load', function () {
            var datatable = $('#payments_datatable').KTDatatable({
                data: {
                    serverPaging: true,
                    type: 'remote',
                    source: {
                        read: {
                            url: '{{ route('datatables.accounts.transactions', $account->id) }}',
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
                        field: 'company_name',
                        title: 'Название компании',
                        template: function template(row) {
                            return '<a class="text-dark" href="'+ row.numberLink +'">'+ row.company_name +'</a>';
                        }
                    },
                    {
                        field: 'user',
                        title: 'Пользователь',
                        template: function template(row) {
                            return '<a class="text-dark" href="'+ row.userLink +'">'+ row.user +'</a>';
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
                            console.log(row.type)
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
                console.log(args.page);
            });

            $('#payments_datatable_search_users').on('change', function () {
                datatable.search($(this).val().toLowerCase(), 'user_id');
            });

            $('#pay_company').on('click', function () {
                console.log($('#summa_mask'))
                datatable.search({
                    "company": $('#select_companies').select2('data'),
                    "account": $('#selectpicker_invoices').select2('data'),
                    "amount": $('#summa_mask').inputmask()[0].inputmask.unmaskedvalue()
                }, 'eventPayCompany');
                $('#select_companies').val(null).trigger('change');
                datatable.setDataSourceParam('eventPayCompany.company', '');
                datatable.setDataSourceParam('eventPayCompany.account', '');
                datatable.setDataSourceParam('eventPayCompany.amount', '');
            });
        });

    </script>
    @if(\Illuminate\Support\Facades\Auth::user()
            ->hasPermission(\App\Interfaces\OptionsPermissions::ACCESS_TO_ADD_CARDS['slug']))

        <script>
            let select = $("#select_companies").select2({
                placeholder: "Поиск компании в котором есть данный банк",
                allowClear: true,
                ajax: {
                    url: "{{route('datatables.accounts.companies', $account->id)}}",
                    method: 'GET',
                    dataType: 'json',
                    delay: 250,
                    data: function data(params) {
                        return {
                            q: params.term,
                            // search term
                            page: params.page,
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                        };
                    },
                    processResults: function processResults(data, params) {
                        // parse the results into the format expected by Select2
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data, except to indicate that infinite
                        // scrolling can be used
                        params.page = params.page || 1;
                        return {
                            results: data.items,
                            pagination: {
                                more: params.page * 30 < data.total_count
                            }
                        };
                    },
                    cache: true
                },
                escapeMarkup: function escapeMarkup(markup) {
                    console.log()
                    return markup;
                },
                // let our custom formatter work
                minimumInputLength: 0,
                // templateResult: formatRepo,
                // omitted for brevity, see the source of this page
                // templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
            });

            $("#button-pay").on('click', function () {

                let div_summa_mask = $("#summa_mask").prop( "disabled", true);
                $('#selectpicker_invoices').select2({
                     placeholder: "Select a state",
                     allowClear: true,
                     ajax: {
                         url: "{{ asset('') }}datatables/account/{{ $account->id }}/companies/"+ select[0].value +"/invoices/select",
                         method: 'GET',
                         dataType: 'json',
                         delay: 250,
                         data: function data(params) {
                             return {
                                 q: params.term,
                                 page: params.page,
                                 '_token': $('meta[name="csrf-token"]').attr('content'),
                             };
                         },
                         processResults: function processResults(data, params) {
                             params.page = params.page || 1;
                             return {
                                 results: data.items,
                                 pagination: {
                                     more: params.page * 30 < data.total_count
                                 }
                             };
                         },
                         cache: true
                     },
                     escapeMarkup: function escapeMarkup(markup) {
                         return markup;
                     },
                     minimumInputLength: 0,
                 })

                $('#selectpicker_invoices').on('select2:select', function (e) {
                    currency = e.params.data.currency;
                    div_summa_mask.inputmask(currency + ' 999.999.999,99',
                        {
                            numericInput: true
                        }
                    );

                    div_summa_mask.prop( "disabled", false );
                });


            })
        </script>
    @endif
@endpush


