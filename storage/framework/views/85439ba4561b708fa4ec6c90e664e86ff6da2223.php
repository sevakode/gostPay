





































	<!--end::Head-->
	<!--begin::Body-->





<?php $__env->startSection('content'); ?>
<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Error-->
    <div class="d-flex flex-row-fluid flex-column bgi-size-cover bgi-position-center bgi-no-repeat p-10 p-sm-30"
         style="background-image: url(<?php echo e(asset('media/error/bg1.jpg')); ?>);">
        <!--begin::Content-->
        <h1 class="font-weight-boldest text-dark-75 mt-15" style="font-size: 10rem"><?php echo e($code); ?></h1>
        <p class="font-size-h3 text-muted font-weight-normal"><?php echo e($message); ?></p>
        <!--end::Content-->
    </div>
    <!--end::Error-->
</div>
<!--end::Main-->
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('js/pages/widgets.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>









		<!--end::Global Theme Bundle-->




<?php echo $__env->make('pages.errors.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hd\PhpstormProjects\pay\resources\views/pages/errors/error-1.blade.php ENDPATH**/ ?>