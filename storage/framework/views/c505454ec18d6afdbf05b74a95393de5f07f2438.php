



<?php $__env->startSection('content'); ?>

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Profile Personal Information-->
                <div class="d-flex flex-row">
                    <!--begin::Aside-->
                    <div class="flex-row-auto offcanvas-mobile w-300px w-xl-350px" id="kt_profile_aside">
                        <?php echo $__env->yieldContent('asides_start'); ?>

                        <!--begin::Profile Card-->
                        <div class="card card-custom gutter-b">
                            <!--begin::Body-->
                            <div class="card-body pt-4">
                                <!--begin::Toolbar-->
                            <!--end::Toolbar-->
                                <!--begin::User-->
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                                        <div class="symbol-label" style="background-image:url('<?php echo e(asset($user->avatar)); ?>')"></div>
                                        <i class="symbol-badge bg-success"></i>
                                    </div>
                                    <div>
                                        <a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary"><?php echo e($user->fullname); ?></a>
                                        <div class="text-muted"><?php echo e($user->role->name); ?></div>




                                    </div>
                                </div>
                                <!--end::User-->
                                <!--begin::Contact-->
                                <div class="py-9">
                                    <?php if(isset($user->email)): ?>
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <span class="font-weight-bold mr-2">Email:</span>
                                            <a href="#" class="text-muted text-hover-primary"><?php echo e($user->email); ?></a>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(isset($user->phone)): ?>
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="font-weight-bold mr-2">Телефон:</span>
                                        <span class="text-muted"><?php echo e($user->phone); ?></span>
                                    </div>
                                    <?php endif; ?>

                                    <?php if(isset($user->telegram)): ?>
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <span class="font-weight-bold mr-2">telegram:</span>
                                            <a href="<?php echo e($user->telegramLink); ?>" class="text-muted text-hover-primary">
                                                <?php echo e($user->telegram); ?>

                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(isset($user->location)): ?>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="font-weight-bold mr-2">Location:</span>
                                            <span class="text-muted"><?php echo e($user->location); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <!--end::Contact-->
                                <?php echo $__env->yieldContent('navbar'); ?>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Profile Card-->


                        <?php echo $__env->yieldContent('asides_end'); ?>

                    </div>
                    <!--end::Aside-->


                    <?php echo $__env->yieldContent('content_profile'); ?>
                </div>
                <!--end::Profile Personal Information-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('js/pages/widgets.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('js/pages/custom/profile/profile.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hd\PhpstormProjects\pay\resources\views/pages/profile/default.blade.php ENDPATH**/ ?>