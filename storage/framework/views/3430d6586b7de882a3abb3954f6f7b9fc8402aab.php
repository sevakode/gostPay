
<div id="kt_header_mobile" class="header-mobile <?php echo e(Metronic::printClasses('header-mobile', false)); ?>" <?php echo e(Metronic::printAttrs('header-mobile')); ?>>
    <div class="mobile-logo">
        <a href="<?php echo e(url('/')); ?>">

            <?php
                $kt_logo_image = 'logo-light.png'
            ?>

            <?php if(config('layout.aside.self.display') == false): ?>

                <?php if(config('layout.header.self.theme') === 'light'): ?>
                    <?php $kt_logo_image = 'logo-dark.png' ?>
                <?php elseif(config('layout.header.self.theme') === 'dark'): ?>
                    <?php $kt_logo_image = 'logo-light.png' ?>
                <?php endif; ?>

            <?php else: ?>

                <?php if(config('layout.brand.self.theme') === 'light'): ?>
                    <?php $kt_logo_image = 'logo-dark.png' ?>
                <?php elseif(config('layout.brand.self.theme') === 'dark'): ?>
                    <?php $kt_logo_image = 'logo-light.png' ?>
                <?php endif; ?>

            <?php endif; ?>

            <img alt="<?php echo e(config('app.name')); ?>" src="<?php echo e(asset('media/logos/'.$kt_logo_image)); ?>"/>
        </a>
    </div>
    <div class="d-flex align-items-center">

        <?php if(config('layout.aside.self.display')): ?>
            <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle"><span></span></button>
        <?php endif; ?>

        <?php if(config('layout.header.menu.self.display')): ?>
            <button class="btn p-0 burger-icon ml-4" id="kt_header_mobile_toggle"><span></span></button>
        <?php endif; ?>

        <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
            <?php echo e(Metronic::getSVG('media/svg/icons/General/User.svg', 'svg-icon-xl')); ?>

        </button>

    </div>
</div>
<?php /**PATH C:\Users\hd\PhpstormProjects\pay\resources\views/layout/base/_header-mobile.blade.php ENDPATH**/ ?>