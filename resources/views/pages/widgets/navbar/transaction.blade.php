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
                        <div class="col-lg-10 col-md-10 col-sm-12">
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
        let div_summa_mask = $("#summa_mask").prop( "disabled", true);
        $('#selectpicker_invoices').select2({
            placeholder: "Select a state",
            allowClear: true,
            ajax: {
                url: "{{ asset('') }}datatables/account/{{ $account->id }}/companies/"+ select[0].value +"/invoices/select",
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
        })

        $('#selectpicker_invoices').on('select2:select', function (e) {
            currency = e.params.data.currency;
            div_summa_mask.inputmask(currency + ' 999.999.999,99',
                {
                    numericInput: true
                }
            );

            div_summa_mask.prop( "disabled", false );
    </script>
@endpush
