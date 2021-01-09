<!--begin::Nav-->

<div class="navi navi-bold navi-hover navi-active navi-link-rounded">
<?php if(!\Illuminate\Support\Facades\Request::fullUrlIs(route('user_cards', $user->id))): ?>
        
    <div class="navi-item mb-2">
        <a href="<?php echo e(route('profile_show')); ?>" class="navi-link py-4 active">
                <span class="navi-icon mr-2">
                    <span class="svg-icon">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24" />
                                <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                </span>
            <span class="navi-text font-size-lg">Личные данные</span>
        </a>
    </div>
<?php endif; ?>

<div class="navi-item mb-2">
    <a href="<?php echo e(route('user_cards', $user->id)); ?>" class="navi-link py-4">
        <span class="navi-icon mr-2">
            <span class="svg-icon">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
                <span class="svg-icon">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-top-panel-6.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24" />
                            <rect fill="#000000" x="2" y="5" width="19" height="4" rx="1" />
                            <rect fill="#000000" opacity="0.3" x="2" y="11" width="19" height="10" rx="1" />
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>
                <!--end::Svg Icon-->
            </span>
        </span>
        <span class="navi-text font-size-lg">Карты</span>
    </a>
</div>






























































    <div class="navi-item mb-2">
        <a href="#" class="navi-link py-4" data-toggle="tooltip" title="Coming soon..." data-placement="right">
            <span class="navi-icon mr-2">
                <span class="svg-icon">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-top-panel-6.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24" />
                            <rect fill="#000000" x="2" y="5" width="19" height="4" rx="1" />
                            <rect fill="#000000" opacity="0.3" x="2" y="11" width="19" height="10" rx="1" />
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>
            </span>
            <span class="navi-text font-size-lg">Saved Credit Cards</span>
        </a>
    </div>










































</div>
<!--end::Nav-->
<?php /**PATH C:\Users\hd\PhpstormProjects\pay\resources\views/pages/profile/navbar/show.blade.php ENDPATH**/ ?>