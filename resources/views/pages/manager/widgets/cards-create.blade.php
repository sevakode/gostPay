{{-- Extends layout --}}
@extends('pages.manager.dashboard')

{{-- Content --}}
@section('content-widget')

{{--@extends('layout.default')--}}

{{-- Content --}}
{{--@section('content')--}}

@include('pages.manager.nav_panel_widgets.header-cards')

<div id="block-create-cards-pdf" class="card card-custom gutter-b">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Создать карту
                <div class="text-muted pt-2 font-size-sm">{{ \Illuminate\Support\Facades\Auth::user()->company->name }}</div>
            </h3>
        </div>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <div class="col-lg-6">
                <label>Номер:</label>
                <input type="text"
                       id="number_card"
                       minlength="16"
                       maxlength="16"
                       class="form-control"
                       name="number"
                       placeholder="Enter number card">
                <span class="form-text text-muted">Пожалуйста введите номер карты</span>
            </div>
                <div class="col-lg-2">
                    <label>CVC:</label>
                    <input id="cvc_card" name="cvc" type="text" maxlength="3" class="form-control" placeholder="Enter cvc">
                    <span class="form-text text-muted">Please enter your contact number</span>
                </div>
            <div class=" col-lg-3 col-md-9 col-sm-12">
                <label>Дата:</label>
                <div class="input-daterange input-group">
                    <input id="month_card" type="text" maxlength="2" class="form-control" placeholder="Month" name="date_month">
                    <div class="input-group-append">
                        <span class="input-group-text">/</span>
                    </div>
                    <input id="year_card" type="text" maxlength="2" class="form-control" placeholder="Year" name="date_year">
                </div>
                <span class="form-text text-muted">Пожалуйста введите срок годности карты</span>
            </div>
            <div class="row">
                <div class="col-lg-9 ml-lg-auto">
                    <button id="create_card" type="button" class="btn btn-primary mr-2">Добавить</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="block-create-cards-pdf" class="card card-custom gutter-b">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Создать карты PDF
                <div class="text-muted pt-2 font-size-sm">{{ \Illuminate\Support\Facades\Auth::user()->company->name }}</div>
            </h3>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Search Form-->
        <!--begin::Search Form-->
        <div class="mb-7">
                <div class="form-group row mb-6">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="custom-file">
                            <input type="file" name="pdf" accept="application/pdf" class="custom-file-input"
                                   id="create_cards_input_pdf">
                            <label class="custom-file-label" for="customFile">Выбрать файл</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-9 ml-lg-auto">
                            <button id="create_cards_pfd" type="button" class="btn btn-primary mr-2">Добавить</button>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
<div id="block-create-cards-pdf" class="card card-custom gutter-b">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Создать карты XLSX
                <div class="text-muted pt-2 font-size-sm">{{ \Illuminate\Support\Facades\Auth::user()->company->name }}</div>
            </h3>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Search Form-->
        <!--begin::Search Form-->
        <div class="mb-7">
                <div class="form-group row mb-6">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="custom-file">
                            <input type="file" name="xlsx"
                                   accept=".xlsx"
                                   class="custom-file-input"
                                   id="create_cards_input_xlsx">
                            <label class="custom-file-label" for="customFile">Выбрать файл</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-9 ml-lg-auto">
                            <button id="create_cards_xlsx" type="button" class="btn btn-primary mr-2">Добавить</button>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var inputs = [
                $('#number_card'),
                $('#cvc_card'),
                $('#month_card'),
                $('#year_card'),
            ];
            var fd = new FormData;


            $('#create_card').on('click', function () {
                $.each(inputs, function( index, value ) {
                    fd.append(value[0].name, value[0].value);
                });
                $.ajax({
                    type: 'post',
                    url: '{{ route('cards.create') }}',
                    dataType: "json",
                    data: fd,
                    processData: false,  // tell jQuery not to process the data
                    contentType: false,  // tell jQuery not to set contentType
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (t) {
                    },
                    beforeSend: function() {
                        KTApp.blockPage({
                            overlayColor: '#000000',
                            state: 'primary',
                            message: 'Добавляем карту...'
                        });
                    },
                    complete: function() {
                        KTApp.unblockPage();
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var input = $("#create_cards_input_pdf");
            var fd = new FormData;


            $('#create_cards_pfd').on('click', function () {
                fd.append(input[0].name, input.prop('files')[0]);
                $.ajax({
                    type: 'post',
                    url: '{{ route('cards.create.pdf') }}',
                    dataType: "json",
                    data: fd,
                    processData: false,  // tell jQuery not to process the data
                    contentType: false,  // tell jQuery not to set contentType
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (t) {
                        console.log('sdsd')
                    },
                    beforeSend: function() {
                        KTApp.blockPage({
                            overlayColor: '#000000',
                            state: 'primary',
                            message: 'Добавляем карты...'
                        });
                    },
                    complete: function() {
                        KTApp.unblockPage();
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var input = $("#create_cards_input_xlsx");
            var fd = new FormData;


            $('#create_cards_xlsx').on('click', function () {
                fd.append(input[0].name, input.prop('files')[0]);
                $.ajax({
                    type: 'post',
                    url: '{{ route('cards.create.xlsx') }}',
                    dataType: "json",
                    data: fd,
                    processData: false,  // tell jQuery not to process the data
                    contentType: false,  // tell jQuery not to set contentType
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (t) {
                        console.log('sdsd')
                    },
                    beforeSend: function() {
                        KTApp.blockPage({
                            overlayColor: '#000000',
                            state: 'primary',
                            message: 'Добавляем карты...'
                        });
                    },
                    complete: function() {
                        KTApp.unblockPage();
                    }
                });
            });
        });
    </script>
@endsection
