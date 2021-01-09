<?php $__env->startSection('content-widget'); ?>






<?php echo $__env->make('pages.manager.nav_panel_widgets.header-cards', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="card card-custom">
    <?php echo $__env->make('pages.manager.nav_panel_widgets.cards-table', ['cards'=>$cards, 'searchUser' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('js/pages/crud/ktdatatable/base/html-table.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('pages.manager.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hd\PhpstormProjects\pay\resources\views/pages/manager/widgets/cards.blade.php ENDPATH**/ ?>