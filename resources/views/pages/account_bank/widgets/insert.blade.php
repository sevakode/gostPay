<form class="form repeater" id="form-create-personal" enctype="multipart/form-data"
      action="{{ $route }}"
      method="POST">
    @csrf
    <div class="card-body">
        <div class="row">
            <label class="col-xl-3"></label>
            <div class="col-lg-9 col-xl-6">
                <h5 class="font-weight-bold mb-6">Информация о аккаунте банка</h5>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xl-3 col-lg-3 col-form-label">Название</label>
            <div class="col-lg-9 col-xl-6">
                <div class="input-group-prepend input-group input-group-lg input-group-solid">
                    <input type="text" class="form-control form-control-lg form-control-solid"
                           value="{{ $account->title ?? '' }}" placeholder="название" name="title"/>
                    @error('title')
                    <span class="form-text text-danger">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xl-3 col-lg-3 col-form-label">Тип банка
                <span class="text-danger">*</span></label>
            <select class="form-control col-lg-9 col-xl-6" name="typeBank" required>
                @foreach(config('bank_list.info') as $bank)
                    <option value="{{ $bank['title'] }}"
                        @if(isset($account) and $account->url == $bank['url'])
                            selected
                        @endif>
                        {{ $bank['title'] }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group row">
            <label class="col-xl-3 col-lg-3 col-form-label">Ключ для интеграции</label>
            <div class="col-lg-9 col-xl-6 input-group">
                <input type="text" class="form-control form-control-lg" placeholder="Company key"
                       aria-describedby="basic-addon2"
                       value="{{ $account->key ?? '' }}"
                       name="key" id="copy-key">
                @if(isset($company) and isset($account->key))
                    <button onclick="clickFunction()" type="button" class="example-copy">
                        <i class="la la-copy"></i>
                    </button>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label class="col-xl-3 col-lg-3 col-form-label">Клиент ID</label>
            <div class="col-lg-9 col-xl-6">
                <div class="input-group-prepend input-group input-group-lg input-group-solid">
                    <input type="text" class="form-control form-control-lg form-control-solid"
                           value="{{ $account->bankId ?? '' }}" placeholder="Client ID" name="bankId"/>
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
                <div class="input-group-prepend input-group input-group-lg input-group-solid">
                    <input type="text" class="form-control form-control-lg form-control-solid"
                           value="{{ $account->bankSecret ?? '' }}" placeholder="Client Secret" name="bankSecret"/>
                    @error('bankSecret')
                        <span class="form-text text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-xl-3 col-lg-3 col-form-label">Access Токен</label>
            <div class="col-lg-9 col-xl-6">
                <div class="input-group-prepend input-group input-group-lg input-group-solid">
                    <input type="text" class="form-control form-control-lg form-control-solid"
                           value="{{ $account->accessToken ?? '' }}" placeholder="Access Token" name="accessToken"/>
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
                <div class="input-group-prepend input-group input-group-lg input-group-solid">
                    <input type="text" class="form-control form-control-lg form-control-solid"
                           value="{{ $account->refreshToken ?? '' }}" placeholder="Refresh Token" name="refreshToken"/>
                    @error('phone')
                        <span class="form-text text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
        </div>

        <button type="submit" form="form-create-personal" class="btn btn-success mr-2">Сохранить изменения</button>
    </div>
</form>

@push('scripts')
    @if(isset($company) and isset($account->key))
        <script>
            function clickFunction() {
                /* Get the text field */
                var copyText = document.getElementById("copy-key");

                /* Select the text field */
                // copyText.select();

                let link = "{{ route('api.tauth', $account->key) }}" + copyText.value;

                var tmp = $("<input>");
                $("body").append(tmp);
                tmp.val(link).select();
                document.execCommand("copy");
                tmp.remove();
            }
        </script>
    @endif
@endpush
