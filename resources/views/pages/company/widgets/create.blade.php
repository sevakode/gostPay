{{-- Extends layout --}}
@extends('pages.company.layout')

{{-- Content --}}
@section('content-widget')
    <div class="card card-custom card-stretch gutter-b">
        <div class="row justify-content-center">
            <div class="col-xl-9">
                @include('pages.company.widgets.insert', ['route' => route('company.create')])
            </div>
        </div>
    </div>
@endsection
