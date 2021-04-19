<div class="card card-custom bg-light-white card-stretch gutter-b">
    <!--begin::Body-->
    <div class="card-body">
        <span class="svg-icon svg-icon-warning svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-04-09-093151/theme/html/demo1/dist/../src/media/svg/icons/Design/Circle.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <rect x="0" y="0" width="24" height="24"/>
                <rect fill="#000000" opacity="0.3" x="2" y="2" width="10" height="12" rx="2"/>
                <path d="M4,6 L20,6 C21.1045695,6 22,6.8954305 22,8 L22,20 C22,21.1045695 21.1045695,22 20,22 L4,22 C2.8954305,22 2,21.1045695 2,20 L2,8 C2,6.8954305 2.8954305,6 4,6 Z M18,16 C19.1045695,16 20,15.1045695 20,14 C20,12.8954305 19.1045695,12 18,12 C16.8954305,12 16,12.8954305 16,14 C16,15.1045695 16.8954305,16 18,16 Z" fill="#000000"/>
            </g>
            </svg><!--end::Svg Icon-->
        </span>
        <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">
                ₽{{ request()->user()->company->sumCardsInvoices() }}
            </span>
        <span class="font-weight-bold text-muted font-size-sm">Баланс</span>
    </div>
    <!--end::Body-->
</div>
