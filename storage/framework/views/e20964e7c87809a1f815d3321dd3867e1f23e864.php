




<?php $__env->startSection('content'); ?>

    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Notice-->
            <!--begin: Row-->
            <div class="row">
                <div class="col-lg-8">
                    <?php echo $__env->make('modules.features.miscellaneous.dual_listbox.default', ['adsasd', 'adas'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
            <!--end: Row-->
            <!--begin: Row-->
        </div>
        <!--end::Container-->
    </div>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
    
    <script src="<?php echo e(asset('js/pages/widgets.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('js/pages/custom/profile/profile.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hd\PhpstormProjects\pay\resources\views/pages/manager/dev.blade.php ENDPATH**/ ?>