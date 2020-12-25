{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <!--begin::Card header-->
        <div class="card-header card-header-tabs-line nav-tabs-line-3x">
            <!--begin::Toolbar-->
            <div class="card-toolbar">
                <ul class="nav nav-tabs nav-bold nav-tabs-line nav-tabs-line-3x">
                    @include('pages.profile.items.edit.profile')

{{--                    @include('pages.profile.items.edit.account')--}}

{{--                    @include('pages.profile.items.edit.change-password')--}}

{{--                    @include('pages.profile.items.edit.setting')--}}
                </ul>
            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body">
            <form class="form" id="kt_form">
                <div class="tab-content">
                    @include('pages.profile.tabs.edit.profile')

{{--                    @include('pages.profile.tabs.edit.account')--}}

{{--                    @include('pages.profile.tabs.edit.change-password')--}}

{{--                    @include('pages.profile.tabs.edit.setting')--}}
                </div>
            </form>
        </div>
        <!--begin::Card body-->
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
@endsection
