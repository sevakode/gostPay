





<?php $__env->startSection('content'); ?>
    <div class="d-flex flex-row">
        <div class="flex-md-row-auto w-md-275px w-xl-325px">
            <!--begin::Nav Panel Widget 3-->
            <?php echo $__env->make('pages.manager.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--end::Nav Panel Widget 3-->
        </div>

        <div class="col-xl-9">
            <!--begin::Base Table Widget 1-->
            <?php echo $__env->yieldContent('content-widget'); ?>
            <!--end::Base Table Widget 1-->
        </div>

    </div>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('js/pages/custom/education/school/students.js?')); ?>"></script>
    <script src="<?php echo e(asset('js/pages/widgets.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('js/pages/custom/profile/profile.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hd\PhpstormProjects\pay\resources\views/pages/manager/dashboard.blade.php ENDPATH**/ ?>