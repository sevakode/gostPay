<!--begin::Nav-->
<div class="card card-custom gutter-b">
    <!--begin::Body-->
    <div class="card-body">
        <!--begin::Wrapper-->
        <div class="d-flex justify-content-between flex-column h-100">
            <!--begin::Container-->
            <div class="h-100">
                <div class="d-flex flex-column flex-center">
                    <h5 class="modal-title" id="exampleModalLabel">Пополнить баланс</h5>
                </div>
                <div class="symbol symbol-45 symbol-light mr-4">
                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-3 col-sm-12">Счет</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <select class="form-control select2" id="selectpicker_invoices" name="param" ></select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-3 col-sm-12">Сумма</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <input class="form-control" id="summa_mask" type="text"/>
                            <span class="form-text text-muted">Тип оплаты <code>€ ___.__1.234,56</code></span>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column flex-grow-1">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="reset" data-dismiss="modal" id="pay_company" class="btn btn-primary mr-2">Добавить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts_push')
    <script>
        let div_summa_mask = $("#summa_mask");
        div_summa_mask.prop( "disabled", true);
        $('#selectpicker_invoices').select2({
            placeholder: "Select a state",
            allowClear: true,
            ajax: {
                url: "{{ route('datatables.accounts.list', $user->id) }}",
                method: 'GET',
                dataType: 'json',
                delay: 250,
                data: function data(params) {
                    return {
                        q: params.term,
                        page: params.page,
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                    };
                },
                processResults: function processResults(data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: params.page * 30 < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function escapeMarkup(markup) {
                return markup;
            },
            minimumInputLength: 0,
        });
        $('#selectpicker_invoices').on('select2:clear', function (e) {
            div_summa_mask.prop( 'disabled', true);
            div_summa_mask.attr( 'placeholder', '');
            div_summa_mask.inputmask('');

        });
        $('#selectpicker_invoices').on('select2:select', function (e) {
            let currency = e.params.data.currency;
            let strBalance = e.params.data.balance + '';

            let balance = '';
            let cursor = 1;
            for (let word=strBalance.length-1; word >= 0; word--) {
                if (cursor === 3) {
                    balance = '.' + strBalance[word] + balance;
                    cursor = 1;
                }
                balance = strBalance[word] + balance;
                cursor = cursor + 1;
            }


            balance = '999.999.999.999.999';
            cursor = 1;
            let result = '';
            for (let word=0; word <= balance.length-1; word++) {
                if (cursor >= (balance.length - 1) - (strBalance.length - 1)) {
                    result = '' + result + balance[word];
                }
                result = "" + result;
                cursor = cursor + 1;
            }


            div_summa_mask.inputmask(currency + ' ' + result + ',99' ,
                {
                    numericInput: true
                }
            );

            div_summa_mask.prop( "disabled", false );
        });
    </script>
@endpush
