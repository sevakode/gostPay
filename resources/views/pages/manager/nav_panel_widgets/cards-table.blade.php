

<div class="card-header flex-wrap border-0 pt-6 pb-0">
    <div class="card-title">
        <h3 class="card-label">Карты
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
                                    @foreach(\Illuminate\Support\Facades\Auth::user()->company->users()->get() as $user)
                                        <option value="{{ $user->id }}">{{ $user->fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endisset
                </div>
            </div>
{{--            <div class="col-lg-3 col-xl-2 mt-5 mt-lg-0">--}}
{{--                <a href="#" class="btn btn-light-primary px-6 font-weight-bold">Search</a>--}}
{{--            </div>--}}
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
    console.log('dsaasd')
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
            },
            sortable: true,
            pagination: true,
            search: {
                input: $('#add_cards_datatable_search_query'),
                key: 'generalSearch'
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
                    field: 'updated_at',
                    title: 'Дата выдачи',
                },
            ],
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
    });


</script>
@endsection


