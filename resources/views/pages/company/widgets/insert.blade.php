<form class="form" id="form-create-personal" enctype="multipart/form-data"
      action="{{ $route }}"
      method="POST">
    @csrf
    <div class="card-body">
        <div class="row">
            <label class="col-xl-3"></label>
            <div class="col-lg-9 col-xl-6">
                <h5 class="font-weight-bold mb-6">Информация о компании</h5>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xl-3 col-lg-3 col-form-label">Аватар</label>
            <div class="col-lg-9 col-xl-6">
                <div class="image-input image-input-outline" id="kt_profile_avatar"
                     style="background-image: url( {{ isset($company) ? asset( $company->avatar) : '' }} )">
                    <div class="image-input-wrapper"
                         style="background-image: url( {{  isset($company) ? asset( $company->avatar) : '' }} )"></div>
                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                           data-action="change" data-toggle="tooltip" title="" data-original-title="Изменить avatar">
                        <i class="fa fa-pen icon-sm text-muted"></i>
                        <input type="file" name="company_avatar" accept=".png, .jpg, .jpeg"/>
                        <input type="hidden" name="company_avatar_remove"/>
                    </label>
                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                          data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                    </span>
                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                          data-action="remove" data-toggle="tooltip" title="Remove avatar">
                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                    </span>
                </div>
                <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-xl-3 col-lg-3 col-form-label">Название</label>
            <div class="col-lg-9 col-xl-6">
                <input class="form-control form-control-lg form-control-solid" type="text"
                       value="{{ $company->name ?? '' }}" name="name"/>
                @error('name')
                    <span class="form-text text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>

        <div class="row">
            <label class="col-xl-3"></label>
            <div class="col-lg-9 col-xl-6">
                <h5 class="font-weight-bold mt-10 mb-6">Интеграция с банком</h5>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-xl-3 col-lg-3 col-form-label">Тип банка
                <span class="text-danger">*</span></label>
            <select class="form-control col-lg-9 col-xl-6" name="typeBank" required>
                <option value="tochkabank">Tochka Bank</option>
            </select>
        </div>

        <div class="form-group row">
            <label class="col-xl-3 col-lg-3 col-form-label">Ключ для интеграции</label>
            <div class="col-lg-9 col-xl-6 input-group">
                <input type="text" class="form-control form-control-lg" placeholder="Small size"
                       aria-describedby="basic-addon2"
                       value="{{ $company->bank->key ?? '' }}"
                       name="key" id="copy-key">
                @isset($company)

                    <button onclick="clickFunction()" type="button" class="example-copy">
                        <i class="la la-copy"></i>
                    </button>
                @endisset
            </div>
        </div>

        <div class="form-group row">
            <label class="col-xl-3 col-lg-3 col-form-label">Клиент ID</label>
            <div class="col-lg-9 col-xl-6">
                <div class="input-group input-group-lg input-group-solid">
                    <div class="input-group-prepend">
                    </div>
                    <input type="text" class="form-control form-control-lg form-control-solid"
                           value="{{ $company->bank->bankId ?? '' }}" placeholder="Client ID" name="bankId"/>
                    @error('phone')
                    <span class="form-text text-danger">
                    {{ $message }}
                </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-xl-3 col-lg-3 col-form-label">Секретный ключ</label>
            <div class="col-lg-9 col-xl-6">
                <div class="input-group input-group-lg input-group-solid">
                    <div class="input-group-prepend">
                    </div>
                    <input type="text" class="form-control form-control-lg form-control-solid"
                           value="{{ $company->bank->bankSecret ?? '' }}" placeholder="Client Secret" name="bankSecret"/>
                    @error('phone')
                    <span class="form-text text-danger">
                    {{ $message }}
                </span>
                    @enderror
                </div>
{{--                                <span class="form-text text-muted">Мы никогда никому не передадим вашу электронную почту.</span>--}}
            </div>
        </div>

        <div class="form-group row">
            <label class="col-xl-3 col-lg-3 col-form-label">Access Токен</label>
            <div class="col-lg-9 col-xl-6">
                <div class="input-group input-group-lg input-group-solid">
                    <div class="input-group-prepend">
                    </div>
                    <input type="text" class="form-control form-control-lg form-control-solid"
                           value="{{ $company->bank->accessToken ?? '' }}" placeholder="Access Token" name="accessToken"/>
                    @error('phone')
                    <span class="form-text text-danger">
                    {{ $message }}
                </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xl-3 col-lg-3 col-form-label">Refresh Токен</label>
            <div class="col-lg-9 col-xl-6">
                <div class="input-group input-group-lg input-group-solid">
                    <div class="input-group-prepend">
                    </div>
                    <input type="text" class="form-control form-control-lg form-control-solid"
                           value="{{ $company->bank->refreshToken ?? '' }}" placeholder="Refresh Token" name="refreshToken"/>
                    @error('phone')
                    <span class="form-text text-danger">
                    {{ $message }}
                </span>
                    @enderror
                </div>
{{--                                <span class="form-text text-muted">Мы никогда никому не передадим вашу электронную почту.</span>--}}
            </div>
        </div>
{{--                        <div class="form-group row">--}}
{{--                            <label class="col-xl-3 col-lg-3 col-form-label">Адрес электронной почты</label>--}}
{{--                            <div class="col-lg-9 col-xl-6">--}}
{{--                                <div class="input-group input-group-lg input-group-solid">--}}
{{--                                    <div class="input-group-prepend">--}}
{{--                                <span class="input-group-text">--}}
{{--                                    <i class="la la-at"></i>--}}
{{--                                </span>--}}
{{--                                    </div>--}}
{{--                                    <input type="text" class="form-control form-control-lg form-control-solid"--}}
{{--                                           value="{{ $company->email ?? '' }}" placeholder="Email" name="email" />--}}
{{--                                    @error('email')--}}
{{--                                    <span class="form-text text-danger">--}}
{{--                                    {{ $message }}--}}
{{--                                </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group row">--}}
{{--                            <label class="col-xl-3 col-lg-3 col-form-label">Telegram</label>--}}
{{--                            <div class="col-lg-9 col-xl-6">--}}
{{--                                <div class="input-group input-group-lg input-group-solid">--}}
{{--                                    <div class="input-group-append">--}}
{{--                                        <span class="input-group-text">@</span>--}}
{{--                                    </div>--}}
{{--                                    <input type="text" class="form-control form-control-lg form-control-solid"--}}
{{--                                           placeholder="Telegram" value="{{ $company->telegram ?? '' }}"--}}
{{--                                           name="telegram" />--}}
{{--                                    @error('telegram')--}}
{{--                                    <span class="form-text text-danger">--}}
{{--                                {{ $message }}--}}
{{--                            </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group row">--}}
{{--                            <label class="col-xl-3 col-lg-3 col-form-label">Пароль</label>--}}
{{--                            <div class="col-lg-9 col-xl-6">--}}
{{--                                <div class="input-group input-group-lg input-group-solid">--}}
{{--                                    <input type="password" class="form-control form-control-lg form-control-solid"--}}
{{--                                           value="" placeholder="Пароль" name="password" />--}}
{{--                                    @error('password')--}}
{{--                                    <span class="form-text text-danger">--}}
{{--                                    {{ $message }}--}}
{{--                                </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

        <button type="submit" form="form-create-personal" class="btn btn-success mr-2">Сохранить изменения</button>
    </div>
</form>

<script>
    function clickFunction() {
        /* Get the text field */
        var copyText = document.getElementById("copy-key");

        /* Select the text field */
        // copyText.select();

        let link = "{{ route('api.tauth', $company->bank->key) }}" + copyText.value;
        console.log(link);

        var $tmp = $("<input>");
        $("body").append($tmp);
        $tmp.val(link).select();
        document.execCommand("copy");
        $tmp.remove();
    }
</script>
