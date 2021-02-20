<div class="card card-custom card-stretch gutter-b">
    <div class="row justify-content-center">
        <div class="col-xl-9">
            <form class="form" id="form-create-personal" enctype="multipart/form-data"
                  action="{{ $route  }}"
                  method="POST">
            @csrf
            <!--begin::Body-->
                <div class="card-body">
                    <div class="row">
                        <label class="col-xl-3"></label>
                        <div class="col-lg-9 col-xl-6">
                            <h5 class="font-weight-bold mb-6">Информация о проекте</h5>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Название</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="text"
                                   value="{{ $project->name ?? '' }}" name="name"/>
                            @error('first_name')
                            <span class="form-text text-danger">
                            {{ $message }}
                        </span>
                            @enderror
                        </div>
                    </div>
{{--                    <div class="row">--}}
{{--                        <label class="col-xl-3"></label>--}}
{{--                        <div class="col-lg-9 col-xl-6">--}}
{{--                            <h5 class="font-weight-bold mt-10 mb-6">Контактная информация</h5>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group row">--}}
{{--                        <label class="col-xl-3 col-lg-3 col-form-label">Контактный телефон</label>--}}
{{--                        <div class="col-lg-9 col-xl-6">--}}
{{--                            <div class="input-group input-group-lg input-group-solid">--}}
{{--                                <div class="input-group-prepend">--}}
{{--                            <span class="input-group-text">--}}
{{--                                <i class="la la-phone"></i>--}}
{{--                            </span>--}}
{{--                                </div>--}}
{{--                                <input type="text" class="form-control form-control-lg form-control-solid"--}}
{{--                                       value="{{ $user->phone ?? '' }}" placeholder="Phone" name="phone"/>--}}
{{--                                @error('phone')--}}
{{--                                <span class="form-text text-danger">--}}
{{--                                {{ $message }}--}}
{{--                            </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                            --}}{{--                                <span class="form-text text-muted">Мы никогда никому не передадим вашу электронную почту.</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group row">--}}
{{--                        <label class="col-xl-3 col-lg-3 col-form-label">Адрес электронной почты</label>--}}
{{--                        <div class="col-lg-9 col-xl-6">--}}
{{--                            <div class="input-group input-group-lg input-group-solid">--}}
{{--                                <div class="input-group-prepend">--}}
{{--                            <span class="input-group-text">--}}
{{--                                <i class="la la-at"></i>--}}
{{--                            </span>--}}
{{--                                </div>--}}
{{--                                <input type="text" class="form-control form-control-lg form-control-solid"--}}
{{--                                       value="{{ $user->email ?? '' }}" placeholder="Email" name="email" />--}}
{{--                                @error('email')--}}
{{--                                <span class="form-text text-danger">--}}
{{--                                {{ $message }}--}}
{{--                            </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group row">--}}
{{--                        <label class="col-xl-3 col-lg-3 col-form-label">Telegram</label>--}}
{{--                        <div class="col-lg-9 col-xl-6">--}}
{{--                            <div class="input-group input-group-lg input-group-solid">--}}
{{--                                <div class="input-group-append">--}}
{{--                                    <span class="input-group-text">@</span>--}}
{{--                                </div>--}}
{{--                                <input type="text" class="form-control form-control-lg form-control-solid"--}}
{{--                                       placeholder="Telegram" value="{{ $user->telegram ?? '' }}"--}}
{{--                                       name="telegram" />--}}
{{--                                @error('telegram')--}}
{{--                                <span class="form-text text-danger">--}}
{{--                            {{ $message }}--}}
{{--                        </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group row">--}}
{{--                        <label class="col-xl-3 col-lg-3 col-form-label">Пароль</label>--}}
{{--                        <div class="col-lg-9 col-xl-6">--}}
{{--                            <div class="input-group input-group-lg input-group-solid">--}}
{{--                                <input type="password" class="form-control form-control-lg form-control-solid"--}}
{{--                                       value="" placeholder="Пароль" name="password" />--}}
{{--                                @error('password')--}}
{{--                                <span class="form-text text-danger">--}}
{{--                                {{ $message }}--}}
{{--                            </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <button type="submit" form="form-create-personal" class="btn btn-success mr-2">Сохранить изменения</button>
                </div>
                <!--end::Body-->
            </form>
        </div>

    </div>
