<?php
	$direction = config('layout.extras.user.offcanvas.direction', 'right');
?>
 
<div id="kt_quick_user" class="offcanvas offcanvas-<?php echo e($direction); ?> p-10">
	
    <?php if(request()->user()->company): ?>
	<div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
		<h3 class="font-weight-bold m-0">
			Профиль пользователя
			<small class="text-muted font-size-sm ml-2">
                <?php echo e(\Illuminate\Support\Facades\Auth::user()->cards()->count()); ?> Карт
            </small>
		</h3>
		<a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
			<i class="ki ki-close icon-xs text-muted"></i>
		</a>
	</div>
    <?php endif; ?>

	
    <div class="offcanvas-content pr-5 mr-n5">
		
        <div class="d-flex align-items-center mt-5">
            <div class="symbol symbol-100 mr-5">
                <div class="symbol-label"
                     style="background-image:url('<?php echo e(asset(\Illuminate\Support\Facades\Auth::user()->avatar)); ?>')"></div>
				<i class="symbol-badge bg-success"></i>
            </div>
            <div class="d-flex flex-column">
                <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">
					<?php echo e(\Illuminate\Support\Facades\Auth::user()->fullname); ?>

				</a>
                <?php if(isset(\Illuminate\Support\Facades\Auth::user()->role)): ?>
                    <div class="text-muted mt-1">
                        <?php echo e(\Illuminate\Support\Facades\Auth::user()->role->name); ?>

                    </div>
                <?php endif; ?>
                <div class="navi mt-2">
                    <a href="#" class="navi-item">
                        <span class="navi-link p-0 pb-2">
                            <span class="navi-icon mr-1">
								<?php echo e(Metronic::getSVG("media/svg/icons/Communication/Mail-notification.svg", "svg-icon-lg svg-icon-primary")); ?>

							</span>
                            <span class="navi-text text-muted text-hover-primary">
                                <?php echo e(\Illuminate\Support\Facades\Auth::user()->email); ?>

                            </span>
                        </span>
                    </a>
                </div>
            </div>
        </div>

		
		<div class="separator separator-dashed mt-8 mb-5"></div>

		
		<div class="navi navi-spacer-x-0 p-0">
		    
		    <a href="<?php echo e(route('profile_show')); ?>" class="navi-item">
		        <div class="navi-link">
		            <div class="symbol symbol-40 bg-light mr-3">
		                <div class="symbol-label">
							<?php echo e(Metronic::getSVG("media/svg/icons/General/Notification2.svg", "svg-icon-md svg-icon-success")); ?>

						</div>
		            </div>
		            <div class="navi-text">
		                <div class="font-weight-bold">
		                        Мой профиль
		                </div>
		                <div class="text-muted">
		                   Настройки учетной записи и многое другое

		                </div>
		            </div>
		        </div>
		    </a>

		    
		    <a href="<?php echo e(route('profile_cards')); ?>"  class="navi-item">
		        <div class="navi-link">
					<div class="symbol symbol-40 bg-light mr-3">
						<div class="symbol-label">
 						   <?php echo e(Metronic::getSVG("media/svg/icons/Shopping/Chart-bar1.svg", "svg-icon-md svg-icon-warning")); ?>

 					   </div>
				   	</div>
		            <div class="navi-text">
		                <div class="font-weight-bold">
		                    Мои карты
		                </div>
		                <div class="text-muted">
		                    Просмотр карт
		                </div>
		            </div>
		        </div>
		    </a>

		    <a href="<?php echo e(route('logout')); ?>"  class="navi-item">
		        <div class="navi-link">
					<div class="symbol symbol-40 bg-light mr-3">
						<div class="symbol-label">
 						   <?php echo e(Metronic::getSVG("media/svg/icons/Home/Door-open.svg", "svg-icon-md svg-icon-danger ")); ?>

 					   </div>
				   	</div>
		            <div class="navi-text">
		                <div class="font-weight-bold">
		                    Выход
		                </div>
		                <div class="text-muted">
		                    Выйти из аккаунта
		                </div>
		            </div>
		        </div>
		    </a>

		    


















		    



















		
		<div class="separator separator-dashed my-7"></div>

		




























































    </div>
</div>
<?php /**PATH C:\Users\hd\PhpstormProjects\pay\resources\views/layout/partials/extras/offcanvas/_quick-user.blade.php ENDPATH**/ ?>