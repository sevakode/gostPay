<div class="d-flex align-items-center pb-9">
    <!--begin::Symbol-->
    <div class="symbol symbol-45 symbol-light mr-4">
        <span class="symbol-label">
            <span class="svg-icon svg-icon-2x svg-icon-dark-50">
                <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Media/Equalizer.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                        <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                        <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                    </g>
                </svg>
                <!--end::Svg Icon-->
            </span>
        </span>
    </div>
    <!--end::Symbol-->
    <!--begin::Text-->
    <div class="d-flex flex-column flex-grow-1">
        <a href="<?php echo e(url(\App\Providers\RouteServiceProvider::MANAGER)); ?>" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">
            Персонал
        </a>
        <span class="text-muted font-weight-bold">Права и пользователи</span>
    </div>
    <!--end::Text-->
    <!--begin::label-->
    <span class="font-weight-bolder label label-xl label-light-success label-inline px-3 py-5 min-w-45px"><?php echo e(Auth::user()->companyUsers()->count()); ?></span>
    <!--end::label-->
</div>
<?php /**PATH C:\Users\hd\PhpstormProjects\pay\resources\views/pages/manager/nav_panel_widgets/staff.blade.php ENDPATH**/ ?>