
<form class="form repeater" id="form-create-personal" enctype="multipart/form-data"
      action="{{ $route }}"
      method="POST">
    @csrf
    <div class="card-body">
        @foreach(request()->user()->company->banks()->get() as $bank)
            <div class="row">
                <label class="col-xl-3"></label>
                <div class="col-lg-9 col-xl-6">
                    <h5 class="font-weight-bold mb-6">Добавление счета: {{ $bank->title }}</h5>
                </div>
            </div>
            <div id="kt_repeater_2" class="kt_repeater_2">
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Номер счёта:</label>
                    <div data-repeater-list="account_id[{{ $bank->id }}]" class="col-lg-9 col-xl-6" style="
                    padding-left: 0px;
                    padding-right: 0px;
                ">
                        @if(isset($company) and $bank->companyInvoices()->exists())
                            @foreach($bank->companyInvoices()->get() as $invoice)
                                <div data-repeater-item class="mb-2">
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                               placeholder="Account ID" name="account_id" value="{{ $invoice->account_id }}"/>
                                        <div class="input-group-append">
                                            <a href="javascript:;" data-repeater-delete="" class="btn font-weight-bold btn-danger btn-icon">
                                                <i class="la la-close"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        @else
                            <div data-repeater-item class="mb-2">
                                <div class="input-group">
                                    <input type="text" class="form-control"
                                           placeholder="Account ID" name="account_id"/>
                                    <div class="input-group-append">
                                        <a href="javascript:;" data-repeater-delete="" class="btn font-weight-bold btn-danger btn-icon">
                                            <i class="la la-close"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"></label>
                    <div class="col-lg-4">
                        <a href="javascript:;" data-repeater-create="" class="btn btn-sm font-weight-bolder btn-light-primary">
                            <i class="la la-plus"></i>Добавить счет
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

        <button type="submit" form="form-create-personal" class="btn btn-success mr-2">Сохранить изменения</button>
    </div>
</form>
@push('scripts_push')

@endpush
{{--@push('scripts')--}}
{{--    @if(isset($company) and isset($company->banks()->first()->key))--}}
{{--        <script>--}}
{{--            function clickFunction() {--}}
{{--                /* Get the text field */--}}
{{--                var copyText = document.getElementById("copy-key");--}}

{{--                /* Select the text field */--}}
{{--                // copyText.select();--}}

{{--                let link = "{{ route('api.tauth', $company->banks()->first()->key) }}" + copyText.value;--}}

{{--                var tmp = $("<input>");--}}
{{--                $("body").append(tmp);--}}
{{--                tmp.val(link).select();--}}
{{--                document.execCommand("copy");--}}
{{--                tmp.remove();--}}
{{--            }--}}
{{--        </script>--}}
{{--    @endif--}}
{{--@endpush--}}
