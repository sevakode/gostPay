

<div class="card-header flex-wrap border-0 pt-6 pb-0">
    <div class="card-title">
        <h3 class="card-label">Карты
            <div class="text-muted pt-2 font-size-sm"><?php echo e(\Illuminate\Support\Facades\Auth::user()->company->name); ?></div>
        </h3>
    </div>
</div>
<div class="card-body">
    <!--begin: Search Form-->
    <!--begin::Search Form-->
    <div class="mb-7">
        <div class="row align-items-center">
            <div class="col-lg-9 col-xl-8">
                <div class="row align-items-center">
                    <div class="col-md-4 my-2 my-md-0">
                        <div class="input-icon">
                            <input type="text" class="form-control" placeholder="Search..." id="add_cards_datatable_search_query"/>
                            <span><i class="flaticon2-search-1 text-muted"></i></span>
                        </div>
                    </div>
                    <div class="col-md-4 my-2 my-md-0">
                        <div class="d-flex align-items-center">
                            <label class="mr-3 mb-0 d-none d-md-block">Статус:</label>
                            <select class="form-control" id="add_cards_datatable_search_status">
                                <option value="">Все</option>
                                <option value="1">Активная</option>
                                <option value="0">Пассивный</option>
                            </select>
                        </div>
                    </div>
                    <?php if(isset($searchUser)): ?>
                        <div class="col-md-4 my-2 my-md-0">
                            <div class="d-flex align-items-center">
                                <label class="mr-3 mb-0 d-none d-md-block">Пользователь:</label>
                                <select class="form-control" id="add_cards_datatable_search_type">
                                    <option value="">All</option>
                                    <?php $__currentLoopData = \Illuminate\Support\Facades\Auth::user()->company->users()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($user->id); ?>"><?php echo e($user->fullname); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php if(\Illuminate\Support\Facades\Auth::user()->hasPermission(\App\Interfaces\OptionsPermissions::ACCESS_TO_REMOVE_CARDS['title'])): ?>
            <div class="col-lg-1 col-xl-2">
                <a href="#" id="remove-cards" class="btn btn-light-danger px-6 font-weight-bold">Отсоединить</a>
            </div>
            <?php endif; ?>
            <div class="col-lg-2 col-xl-1 mt-5 mt-lg-0">
                <a href="#" class="btn btn-light-primary px-6 font-weight-bold">Search</a>
            </div>
        </div>
    </div>
    <!--end::Search Form-->
    <!--end: Search Form-->
    <!--begin: Datatable-->
    <table class="datatable datatable-bordered datatable-head-custom" id="add_cards_datatable">
    </table>
    <!--end: Datatable-->
</div>

<script>
    window.addEventListener('load', function () {
        var datatable = $('#add_cards_datatable').KTDatatable({
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: '<?php echo e(route('datatables.user-cards')); ?>',
                        method: 'POST',
                        contentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        params: {
                            id: <?php echo e($user->id); ?>,
                        },
                        map: function map(raw) {
                            var dataSet = raw;
                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;
                            }

                            if (typeof slider !== 'undefined') {
                                if(raw.countCardsNoUser > 0){
                                    slider.noUiSlider.options.range.max = raw.countCardsNoUser;
                                    slider.noUiSlider.updateOptions.length = raw.countCardsNoUser;
                                    slider.noUiSlider.updateOptions('max', raw.countCardsNoUser);
                                }
                            }

                            return dataSet;
                        }
                    }
                },
                pageSize: 10,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true,
            },

            sortable: true,
            pagination: true,
            search: {
                input: $('#add_cards_datatable_search_query'),
                key: 'generalSearch'
            },

            columns: [
                {
                    field: 'id',
                    title: '№',
                    width: 20,
                    <?php if(\Illuminate\Support\Facades\Auth::user()->hasPermission(\App\Interfaces\OptionsPermissions::ACCESS_TO_REMOVE_CARDS['title'])): ?>
                    template: function template(row) {
                        return '<label class="checkbox">'+
                            '<input type="checkbox" value="'+row.id+'" name="checkboxes"/>'+
                            '<span></span>'+
                        '</label>'
                    }
                    <?php endif; ?>
                },
                {
                    field: 'number',
                    title: 'Номер карты',
                    template: function template(row) {
                        return '<a class="text-dark" href="'+ row.numberLink +'">'+ row.number +'</a>'
                    }
                },
                {
                    field: 'user',
                    title: 'Пользователь',
                    template: function template(row) {
                        if(row.user !== 'none') {
                            return '<a class="text-dark" href="'+ row.userLink +'">'+ row.user +'</a>'
                        }
                        else {
                            return row.user
                        }
                    }
                },
                {
                    field: 'type',
                    title: 'Тип карты',
                },
                {
                    field: 'state',
                    title: 'Статус',
                    template: function template(row) {
                        return row.state;
                    }
                },
                {
                    field: 'countPayments',
                    title: 'Количество платежей',
                },
                {
                    field: 'expiredAt',
                    title: 'Дата истечения срока',
                },
                {
                    field: 'amount',
                    title: 'Сумма платежей',
                },
            ],
        });
        $('#add_cards_datatable_search_status').on('change', function () {
            datatable.search($(this).val().toLowerCase(), 'state');
        });
        $('#add_cards_datatable_search_type').on('change', function () {
            datatable.search($(this).val().toLowerCase(), 'Type');
        });
        $('#add_cards_datatable_search_status, #add_cards_datatable_search_type').selectpicker();

        $('#adding_cards').on('click', function () {
            datatable.setDataSourceParam('query.removeCards', '')
            datatable.search(sliderInput.value, 'countCards');
        });
        $('#remove-cards').on('click', function () {
            var checkboxes_value = [];
            $('input[name="checkboxes"]').each(function(){
                //if($(this).is(":checked")) {
                if(this.checked) {
                    checkboxes_value.push($(this).val());
                }
            });
            checkboxes_value = checkboxes_value.toString();
            datatable.search(checkboxes_value, 'removeCards');
        });
    });


</script>



<?php /**PATH C:\Users\hd\PhpstormProjects\pay\resources\views/pages/manager/nav_panel_widgets/user-cards-table.blade.php ENDPATH**/ ?>