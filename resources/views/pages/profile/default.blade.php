{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
    <div class="d-flex flex-row">
        <div class="flex-md-row-auto w-md-275px w-xl-325px">
        @yield('asides_start')

        <!--begin::Profile Card-->
            <div class="card card-custom gutter-b">
                <!--begin::Body-->
                <div class="card-body pt-4">
                    <!--begin::Toolbar-->
                    <!--end::Toolbar-->
                    <!--begin::User-->
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                            <div class="symbol-label" style="background-image:url('{{asset($user->avatar)}}')"></div>
                            <i class="symbol-badge bg-success"></i>
                        </div>
                        <div>
                            <a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">{{ $user->fullname }}</a>
                            <div class="text-muted">{{ $user->role->name }}</div>
                        </div>
                    </div>
                    <!--end::User-->
                    <!--begin::Contact-->
                    <div class="py-9">
                        @isset($user->email)
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">Email:</span>
                                <a href="#" class="text-muted text-hover-primary">{{ $user->email }}</a>
                            </div>
                        @endisset
                        @isset($user->phone)
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">Телефон:</span>
                                <span class="text-muted">{{ $user->phone }}</span>
                            </div>
                        @endisset

                        @isset($user->telegram)
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">telegram:</span>
                                <a href="{{$user->telegramLink}}" class="text-muted text-hover-primary">
                                    {{ $user->telegram }}
                                </a>
                            </div>
                        @endisset
                        @isset($user->location)
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="font-weight-bold mr-2">Location:</span>
                                <span class="text-muted">{{ $user->location }}</span>
                            </div>
                        @endisset
                    </div>
                    <!--end::Contact-->
                    @yield('navbar')
                </div>
                <!--end::Body-->
            </div>
            <!--end::Profile Card-->

            @yield('asides_end')
        </div>
        <!--end::Aside-->
        <div class="col-xl-9">
            @yield('content_profile')
        </div>
        <!--end::Entry-->
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/pages/custom/profile/profile.js') }}" type="text/javascript"></script>
@endsection
