{{-- Extends layout --}}
@extends('pages.account_bank.layout')

{{-- Content --}}
@section('content-widget')
    <div class="card card-custom card-stretch gutter-b">
        <div class="row justify-content-center">
            <div class="col-xl-9">
                @include('pages.account_bank.widgets.insert', [
                        'route' => route('bank.account.creating'),
                         'company' => request()->user()->company,
                         'status' => 'create'
                    ])
            </div>
        </div>
    </div>
@endsection
