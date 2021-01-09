<!--begin::Aside-->
<div class="flex-row-auto offcanvas-mobile w-250px w-xxl-350px" id="kt_profile_aside">
    <!--begin::Profile Card-->
    <div class="card card-custom card-stretch">
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
                    <div class="mt-2">
                        <a href="#" class="btn btn-sm btn-primary font-weight-bold mr-2 py-2 px-3 px-xxl-5 my-1">Чат</a>
                        <a href="#" class="btn btn-sm btn-success font-weight-bold py-2 px-3 px-xxl-5 my-1">Follow</a>
                    </div>
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

                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="font-weight-bold mr-2">Телефон:</span>
                        <span class="text-muted"><?php echo e($user->phone ?? '+7 (777) 777 77-77'); ?></span>
                    </div>

                <?php if(isset($user->location)): ?>
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="font-weight-bold mr-2">Location:</span>
                        <span class="text-muted"><?php echo e($user->location); ?></span>
                    </div>
                <?php endif; ?>
            </div>
            <!--end::Contact-->
            <?php echo $__env->make('pages.profile.personal.aside.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <!--end::Body-->
    </div>
    <!--end::Profile Card-->
</div>
<!--end::Aside-->
<?php /**PATH C:\Users\hd\PhpstormProjects\pay\resources\views/pages/profile/personal/aside.blade.php ENDPATH**/ ?>