<form class="form repeater" id="form-create-personal" enctype="multipart/form-data"
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
            @if(request()->user()->hasPermissionTo(\App\Interfaces\OptionsPermissions::OWNER['slug']))
                <label class="col-xl-3 col-lg-3 col-form-label">Аккаунты:</label>
                <div class="col-lg-9 col-xl-6" style="
                    padding-left: 0px;
                    padding-right: 0px;
                ">
                    <div class="mb-2">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                                <select class="form-control select2" id="kt_select2_3" multiple="multiple" name="bank_auth[]">
                                    @isset($company)
                                        @foreach($company->banks()->get() as $account)
                                            <option value="{{ $account->id }}" selected="selected">{{ $account->title }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                        </div>
                    </div>
                </div>
            @else
                @foreach($company->banks()->get() as $account)
                    <div class="col-xl-12 col-lg-12 d-flex align-items-center bg-diagonal-white rounded p-1 gutter-b">
                            <span class="svg-icon svg-icon-warning mr-5">
                                <span class="svg-icon svg-icon-lg">
                                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Home/Library.svg-->
                                    {{ \App\Classes\Theme\Metronic::getSVG( $account->bank->icon) }}
                                <!--end::Svg Icon-->
                                </span>
                            </span>
                        <div class="d-flex flex-column flex-grow-1 mr-2">
                                {{ $account->title }}

                                <span class="text-muted font-size-sm">{{ $account->bank->title }}</span>
                        </div>
                        <div class="d-flex flex-column flex-grow-1 mr-2">
                            {{ $account->getDateRefresh() }}

                                <span class="text-muted font-size-sm">Последнее обновление</span>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        @isset($company)
            <div class="row">
                <label class="col-xl-3"></label>
                <div class="col-lg-9 col-xl-6">
                    <h5 class="font-weight-bold mt-10 mb-6">Список счетов:</h5>
                </div>
            </div>
            <div class="form-group row">
            @foreach($company->invoices()->get() as $invoice)
                <div class="col-xl-12 col-lg-12 d-flex align-items-center bg-diagonal-white rounded gutter-b">
                    <span class="svg-icon svg-icon-warning mr-5">
                        <span class="svg-icon svg-icon-lg">
                            <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Home/Library.svg-->
                            {{ \App\Classes\Theme\Metronic::getSVG( $invoice->bank->icon) }}
                        <!--end::Svg Icon-->
                        </span>
                    </span>
                    <div class="d-flex flex-column flex-grow-1 mr-2">
                        <a href="{{ route('invoice.show', $invoice->account_id) }}"
                           class="font-weight-normal text-dark-75 text-hover-primary font-size-lg mb-1">
                            {{ $invoice->account_id }}
                        </a>

                        <span class="text-muted font-size-sm">{{ $invoice->bank->title }}</span>
                    </div>
                    <span class="font-weight-bolder py-1 font-size-lg">
                        {{ $invoice->currencySign }}{{ (int) $invoice->avail }}
                    </span>
                </div>
            @endforeach
        </div>
        @endisset

        <button type="submit" form="form-create-personal" class="btn btn-success mr-2">Сохранить изменения</button>
    </div>
</form>

@push('scripts')
{{--    @if(isset($company) and isset($company->bank->key))--}}
    @if(request()->user()->hasPermissionTo(\App\Interfaces\OptionsPermissions::OWNER['slug']))
        <script>
            $("#kt_select2_3").select2({
                placeholder: "Поиск аккаунтов банка",
                allowClear: true,
                ajax: {
                    url: "{{route('bank.account.list.ajax')}}",
                    method: 'POST',

                    dataType: 'json',
                    delay: 250,
                    data: function data(params) {
                        return {
                            q: params.term,
                            // search term
                            page: params.page,
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                        };
                    },
                    cache: true
                },
                escapeMarkup: function escapeMarkup(markup) {
                    return markup;
                },
            });
        </script>
    @endif
@endpush
