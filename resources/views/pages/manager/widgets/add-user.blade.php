{{-- Extends layout --}}
@extends('pages.manager.dashboard')

{{-- Content --}}
@section('content-widget')
    <div class="card card-custom card-stretch gutter-b">
        <div class="row justify-content-center">
            <div class="col-xl-9">
                <form class="form" id="form-create-personal" enctype="multipart/form-data"
                      action="{{ route('profile_create') }}"
                      method="POST">
                @csrf
                <!--begin::Body-->
                    <div class="card-body">
                        <div class="row">
                            <label class="col-xl-3"></label>
                            <div class="col-lg-9 col-xl-6">
                                <h5 class="font-weight-bold mb-6">Информация о клиенте</h5>
                            </div>
                        </div>

{{--                        <div class="form-group row">--}}
{{--                            <label class="col-xl-3 col-lg-3 col-form-label">Аватар</label>--}}
{{--                            <div class="col-lg-9 col-xl-6">--}}
{{--                                <div class="image-input image-input-outline" id="kt_profile_avatar"--}}
{{--                                     style="background-image: url({{asset($user->avatar ?? '')}})">--}}
{{--                                    <div class="image-input-wrapper"--}}
{{--                                         style="background-image: url({{asset($user->avatar ?? '')}})"></div>--}}
{{--                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Изменить avatar">--}}
{{--                                        <i class="fa fa-pen icon-sm text-muted"></i>--}}
{{--                                        <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg" />--}}
{{--                                        <input type="hidden" name="profile_avatar_remove" />--}}
{{--                                    </label>--}}
{{--                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">--}}
{{--                                <i class="ki ki-bold-close icon-xs text-muted"></i>--}}
{{--                            </span>--}}
{{--                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">--}}
{{--                                <i class="ki ki-bold-close icon-xs text-muted"></i>--}}
{{--                            </span>--}}
{{--                                </div>--}}
{{--                                <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Имя</label>
                            <div class="col-lg-9 col-xl-6">
                                <input class="form-control form-control-lg form-control-solid" type="text"
                                       value="{{ $user->first_name ?? '' }}" name="first_name"/>
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
                                       value="{{ $user->last_name ?? '' }}" name="last_name" />
                                @error('last_name')
                                <span class="form-text text-danger">
                                {{ $message }}
                            </span>
                                @enderror

                            </div>
                        </div>
{{--                        <div class="form-group row">--}}
{{--                            <label class="col-xl-3 col-lg-3 col-form-label">Название компании</label>--}}
{{--                            <div class="col-lg-9 col-xl-6">--}}
{{--                                <input class="form-control form-control-lg form-control-solid" type="text"--}}
{{--                                       value="" name="company"/>--}}
{{--                                <span class="form-text text-muted">--}}
{{--                                    Если вы не хотите, чтобы ваши счета были адресованы компании. Оставьте поле пустым, чтобы использовать свое полное имя.--}}
{{--                                </span>--}}
{{--                                @error('company')--}}
{{--                                <span class="form-text text-danger">--}}
{{--                                    {{ $message }}--}}
{{--                                </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}
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
                                           value="{{ $user->phone ?? '' }}" placeholder="Phone" name="phone"/>
                                    @error('phone')
                                    <span class="form-text text-danger">
                                    {{ $message }}
                                </span>
                                    @enderror
                                </div>
                                <span class="form-text text-muted">Мы никогда никому не передадим вашу электронную почту.</span>
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
                                           value="{{ $user->email ?? '' }}" placeholder="Email" name="email" />
                                    @error('email')
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
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Пароль</label>
                            <div class="col-lg-9 col-xl-6">
                                <div class="input-group input-group-lg input-group-solid">
{{--                                    <div class="input-group-prepend">--}}
{{--                                        <span class="input-group-text">--}}
{{--                                            <i class="la la-at"></i>--}}
{{--                                        </span>--}}
{{--                                    </div>--}}
                                    <input type="password" class="form-control form-control-lg form-control-solid"
                                           value="" placeholder="Пароль" name="password" />
                                    @error('password')
                                    <span class="form-text text-danger">
                                    {{ $message }}
                                </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
{{--                        <div class="form-group row">--}}
{{--                            <label class="col-xl-3 col-lg-3 col-form-label">Сайт компании</label>--}}
{{--                            <div class="col-lg-9 col-xl-6">--}}
{{--                                <div class="input-group input-group-lg input-group-solid">--}}
{{--                                    <input type="text" class="form-control form-control-lg form-control-solid"--}}
{{--                                           placeholder="Username" value="{{ $user->company->site ?? '' }}" name="site_company" />--}}
{{--                                    <div class="input-group-append">--}}
{{--                                        <span class="input-group-text">.com</span>--}}
{{--                                    </div>--}}
{{--                                    @error('site_company')--}}
{{--                                    <span class="form-text text-danger">--}}
{{--                                    {{ $message }}--}}
{{--                                </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <button type="submit" form="form-create-personal" class="btn btn-success mr-2">Сохранить изменения</button>
                    </div>
                    <!--end::Body-->
                </form>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/pages/custom/profile/profile.js') }}" type="text/javascript"></script>
{{--    <script>--}}
{{--        $('.roleEvent').on('click', function () {--}}
{{--            let userId = $(this).attr("data-user-id");--}}
{{--            let roleId = $(this).attr("data-role-id");--}}
{{--            $.ajax({--}}
{{--                type:'post',--}}
{{--                url:'{{ route('role_update') }}',--}}
{{--                dataType: "json",--}}
{{--                data:{--}}
{{--                    '_token':$('meta[name="csrf-token"]').attr('content'),--}}
{{--                    'user_id': userId,--}}
{{--                    'role_id': roleId--}}
{{--                },--}}
{{--                success: function (data) {--}}
{{--                    console.log(data);--}}
{{--                    div = $('#user-role-id-'+ data.user_id);--}}
{{--                    div.html(data.role)--}}
{{--                    sendNotification()--}}
{{--                },--}}
{{--                error: function () {--}}
{{--                    sendNotification()--}}
{{--                }--}}
{{--            });--}}
{{--        })--}}
{{--    </script>--}}
@endsection
