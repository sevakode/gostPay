<div class="card card-custom gutter-b">
    <!--begin::Body-->
    <div class="card-body">
        <!--begin::Wrapper-->
        <div class="d-flex justify-content-between flex-column h-100">
            <!--begin::Container-->
            <div class="h-100">
                <!--begin::Header-->
                <div class="d-flex flex-column flex-center">
                    <!--begin::Image-->
                    <div class="bgi-no-repeat bgi-size-cover rounded min-h-180px w-100"
                         style="background-image: url(<?php echo e(asset('media/stock-600x400/img-70.jpg')); ?>)"></div>
                    <!--end::Image-->
                    <!--begin::Title-->
                    <a href="#" class="card-title font-weight-bolder text-dark-75 text-hover-primary font-size-h4 m-0 pt-7 pb-1">
                        <?php echo e(\Illuminate\Support\Facades\Auth::user()->company->name); ?>

                    </a>
                    <!--end::Title-->
                    <!--begin::Text-->
                    <div class="font-weight-bold text-dark-50 font-size-sm pb-7">CV38+2J Palo Alto</div>
                    <!--end::Text-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="pt-1">
                    <!--begin::Item-->
                <?php echo $__env->make('pages.manager.nav_panel_widgets.staff', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!--end::Item-->
                    <!--begin::Item-->
                <?php echo $__env->make('pages.manager.nav_panel_widgets.e-commerce', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!--end::Item-->
                    <!--begin::Item-->

                    <!--end::Item-->
                    <!--begin::Item-->
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                <!--end::Item-->
                </div>
                <!--end::Body-->
            </div>
            <!--eng::Container-->
            <!--begin::Footer-->
        
        
        
        <!--end::Footer-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Body-->
</div>
<?php /**PATH C:\Users\hd\PhpstormProjects\pay\resources\views/pages/manager/navbar.blade.php ENDPATH**/ ?>