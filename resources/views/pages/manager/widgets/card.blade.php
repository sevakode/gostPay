{{-- Extends layout --}}
@extends('pages.manager.dashboard')

{{-- Content --}}
@section('content-widget')

{{--@extends('layout.default')--}}

{{-- Content --}}
{{--@section('content')--}}
{{--    {{ dd($card) }}--}}
@include('pages.manager.nav_panel_widgets.header-cards')

<div class="card card-custom gutter-b">
    <div class="card-body p-0">
        <!-- begin: Invoice-->
        <!-- begin: Invoice header-->
        <div class="row justify-content-center py-8 px-8 py-md-27 px-md-0">
            <div class="col-md-10">
                <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                    <h1 class="display-4 font-weight-boldest mb-10">
                        <span id="testtest">ИНФОРМАЦИЯ КАРТЫ</span>

                        <span class="dropdown-notes">

                            <button class="dropdown-notes-button btn btn-hover-light-warning btn-warning font-weight-bold btn-md flaticon-notes"
                                    type="button" >
                            </button>
                            <div class="dropdown-menu dropdown-menu-xl">

                                <div class="card card-custom" style="font-weight: 200;">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Заметки
                                        </h3>
                                        <button type="button"  id="close-dropdown-notes" class="close"
                                                data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <div id="kt_notes_message" style="height: 100px">

                                        </div>
                                        <div id="kt_notes_list">

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </span>
                    </h1>


                    <div class="d-flex flex-column align-items-md-end px-0">
                        <!--begin::Logo-->

                        <a href="#" class="mb-5">
                            <h4 class="text-dark">{{ $card->number }}</h4>
                        </a>
                        <!--end::Logo-->
                        <span class="d-flex flex-column align-items-md-end opacity-70">
                            @isset($card->card_description)<span>{{ $card->card_description }}</span>@endisset
                            @isset($card->card_type)<span>{{ $card->card_type }}</span>@endisset
                            @isset($card->state)<span class="
                                @if($card->state == \App\Models\Bank\Card::ACTIVE) text-success
                                @elseif($card->state == \App\Models\Bank\Card::CLOSE) text-danger
                                @else text-light-danger @endif">
                                {{ $card->stateRu }}
                            </span>@endisset
                        </span>

                    </div>
                </div>
                <div class="border-bottom w-100"></div>
                <div class="d-flex justify-content-between pt-6">
                    <div class="d-flex flex-column flex-root">
                        <span class="font-weight-bolder mb-2">Срок действия</span>
                        <span class="opacity-70">{{ $card->expiredAt->format('M d, Y') }}</span>
                    </div>
                    <div class="d-flex flex-column flex-root">
                        <span class="font-weight-bolder mb-2">Пользователь</span>
                        @if($card->user)
                            <a href="{{ route('user_cards', $card->user->id) }}" class="">
                                <span class="opacity-70 text-dark">{{ $card->user->fullname }}</span>
                            </a>
                        @else
                            <span class="opacity-70">{{ 'none' }}</span>
                        @endif
                    </div>
                    <div class="d-flex flex-column flex-root">
                        <span class="font-weight-bolder mb-2">Счет</span>
                        @if($card->invoice)
                            <a href="{{ route('invoice.show', $card->invoice->account_id) }}">
                                <span class="opacity-70 text-dark">
                                    {{
                                        $card->invoice->avail ?
                                        $card->invoice->currencySign . $card->invoice->avail :
                                        $card->invoice->account_id
                                    }}
                                </span>
                            </a>
                        @else
                            <span class="opacity-70">Счет неизвестен</span>
                        @endif
                    </div>
                    <div class="d-flex flex-column flex-root">
                        <span class="font-weight-bolder mb-2">Остаточный лимит</span>

                        <span class="opacity-70 {{ ($card->limit === 0) ? 'text-danger': ''}}" id="limit">
                            @if(is_null($card->limit)) Безлимит
                            @elseif($card->limit === 0) Заблокирован
                            @else {{ $card->currencySign.$card->limit }}
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- end: Invoice header-->
        <!-- begin: Invoice body-->
        <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
            <div class="col-md-10">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="pl-0 font-weight-bold text-muted text-uppercase">Дата</th>
                            <th class="pl-0 font-weight-bold text-muted text-uppercase">Описание</th>
{{--                            <th class="text-right font-weight-bold text-muted text-uppercase">Qty</th>--}}
                            <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">Сумма</th>
                            <th class="text-right font-weight-bold text-muted text-uppercase">Валюта</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($card->payments()->get() as $payment)
                        <tr class="font-weight-boldest">
                            <td class="border-0 pl-0 pt-7 d-flex align-items-center">
                                {{ $payment->operationAt->format('M d, Y') }}
                            </td>
                            <td class="text-left pt-7 align-middle">
                                {{ $payment->description }}
                            </td>
                            <td class="{{ $payment->type == \App\Models\Bank\Payment::EXPENDITURE ? 'text-danger' : 'text-success' }}
                                pr-0 pt-7 text-right align-middle">{{ $payment->amount }}</td>
                            <td class="text-right pt-7 align-middle">{{ $payment->currency }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end: Invoice body-->
        <!-- begin: Invoice footer-->
        <div class=" row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0 mx-0">
            <div class="col-md-10">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="font-weight-bold text-muted text-uppercase">СПОСОБ ОПЛАТЫ</th>
                            <th class="font-weight-bold text-muted text-uppercase">СТАТУС КАРТЫ</th>
                            <th class="font-weight-bold text-muted text-uppercase">ДАТА ОПЛАТЫ</th>
                            <th class="font-weight-bold text-muted text-uppercase text-right">ИТОГО</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="font-weight-bolder">
                            <td>{{ $card->card_description }}</td>
                            <td>{{ $card->state }}</td>
                            <td>{{ $card->expiredAt->format('M d, Y') }}</td>
                            <td class="text-primary font-size-h3 font-weight-boldest text-right">{{ $card->amount() }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@if($card->bank()->first()->isApiOfContract(\App\Classes\BankContract\CardLimitContract::class) and
(\Illuminate\Support\Facades\Auth::user()->hasPermission(\App\Interfaces\OptionsPermissions::ADMIN_ROLE_SET['slug']) or
\Illuminate\Support\Facades\Route::is('card')))
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <div class="form-group row mb-6">
                <label class="col-form-label text-right col-lg-3 col-sm-12">Установить лимит</label>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="row align-items-center">
                        <div class="col-4">
                            <input type="text" class="form-control" id="kt_nouislider_1_input"  placeholder="Quantity"/>
                        </div>
                        <div id="tooltip-controls">
                            <button id="bold-button"><i class="fa fa-bold"></i></button>
                            :
                        </div>

                        <div class="col-8">
                            <div id="kt_nouislider_1" class="nouislider-drag-danger"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-9 ml-lg-auto">
                        <button type="button" class="btn btn-primary" id="edit_spend_limit">
                            Добавить
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

    @section('scripts_next')

        <script>
            let dropdownClass = $('.dropdown-notes');
            let dropdownButtonClass = $('.dropdown-notes-button');
            let closeButton = $('#close-dropdown-notes.close');
            dropdownButtonClass.on('click', function () {
                dropdownButtonClass.dropdown('toggle');
            });
                $('body').on('click', function (e) {
                    let isTapModal = $(e.target).parents('.dropdown-notes').length;
                    let isCloseButton = closeButton.is(e.target) || $(e.target).parents('#close-dropdown-notes.close').length;

                    if (!isTapModal || (isTapModal && isCloseButton)) {
                        dropdownButtonClass.dropdown('hide');
                        statusDropdown = 0;
                    }
                });
            </script>
        <script>


            var toolbarSnow = [
                    [{header: [1, 2, false]}],
                    ['bold', 'italic', 'underline', 'strike'],
                    ['blockquote'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    // [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
                    // [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
                    // [{ 'direction': 'rtl' }],                         // text direction
                    //
                    // [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
                    // [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                    //
                    [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                    [{ 'font': [] }],
                    [{ 'align': [] }],
                    ['custom'],
                ];

            let optionsSnow = {
                modules: {
                    toolbar: {
                        container: toolbarSnow,
                    },
                },
                placeholder: '...',
                theme: 'snow', // or 'bubble'
            };
            let optionsReadOnly = {
                modules: {
                    toolbar: false,
                    // keyboard: false,
                },
                readOnly: true,
                placeholder: '' ,
                theme: 'bubble' // or 'bubble'
            };
            var quill = new Quill('#kt_notes_message', optionsSnow);
            let toolbar = quill.getModule('toolbar');
            toolbar.addHandler('image', function(value) {
                console.log(this.quill)
                if (value) {
                    console.log(this.quill)
                }
            });
            var datatable = $('#kt_notes_list').KTDatatable({
                data: {
                    type: 'local',
                    source: [
                        {
                            "id": 0,
                            'is_me': true,
                            "ops": [
                                {
                                    "insert": "hello asdfasf ad fas%\n"
                                },
                            ]
                        },
                        {
                            "id": 1 ,
                            'is_me': false,
                            "ops": [
                                {
                                    "insert": "hello asdfasf ad fas%\n"
                                },
                                {
                                    "attributes": {
                                        "italic": true
                                    },
                                    "insert": "asdfas as dzcv zxz hgfho ks erw"
                                },
                                {
                                    "insert": "\n"
                                },
                                {
                                    "attributes": {
                                        "underline": true
                                    },
                                    "insert": "asdfasfasfasf asdf as fas safaasd"
                                },
                                {
                                    "insert": "\n"
                                }
                            ]
                        },
                        {
                            "id": 2,
                            'is_me': true,
                            "ops": [
                                {
                                    "insert": "hello asdfasf ad fas%\n"
                                },
                                {
                                    "attributes": {
                                        "italic": true
                                    },
                                    "insert": "asdfas as dzcv zxz hgfho ks erw"
                                },
                                {
                                    "insert": "\n"
                                },
                                {
                                    "attributes": {
                                        "underline": true
                                    },
                                    "insert": "asdfasfasfasf asdf as fas safaasd"
                                },
                                {
                                    "insert": "\n"
                                }
                            ]
                        },
                        {
                            "id": 3,
                            'is_me': false,
                            "ops": [
                                {
                                    "insert": "hello asdfasf ad fas%\n"
                                },
                                {
                                    "attributes": {
                                        "italic": true
                                    },
                                    "insert": "asdfas as dzcv zxz hgfho ks erw"
                                },
                                {
                                    "insert": "\n"
                                },
                                {
                                    "attributes": {
                                        "underline": true
                                    },
                                    "insert": "asdfasfasfasf asdf as fas safaasd"
                                },
                                {
                                    "insert": "\n"
                                }
                            ]
                        },
                        {
                            "id": 4,
                            'is_me': true,
                            "ops": [
                                {
                                    "insert": "hello asdfasf ad fas%\n"
                                },
                                {
                                    "attributes": {
                                        "italic": true
                                    },
                                    "insert": "asdfas as dzcv zxz hgfho ks erw"
                                },
                                {
                                    "insert": "\n"
                                },
                                {
                                    "attributes": {
                                        "underline": true
                                    },
                                    "insert": "asdfasfasfasf asdf as fas safaasd"
                                },
                                {
                                    "insert": "\n"
                                }
                            ]
                        },
                        {
                            "id": 5,
                            'is_me': false,
                            "ops": [
                                {
                                    "insert": "hello asdfasf ad fas%\n"
                                },
                                {
                                    "attributes": {
                                        "italic": true
                                    },
                                    "insert": "asdfas as dzcv zxz hgfho ks erw"
                                },
                                {
                                    "insert": "\n"
                                },
                                {
                                    "attributes": {
                                        "underline": true
                                    },
                                    "insert": "asdfasfasfasf asdf as fas safaasd"
                                },
                                {
                                    "insert": "\n"
                                }
                            ]
                        },
                        {
                            "id": 6,
                            'is_me': true,
                            "ops": [
                                {
                                    "insert": "hello asdfasf ad fas%\n"
                                },
                                {
                                    "attributes": {
                                        "italic": true
                                    },
                                    "insert": "asdfas as dzcv zxz hgfho ks erw"
                                },
                                {
                                    "insert": "\n"
                                },
                                {
                                    "attributes": {
                                        "underline": true
                                    },
                                    "insert": "asdfasfasfasf asdf as fas safaasd"
                                },
                                {
                                    "insert": "\n"
                                }
                            ]
                        },
                        {
                            "id": 7,
                            'is_me': false,
                            "ops": [
                                {
                                    "insert": "hello asdfasf ad fas%\n"
                                },
                                {
                                    "attributes": {
                                        "italic": true
                                    },
                                    "insert": "asdfas as dzcv zxz hgfho ks erw"
                                },
                                {
                                    "insert": "\n"
                                },
                                {
                                    "attributes": {
                                        "underline": true
                                    },
                                    "insert": "asdfasfasfasf asdf as fas safaasd"
                                },
                                {
                                    "insert": "\n"
                                }
                            ]
                        },
                        {
                            "id": 8,
                            'is_me': true,
                            "ops": [
                                {
                                    "insert": "hello asdfasf ad fas%\n"
                                },
                                {
                                    "attributes": {
                                        "italic": true
                                    },
                                    "insert": "asdfas as dzcv zxz hgfho ks erw"
                                },
                                {
                                    "insert": "\n"
                                },
                                {
                                    "attributes": {
                                        "underline": true
                                    },
                                    "insert": "asdfasfasfasf asdf as fas safaasd"
                                },
                                {
                                    "insert": "\n"
                                }
                            ]
                        },
                        {
                            "id": 9,
                            'is_me': false,
                            "ops": [
                                {
                                    "insert": "hello asdfasf ad fas%\n"
                                },
                                {
                                    "attributes": {
                                        "italic": true
                                    },
                                    "insert": "asdfas as dzcv zxz hgfho ks erw"
                                },
                                {
                                    "insert": "\n"
                                },
                                {
                                    "attributes": {
                                        "underline": true
                                    },
                                    "insert": "asdfasfasfasf asdf as fas safaasd"
                                },
                                {
                                    "insert": "\n"
                                }
                            ]
                        },
                    ],
                    // pageSize: 10,
                    serverPaging: false,
                    serverFiltering: false,
                    serverSorting: false
                },
                layout: {
                    scroll: true,
                    height: 300
                },
                toolbar: {
                    layout: {

                    }
                },
                rows: {
                    autoHide: false,
                    afterTemplate: function (row, data, index) {
                        let message = new Quill('div[data-message-id="'+ data.id +'"]', optionsReadOnly)
                        message.setContents(data.ops, 'api')
                    },
                },
                sortable: false,
                pagination: false,
                // search: {
                //     input: $('#add_cards_datatable_search_query'),
                //     key: 'generalSearch'
                // },

                columns: [
                    {
                        field: 'insert',
                        title: '',
                        template: function template(row) {
                            let note_message = '<div class="kt_note_message" data-message-id="'
                                +
                                row.id
                                + '"></div>';
                            let items_status_me = 'start';
                            let side_me = 'left';
                            let color_me = 'bg-light-success';
                            let style_me = '';
                            if (row.is_me) {
                                items_status_me = 'end';
                                side_me = 'right';
                                color_me = '';
                                style_me = 'background-color: #ffd67e;';
                            }
                            return `
                            <div class="d-flex flex-column align-items-` + items_status_me + `">
                                <div class="d-flex align-items-center">
<!--                                    <div class="symbol symbol-circle symbol-40 mr-3">-->
<!--                                        <img alt="Pic" src="/metronic/theme/html/demo1/dist/assets/media/users/300_12.jpg">-->
<!--                                    </div>-->
                                    <div>
                                        <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">Matt Pears</a>
                                        <span class="text-muted font-size-sm">2 Hours</span>
                                    </div>
                                </div>
                                <div class="rounded `+ color_me +` text-dark-50 font-weight-bold font-size-lg text-`+side_me+` max-w-300px"
                                        style="`+style_me+`">
                                    ` + note_message + `
                                </div>
                            </div>`;
                        }
                    },

                ],
            });
        </script>

        @if($card->bank()->first()->isApiOfContract(\App\Classes\BankContract\CardLimitContract::class)
            and (\Illuminate\Support\Facades\Auth::user()->hasPermission(\App\Interfaces\OptionsPermissions::ADMIN_ROLE_SET['slug']) or
\Illuminate\Support\Facades\Route::is('card')))
            <script>
                var slider = document.getElementById('kt_nouislider_1');

                noUiSlider.create(slider, {
                    start: [ {{ $card->limit ?? 0 }} ],
                    step: 1,
                    range: {
                        'min': [ 0 ],
                        'max': [ {{ request()->user()->balance()->getSum() }} ]
                    },
                    format: wNumb({
                        decimals: 0
                    })
                });

                // init slider input
                var sliderInput = document.getElementById('kt_nouislider_1_input');

                slider.noUiSlider.on('update', function( values, handle ) {
                    sliderInput.value = values[handle];
                });

                sliderInput.addEventListener('change', function(){
                    slider.noUiSlider.set(this.value);
                });

                {{--&& sliderInput.value !== {{ $card->limit }}--}}
                $('#edit_spend_limit').on('click', function () {
                    if (sliderInput.value > 0) {
                        $.ajax({
                            type:'post',
                            url:'{{ route('cards.limit.update') }}',
                            data:{
                                '_token':$('meta[name="csrf-token"]').attr('content'),
                                'id': {{ $card->id }},
                                'limit': sliderInput.value,
                            },
                            success: function(data) {
                                $('#limit').html(data['limit']);

                                return true;
                            },
                        });
                    }
                });
            </script>
        @endif
    @endsection
@endsection

