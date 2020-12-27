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
                    @include('pages.profile.edit.items.profile')

{{--                    @include('pages.profile.edit.items.account')--}}

{{--                    @include('pages.profile.edit.items.change-password')--}}

{{--                    @include('pages.profile.edit.items.setting')--}}
                </ul>
            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body">
            <form class="form" id="kt_form">
                <div class="tab-content">
                    @include('pages.profile.edit.tabs.profile')

{{--                    @include('pages.profile.edit.tabs.account')--}}

{{--                    @include('pages.profile.edit.tabs.change-password')--}}

{{--                    @include('pages.profile.edit.tabs.setting')--}}
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
