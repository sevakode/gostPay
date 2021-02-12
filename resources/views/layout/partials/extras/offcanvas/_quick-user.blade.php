@php
	$direction = config('layout.extras.user.offcanvas.direction', 'right');
@endphp
 {{-- User Panel --}}
<div id="kt_quick_user" class="offcanvas offcanvas-{{ $direction }} p-10">
	{{-- Header --}}
    @if(request()->user()->company)
	<div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
		<h3 class="font-weight-bold m-0">
			Профиль пользователя
			<small class="text-muted font-size-sm ml-2">
                {{ \Illuminate\Support\Facades\Auth::user()->cards()->count()}} Карт
            </small>
		</h3>
		<a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
			<i class="ki ki-close icon-xs text-muted"></i>
		</a>
	</div>
    @endif

	{{-- Content --}}
    <div class="offcanvas-content pr-5 mr-n5">
		{{-- Header --}}
        <div class="d-flex align-items-center mt-5">
            <div class="symbol symbol-100 mr-5">
                <div class="symbol-label"
                     style="background-image:url('{{ asset(\Illuminate\Support\Facades\Auth::user()->avatar) }}')"></div>
				<i class="symbol-badge bg-success"></i>
            </div>
            <div class="d-flex flex-column">
                <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">
					{{ \Illuminate\Support\Facades\Auth::user()->fullname }}
				</a>
                @isset(\Illuminate\Support\Facades\Auth::user()->role)
                    <div class="text-muted mt-1">
                        {{ \Illuminate\Support\Facades\Auth::user()->role->name }}
                    </div>
                @endisset
                <div class="navi mt-2">
                    <a href="#" class="navi-item">
                        <span class="navi-link p-0 pb-2">
                            <span class="navi-icon mr-1">
								{{ Metronic::getSVG("media/svg/icons/Communication/Mail-notification.svg", "svg-icon-lg svg-icon-primary") }}
							</span>
                            <span class="navi-text text-muted text-hover-primary">
                                {{ \Illuminate\Support\Facades\Auth::user()->email }}
                            </span>
                        </span>
                    </a>
                </div>
            </div>
        </div>

		{{-- Separator --}}
		<div class="separator separator-dashed mt-8 mb-5"></div>

		{{-- Nav --}}
		<div class="navi navi-spacer-x-0 p-0">
		    {{-- Item --}}
		    <a href="{{ route('profile_show') }}" class="navi-item">
		        <div class="navi-link">
		            <div class="symbol symbol-40 bg-light mr-3">
		                <div class="symbol-label">
							{{ Metronic::getSVG("media/svg/icons/General/Notification2.svg", "svg-icon-md svg-icon-success") }}
						</div>
		            </div>
		            <div class="navi-text">
		                <div class="font-weight-bold">
		                        Мой профиль
		                </div>
		                <div class="text-muted">
		                   Настройки учетной записи и многое другое
{{--		                    <span class="label label-light-danger label-inline font-weight-bold">Обновить</span>--}}
		                </div>
		            </div>
		        </div>
		    </a>

		    {{-- Item --}}
		    <a href="{{ route('profile_cards') }}"  class="navi-item">
		        <div class="navi-link">
					<div class="symbol symbol-40 bg-light mr-3">
						<div class="symbol-label">
 						   {{ Metronic::getSVG("media/svg/icons/Shopping/Chart-bar1.svg", "svg-icon-md svg-icon-warning") }}
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

		    <a href="{{ route('logout') }}"  class="navi-item">
		        <div class="navi-link">
					<div class="symbol symbol-40 bg-light mr-3">
						<div class="symbol-label">
 						   {{ Metronic::getSVG("media/svg/icons/Home/Door-open.svg", "svg-icon-md svg-icon-danger ") }}
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

		    {{-- Item --}}
{{--		    <a href="#"  class="navi-item">--}}
{{--		        <div class="navi-link">--}}
{{--					<div class="symbol symbol-40 bg-light mr-3">--}}
{{--						<div class="symbol-label">--}}
{{--							{{ Metronic::getSVG("media/svg/icons/Files/Selected-file.svg", "svg-icon-md svg-icon-danger") }}--}}
{{--						</div>--}}
{{--				   	</div>--}}
{{--		            <div class="navi-text">--}}
{{--		                <div class="font-weight-bold">--}}
{{--		                    Моя деятельность--}}
{{--		                </div>--}}
{{--		                <div class="text-muted">--}}
{{--		                    Журналы и уведомления--}}
{{--		                </div>--}}
{{--		            </div>--}}
{{--		        </div>--}}
{{--		    </a>--}}

		    {{-- Item --}}
{{--		    <a href="#" class="navi-item">--}}
{{--		        <div class="navi-link">--}}
{{--					<div class="symbol symbol-40 bg-light mr-3">--}}
{{--						<div class="symbol-label">--}}
{{--							{{ Metronic::getSVG("media/svg/icons/Communication/Mail-opened.svg", "svg-icon-md svg-icon-primary") }}--}}
{{--						</div>--}}
{{--				   	</div>--}}
{{--		            <div class="navi-text">--}}
{{--		                <div class="font-weight-bold">--}}
{{--		                    Мои задачи--}}
{{--		                </div>--}}
{{--		                <div class="text-muted">--}}
{{--		                    Последние задачи и проекты--}}
{{--		                </div>--}}
{{--		            </div>--}}
{{--		        </div>--}}
{{--		    </a>--}}
{{--		</div>--}}

		{{-- Separator --}}
		<div class="separator separator-dashed my-7"></div>

		{{-- Notifications --}}
{{--		<div>--}}
{{--			--}}{{-- Heading --}}
{{--        	<h5 class="mb-5">--}}
{{--            	Недавние уведомления--}}
{{--        	</h5>--}}

