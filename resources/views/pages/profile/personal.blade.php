{{-- Extends layout --}}
{{--@extends('layout.default')--}}
@extends('pages.profile.default')


@section('navbar')
    @include('pages.profile.navbar.me')
@endsection

{{-- Content --}}
@section('content_profile')
    <!--begin::Card-->
    <div class="card card-custom card-stretch">
            <!--begin::Header-->
            <div class="card-header py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">Личные данные</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">Обновите вашу личную информацию</span>
                </div>
                <div class="card-toolbar">
                    <button type="submit" form="form-update-personal" class="btn btn-success mr-2">Сохранить изменения</button>
                    {{--                <button type="reset" class="btn btn-secondary">Cancel</button>--}}
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            <form class="form" id="form-update-personal" enctype="multipart/form-data" action="{{ route('profile_update') }}" method="POST">
            @csrf
            <!--begin::Body-->
                <div class="card-body">
                    <div class="row">
                        <label class="col-xl-3"></label>
                        <div class="col-lg-9 col-xl-6">
                            <h5 class="font-weight-bold mb-6">Информация о клиенте</h5>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Аватар</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="image-input image-input-outline" id="kt_profile_avatar"
                                 style="background-image: url({{asset($user->avatar)}})">
                                <div class="image-input-wrapper"
                                     style="background-image: url({{asset($user->avatar)}})"></div>
                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Изменить avatar">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="profile_avatar_remove" />
                                </label>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                            </div>
                            <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Имя</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="text"
                                   value="{{ $user->first_name }}" name="first_name"/>
                            @error('first_name')
                            <span class="form-text text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Фамилия</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="text"
                                   value="{{ $user->last_name }}" name="last_name" />
                            @error('last_name')
                            <span class="form-text text-danger">
                                {{ $message }}
                            </span>
                            @enderror

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Название компании</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="text"
                                   value="{{ $user->company->name ?? '' }}" name="company" disabled/>
                            <span class="form-text text-muted">
                            Если вы не хотите, чтобы ваши счета были адресованы компании. Оставьте поле пустым, чтобы использовать свое полное имя.
                        </span>
                            @error('company')
                            <span class="form-text text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-xl-3"></label>
                        <div class="col-lg-9 col-xl-6">
                            <h5 class="font-weight-bold mt-10 mb-6">Контактная информация</h5>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Контактный телефон</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="la la-phone"></i>
                                </span>
                                </div>
                                <input type="text" class="form-control form-control-lg form-control-solid"
                                       value="{{ $user->phone }}" placeholder="Phone" name="phone"/>
                                @error('phone')
                                <span class="form-text text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
{{--                            <span class="form-text text-muted">Мы никогда никому не передадим вашу электронную почту.</span>--}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Адрес электронной почты</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="la la-at"></i>
                                </span>
                                </div>
                                <input type="text" class="form-control form-control-lg form-control-solid"
                                       value="{{ $user->email }}" placeholder="Email" name="email" />
                                @error('email')
                                <span class="form-text text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Сайт компании</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <input type="text" class="form-control form-control-lg form-control-solid"
                                       placeholder="Username" value="{{ $user->company->site ?? '' }}" name="site_company" />
                                <div class="input-group-append">
                                    <span class="input-group-text">.com</span>
                                </div>
                                @error('site_company')
                                <span class="form-text text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Telegram</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <div class="input-group-append">
                                    <span class="input-group-text">@</span>
                                </div>
                                <input type="text" class="form-control form-control-lg form-control-solid"
                                       placeholder="Telegram" value="{{ $user->telegram ?? '' }}"
                                       name="telegram" />
                                @error('telegram')
                                <span class="form-text text-danger">
                                {{ $message }}
                            </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!--end::Body-->
            </form>
            <!--end::Form-->
        </div>
    <!--end::Content-->
@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/pages/custom/profile/profile.js') }}" type="text/javascript"></script>
@endsection
