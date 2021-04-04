
{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Notice-->
            <!--begin: Row-->
            <div class="row">
                <div class="col-lg-8">
                    @include('modules.features.miscellaneous.dual_listbox.default', ['adsasd', 'adas'])
                </div>
            </div>
            <!--end: Row-->
            <!--begin: Row-->
        </div>
        <!--end::Container-->
    </div>


@endsection

{{-- Scripts Section --}}
@section('scripts')
    {{--    <script src="{{ asset('js/pages/features/miscellaneous/dual-listbox.js') }}"></script>--}}
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/pages/custom/profile/profile.js') }}" type="text/javascript"></script>
@endsection
