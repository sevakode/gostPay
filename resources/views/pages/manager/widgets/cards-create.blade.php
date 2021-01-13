{{-- Extends layout --}}
@extends('pages.manager.dashboard')

{{-- Content --}}
@section('content-widget')

{{--@extends('layout.default')--}}

{{-- Content --}}
{{--@section('content')--}}

@include('pages.manager.nav_panel_widgets.header-cards')

<div id="block-create-cards-pdf" class="card card-custom">
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
                            <input type="file" name="pdf" accept="application/pdf" class="custom-file-input" id="create_cards_input">
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
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var input = $("#create_cards_input");
            var fd = new FormData;


            $('#create_cards_pfd').on('click', function () {
                fd.append('file', input.prop('files')[0]);
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
@endsection
