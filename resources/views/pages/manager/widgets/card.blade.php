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
                    <h1 class="display-4 font-weight-boldest mb-10">ИНФОРМАЦИЯ КАРТЫ</h1>
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
                            <a href="{{ route('invoice.show', $card->invoice->account_id) }}" class="">
                                <span class="opacity-70 text-dark">
                                    {{ $card->invoice->currencySign }}{{ $card->invoice->avail }}
                                </span>
                            </a>
                        @else
                            <span class="opacity-70">Счет неизвестен</span>
                        @endif
                    </div>
                    <div class="d-flex flex-column flex-root">
                        <span class="font-weight-bolder mb-2">Геолокация</span>
                        <span class="opacity-70">{{ $card->geo ?? 'Россия' }}</span>
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
        <div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0 mx-0">
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
        <!-- end: Invoice footer-->
        <!-- begin: Invoice action-->
{{--        <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">--}}
{{--            <div class="col-md-10">--}}
{{--                <div class="d-flex justify-content-between">--}}
{{--                    <button type="button" class="btn btn-light-primary font-weight-bold" onclick="window.print();">Download Order Details</button>--}}
{{--                    <button type="button" class="btn btn-primary font-weight-bold" onclick="window.print();">Print Order Details</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <!-- end: Invoice action-->
        <!-- end: Invoice-->
    </div>
</div>
@endsection
