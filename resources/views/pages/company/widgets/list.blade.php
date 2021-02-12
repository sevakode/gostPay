{{-- Extends layout --}}
@extends('pages.company.layout')

{{-- Content --}}
@section('content-widget')
    <div class="card card-custom card-stretch gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0">
            <h3 class="card-title font-weight-bolder text-dark">Компании</h3>
            <div class="card-toolbar">
                <a href="{{ route('company.create.show') }}" class="btn btn-primary mr-2">Создать</a>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-2">
        @foreach(\App\Models\Company::all() as $company)
            <!--begin::Item-->
                <div class="d-flex align-items-center mb-10">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-40 symbol-light-success mr-5">
                        <span class="symbol-label flex"
                              style="background-image: url({{$company->avatar('small') ?? asset('media/svg/avatars/009-boy-4.svg')}});
                                  background-repeat: no-repeat;
                                  background-size: 40px 40px;"
                        >
                        </span>
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Text-->
                    <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                        <a href="{{ route('company.login.get', $company->id) }}" class="text-dark text-hover-primary mb-1 font-size-lg">
                            {{ $company->name }}
                        </a>
                        <span class="text-muted" id="user-role-id-{{ $company->id }}">{{ $company->name }}</span>
                    </div>
                    <span style="width: 122px;">
                        <span class="label label-lg font-weight-bold  label-light-primary label-inline">
                            {{ $company->users()->count() }}
                        </span>
                    </span>
                    <!--end::Text-->
                    <!--begin::Dropdown-->
                    <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" title="" data-placement="left" data-original-title="Быстрые действия">
                        <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ki ki-bold-more-hor"></i>
                        </a>
                        <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right" style="">
                            <!--begin::Navigation-->
                            <ul class="navi navi-hover">
                                <li class="navi-header font-weight-bold py-4">
                                    <span class="font-size-lg">Действия:</span>
                                    <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="" data-original-title="Нажмите, чтобы узнать больше..."></i>
                                </li>
                                <li class="navi-separator mb-3 opacity-70"></li>
                                <li class="navi-item">
                                    <span class="navi-link">
                                        <span class="navi-text companyEventLogin"
                                              data-company-id="{{ $company->id}}">
                                            <span class="label label-xl label-inline label-light-success">
                                                Войти
                                            </span>
                                        </span>
                                    </span>
                                </li>
                                <li class="navi-item">
                                    <span class="navi-link">
                                        <span class="navi-text companyEventClose"
                                              data-company-id="{{ $company->id}}">
                                            <span class="label label-xl label-inline label-light-danger">
                                                Закрыть
                                            </span>
                                        </span>
                                    </span>
                                </li>
                                <li class="navi-separator mt-3 opacity-70"></li>
                            </ul>
                            <!--end::Navigation-->
                        </div>
                    </div>
                    <!--end::Dropdown-->
                </div>
                <!--end::Item-->
            @endforeach
        </div>
        <!--end::Body-->
    </div>
@endsection

@section('scripts')
    <script>
        $('.companyEventLogin').on('click', function () {
            let companyId = $(this).attr("data-company-id");
            $.ajax({
                type:'post',
                url:'{{ route('company.login.post') }}',
                dataType: "json",
                data:{
                    '_token':$('meta[name="csrf-token"]').attr('content'),
                    'id': companyId,
                },
                success: function (data) {
                    sendNotification()
                    setTimeout(function () {location.reload()}, 2500);
                },
                error: function () {
                    sendNotification()
                }
            });
        })
        $('.companyEventClose').on('click', function () {
            let companyId = $(this).attr("data-company-id");
            $.ajax({
                type:'delete',
                url:'{{ route('company.delete') }}',
                dataType: "json",
                data:{
                    '_token':$('meta[name="csrf-token"]').attr('content'),
                    'id': companyId,
                },
                success: function (data) {
                    sendNotification()
                    setTimeout(function () {location.reload()}, 2500);
                },
                error: function () {
                    sendNotification()
                }
            });
        })
    </script>
@endsection
