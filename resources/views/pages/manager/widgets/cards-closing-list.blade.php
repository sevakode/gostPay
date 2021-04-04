{{-- Extends layout --}}
@extends('pages.manager.dashboard')

{{-- Content --}}
@section('content-widget')
    <div class="card card-custom card-stretch gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0">
            <h3 class="card-title font-weight-bolder text-dark">{{ $page_title }}</h3>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-2">
        @foreach($cards as $card)
            <!--begin::Item-->

                <span class="d-flex align-items-center mb-10" id="card-{{ $card->id }}">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-40 symbol-light-success mr-5">
                        <span class="symbol-label">
                            <img src="{{ asset('media/svg/avatars/009-boy-4.svg') }}"
                                 class="h-75 align-self-end" alt="">
                        </span>
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Text-->
                    <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                        @if($card->user()->exists())
                        <a href="{{ route('user_cards', $card->user()->first()->id) }}" class="text-dark text-hover-primary mb-1 font-size-lg">
                            {{ $card->user()->first()->fullname }}
                        </a>
                        <span class="text-muted" id="user-role-id-{{ $card->user()->first()->id }}">{{ $card->user()->first()->role->name }}</span>

                        @else
                            <span class="text-dark text-hover-primary mb-1 font-size-lg">None</span>
                            <span class="text-muted">Никто не привязан к карте</span>
                        @endif
                    </div>
                    <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                        <a href="{{ route('card', $card->id) }}" class="text-dark text-hover-primary mb-1 font-size-lg">
                           {{ $card->number }}
                        </a>
                        <span class="text-muted">Запрос на закрытие карты</span>
                    </div>
                    <span style="width: 100px;"></span>
                    <span style="width: 50px;">
                        <a href="#" class="btn btn-hover-light-success btn-sm btn-icon success" data-card-id="{{ $card->id }}"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="flaticon2-check-mark text-success"></i>
                        </a>
                    </span>
                    <span style="">
                    <a href="#" class="btn btn-hover-light-danger btn-sm btn-icon closed" data-card-id="{{ $card->id }}"
                       aria-haspopup="true" aria-expanded="false"
                       id="card-id-{{ $card->id }}">
                        <i class="flaticon2-cancel text-danger"></i>
                    </a>
                    </span>
                    <!--end::Dropdown-->
                <!--end::Item-->
                </span>
            @endforeach
        </div>
        <!--end::Body-->
    </div>
@endsection

@section('scripts')
    <script>
        $('.success ').on('click', function () {
            let cardId = $(this).attr("data-card-id");
            $.ajax({
                type:'post',
                url:'{{ route('cards_closing') }}',
                dataType: "json",
                data:{
                    '_token':$('meta[name="csrf-token"]').attr('content'),
                    'card_id': cardId,
                    'status': true
                },
                success: function (data) {
                    div = $('#card-'+ data.card_id);
                    div.html('')
                    sendNotification()
                },
                error: function () {
                    sendNotification()
                }
            });
        })
        $('.closed ').on('click', function () {
            let cardId = $(this).attr("data-card-id");
            $.ajax({
                type:'post',
                url:'{{ route('cards_closing') }}',
                dataType: "json",
                data:{
                    '_token':$('meta[name="csrf-token"]').attr('content'),
                    'card_id': cardId,
                    'status': false
                },
                success: function (data) {
                    div = $('#card-'+ data.card_id);
                    div.html('')
                    sendNotification()
                },
                error: function () {
                    sendNotification()
                }
            });
        })
    </script>
@endsection
