{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Profile Personal Information-->
                <div class="d-flex flex-row">
                    <!--begin::Aside-->
                    <div class="flex-row-auto offcanvas-mobile w-300px w-xl-350px" id="kt_profile_aside">
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
                                        <div class="mt-2">
                                            <a href="#" class="btn btn-sm btn-primary font-weight-bold mr-2 py-2 px-3 px-xxl-5 my-1">Чат</a>
                                            <a href="#" class="btn btn-sm btn-success font-weight-bold py-2 px-3 px-xxl-5 my-1">Follow</a>
                                        </div>
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
                                    {{--                @isset($user->phone)--}}
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="font-weight-bold mr-2">Телефон:</span>
                                        <span class="text-muted">{{ $user->phone ?? '+7 (777) 777 77-77' }}</span>
                                    </div>
                                    {{--                @endisset--}}
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


                    @yield('content_profile')
                </div>
                <!--end::Profile Personal Information-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/pages/custom/profile/profile.js') }}" type="text/javascript"></script>
@endsection
