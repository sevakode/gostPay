{{-- Extends layout --}}
@extends('pages.manager.dashboard')

{{-- Content --}}
@section('content-widget')

{{--@extends('layout.default')--}}

{{-- Content --}}
{{--@section('content')--}}

@include('pages.manager.nav_panel_widgets.header-cards')

<div class="card card-custom">
    @include('pages.manager.nav_panel_widgets.cards-table', ['searchUser' => true])
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/pages/crud/ktdatatable/base/html-table.js') }}" type="text/javascript"></script>
@endsection
