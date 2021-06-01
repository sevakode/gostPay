@php
	$direction = config('layout.extras.user.offcanvas.direction', 'right');
@endphp
 {{-- User Panel --}}
<div id="kt_quick_user" class="offcanvas offcanvas-{{ $direction }} p-10">
	{{-- Header --}}

    @isset(request()->user()->company)
        <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
            <h3 class="font-weight-bold m-0">
                Профиль пользователя
                <small class="text-muted font-size-sm ml-2">
                    {{ \Illuminate\Support\Facades\Auth::user()->cards()->whereActive()->count()}} Карт
                </small>
            </h3>
            <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
                <i class="ki ki-close icon-xs text-muted"></i>
            </a>
        </div>
    @endisset

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

		<div class="separator separator-dashed my-7"></div>

    </div>

        <div>
            <!--begin:Heading-->
            <h5 class="mb-5">Счета:</h5>
            <!--end:Heading-->
            <!--begin::Item-->
            @isset(request()->user()->company)
                @foreach(request()->user()->company->invoices()->get() as $invoice)
                    <div class="d-flex align-items-center bg-diagonal-white rounded p-5 gutter-b">
                                <span class="svg-icon svg-icon-warning mr-5">
                                    <span class="svg-icon svg-icon-lg">
                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Home/Library.svg-->
                                        {{ \App\Classes\Theme\Metronic::getSVG( $invoice->bank->icon) }}
                                        <!--end::Svg Icon-->
                                    </span>
                                </span>
                        <div class="d-flex flex-column flex-grow-1 mr-2">
                            <a href="{{ route('invoice.show', $invoice->account_id) }}"
                               class="font-weight-normal text-dark-75 text-hover-primary font-size-lg mb-1">
                                {{ $invoice->bank->title }}

                                <span class="text-muted font-size-sm">{{ $invoice->account_id }}</span>
                            </a>
                        </div>
                        <span class="font-weight-bolder py-1 font-size-lg">
                            {{ $invoice->currencySign }}{{ (int) $invoice->avail }}
                        </span>
                    </div>
                @endforeach
            @endisset
            <!--end::Item-->
        </div>
</div>
