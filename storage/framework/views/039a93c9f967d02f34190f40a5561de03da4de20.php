




<?php $__env->startSection('navbar'); ?>
    <?php echo $__env->make('pages.profile.navbar.show', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('asides_end'); ?>
        <?php echo $__env->make('pages.manager.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content_profile'); ?>
    <div class="flex-row-fluid ml-lg-8">
        <div class="card card-custom gutter-b">
            <?php echo $__env->make('pages.manager.nav_panel_widgets.user-cards-table',  compact('user'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <div class="form-group row mb-6">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Добавить конкретные карты</label>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <select class="form-control select2" id="kt_select2_3" name="param" multiple="multiple"></select>
                    </div>
                    <div class="row">
                        <div class="col-lg-9 ml-lg-auto">
                            <button type="reset" id="adding_cards" class="btn btn-primary mr-2">Добавить</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <div class="form-group row mb-6">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Свободные карты</label>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="row align-items-center">
                            <div class="col-4">
                                <input type="text" class="form-control" id="kt_nouislider_1_input"  placeholder="Quantity"/>
                            </div>
                            <div class="col-8">
                                <div id="kt_nouislider_1" class="nouislider-drag-danger"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-9 ml-lg-auto">
                            <button type="reset" id="adding_random_cards" class="btn btn-primary mr-2">Добавить</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <?php if(\Illuminate\Support\Facades\Auth::user()->hasPermission(\App\Interfaces\OptionsPermissions::ACCESS_TO_ADD_CARDS['title'])): ?>
    <script>
        var slider = document.getElementById('kt_nouislider_1');

        noUiSlider.create(slider, {
            start: [ 0 ],
            step: 1,
            range: {
                'min': [ 0 ],
                'max': [ <?php echo e(\Illuminate\Support\Facades\Auth::user()->company->cards()->where('user_id', null)->count()); ?> ]
            },
            format: wNumb({
                decimals: 0
            })
        });

        // init slider input
        var sliderInput = document.getElementById('kt_nouislider_1_input');

        slider.noUiSlider.on('update', function( values, handle ) {
            sliderInput.value = values[handle];
        });

        sliderInput.addEventListener('change', function(){
            slider.noUiSlider.set(this.value);
        });
    </script>
    <script>
        // $('#kt_select2_3').select2({
        //     placeholder: "Select a state",
        // });
        $("#kt_select2_3").select2({
        placeholder: "Поиск свободных карт",
        allowClear: true,
        ajax: {
            url: "<?php echo e(route('datatables.select-add-cards')); ?>",
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
          processResults: function processResults(data, params) {
            // parse the results into the format expected by Select2
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data, except to indicate that infinite
            // scrolling can be used
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
        // let our custom formatter work
        minimumInputLength: 0,
        // templateResult: formatRepo,
        // omitted for brevity, see the source of this page
        // templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });
    </script>
    <?php endif; ?>
    <script src="<?php echo e(asset('js/pages/widgets.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('js/pages/custom/profile/profile.js')); ?>" type="text/javascript"></script>

    <?php echo $__env->yieldContent('scripts_next'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('pages.profile.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hd\PhpstormProjects\pay\resources\views/pages/manager/widgets/user.blade.php ENDPATH**/ ?>