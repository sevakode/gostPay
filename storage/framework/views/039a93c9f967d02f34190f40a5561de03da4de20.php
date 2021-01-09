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
                            <button type="reset" id="adding_cards" class="btn btn-primary mr-2">Добавить</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
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
    <script src="<?php echo e(asset('js/pages/widgets.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('js/pages/custom/profile/profile.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('pages.profile.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hd\PhpstormProjects\pay\resources\views/pages/manager/widgets/user.blade.php ENDPATH**/ ?>