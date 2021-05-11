

{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
    <div class="d-flex flex-row">
        <div class="flex-md-row-auto w-md-275px w-xl-325px">
            <!--begin::Nav Panel Widget 3-->
            @include('pages.manager.navbar')
            <!--end::Nav Panel Widget 3-->
        </div>

        <div class="col-xl-9">
            <!--begin::Base Table Widget 1-->
            @yield('content-widget')
            <!--end::Base Table Widget 1-->
        </div>

    </div>


@endsection

{{-- Scripts Section--}}
@section('scripts')
    <script src="{{ asset('js/pages/custom/education/school/students.js?') }}"></script>
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/pages/custom/profile/profile.js') }}" type="text/javascript"></script>
    @yield('scripts_next')
@endsection
