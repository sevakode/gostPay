<div class="card card-custom gutter-b">
    <!--begin::Body-->
    <div class="card-body">
        <!--begin::Wrapper-->
        <div class="d-flex justify-content-between flex-column h-100">
            <!--begin::Container-->
            <div class="h-100">
                <!--begin::Header-->
                <?php echo $__env->make('pages.company.navbar.my-company-preview',[
                        'company' => \Illuminate\Support\Facades\Auth::user()->company ?? null
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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