@isset($company)
    <div class="d-flex flex-column flex-center">
        <!--begin::Image-->
        <div class="bgi-no-repeat bgi-size-cover rounded min-h-180px w-100"
             style="background-image: url({{ $company->avatar }});
                 background-repeat: no-repeat;
                 background-position: center;
                 background-size: contain;
                 "></div>
        <!--end::Image-->
        <!--begin::Title-->
        <a href="{{ route('company.show', $company->id) }}" class="card-toolbar font-weight-bolder text-dark-75 text-hover-primary font-size-h4 m-0 pt-7 pb-1">
            {{ $company->name }}
        </a>

        @if(request()->user()->hasPermission(\App\Interfaces\OptionsPermissions::OWNER['title']))
        <a href="{{ route('company.logout') }}" class="text-danger text-hover-primary">
            Выйти
        </a>
        @endif
        <!--end::Title-->
        <!--begin::Text-->
        <div class="font-weight-bold text-dark-50 font-size-sm pb-7"></div>
        <!--end::Text-->
    </div>
@else
{{--    <div class="d-flex flex-column flex-center">--}}
{{--        <span href="" class="bgi-no-repeat bgi-size-cover rounded min-h-30px">--}}
{{--            Нет компании--}}
{{--        </span>--}}
{{--    </div>--}}
@endisset