{{--			--}}{{-- Item --}}
{{--	        <div class="d-flex align-items-center bg-light-warning rounded p-5 gutter-b">--}}
{{--	            <span class="svg-icon svg-icon-warning mr-5">--}}
{{--	                {{ Metronic::getSVG("media/svg/icons/Home/Library.svg", "svg-icon-lg") }}--}}
{{--	            </span>--}}

{{--	            <div class="d-flex flex-column flex-grow-1 mr-2">--}}
{{--	                <a href="#" class="font-weight-normal text-dark-75 text-hover-primary font-size-lg mb-1">Другая цель убедить</a>--}}
{{--	                <span class="text-muted font-size-sm">Срок в 2 дня</span>--}}
{{--	            </div>--}}

{{--	            <span class="font-weight-bolder text-warning py-1 font-size-lg">+28%</span>--}}
{{--	        </div>--}}

{{--	        --}}{{-- Item --}}
{{--	        <div class="d-flex align-items-center bg-light-success rounded p-5 gutter-b">--}}
{{--	            <span class="svg-icon svg-icon-success mr-5">--}}
{{--	                {{ Metronic::getSVG("media/svg/icons/Communication/Write.svg", "svg-icon-lg") }}--}}
{{--	            </span>--}}
{{--	            <div class="d-flex flex-column flex-grow-1 mr-2">--}}
{{--	                <a href="#" class="font-weight-normal text-dark-75 text-hover-primary font-size-lg mb-1">Would be to people</a>--}}
{{--	                <span class="text-muted font-size-sm">Due in 2 Days</span>--}}
{{--	            </div>--}}

{{--	            <span class="font-weight-bolder text-success py-1 font-size-lg">+50%</span>--}}
{{--	        </div>--}}

{{--	        --}}{{-- Item --}}
{{--	        <div class="d-flex align-items-center bg-light-danger rounded p-5 gutter-b">--}}
{{--	            <span class="svg-icon svg-icon-danger mr-5">--}}
{{--	                {{ Metronic::getSVG("media/svg/icons/Communication/Group-chat.svg", "svg-icon-lg") }}--}}
{{--	            </span>--}}
{{--	            <div class="d-flex flex-column flex-grow-1 mr-2">--}}
{{--	                <a href="#" class="font-weight-normel text-dark-75 text-hover-primary font-size-lg mb-1">Purpose would be to persuade</a>--}}
{{--	                <span class="text-muted font-size-sm">Due in 2 Days</span>--}}
{{--	            </div>--}}

{{--	            <span class="font-weight-bolder text-danger py-1 font-size-lg">-27%</span>--}}
{{--	        </div>--}}

{{--	        --}}{{-- Item --}}
{{--	        <div class="d-flex align-items-center bg-light-info rounded p-5">--}}
{{--	            <span class="svg-icon svg-icon-info mr-5">--}}
{{--	                {{ Metronic::getSVG("media/svg/icons/General/Attachment2.svg", "svg-icon-lg") }}--}}
{{--	            </span>--}}

{{--	            <div class="d-flex flex-column flex-grow-1 mr-2">--}}
{{--	                <a href="#" class="font-weight-normel text-dark-75 text-hover-primary font-size-lg mb-1">The best product</a>--}}
{{--	                <span class="text-muted font-size-sm">Due in 2 Days</span>--}}
{{--	            </div>--}}

{{--	            <span class="font-weight-bolder text-info py-1 font-size-lg">+8%</span>--}}
{{--	        </div>--}}
{{--		</div>--}}
    </div>
</div>
