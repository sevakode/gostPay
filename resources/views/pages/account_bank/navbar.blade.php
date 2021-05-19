<div class="card card-custom gutter-b">
    <!--begin::Body-->
    <div class="card-body">
        <!--begin::Wrapper-->
        <div class="d-flex justify-content-between flex-column h-100">
            <!--begin::Container-->
            <div class="h-100" id="navbar">
                <!--begin::Header-->
                @include('pages.company.navbar.my-company-preview',[
                        'company' => \Illuminate\Support\Facades\Auth::user()->company ?? null
                    ])
                <!--end::Header-->
                <!--begin::Body-->
                <div class="pt-1">
                <!--begin::Item-->
{{--                @include('pages.company.navbar.list')--}}
                @include('pages.company.navbar.item', [
                    'svg' => 'Text/Bullet-list.svg',
                    'route' => route('bank.account.list'),
                    'title' => 'Список аккаунтов',
                    'description' => '',
                    'count' => \App\Models\Bank\BankToken::count(),
                    'permission' => \App\Interfaces\OptionsPermissions::OWNER,
                    'scripts' => asset('js/pages/custom/profile/profile.js'),
                    ])
                <!--end::Item-->

                </div>
                <!--end::Body-->
            </div>
            <!--eng::Container-->
            <!--begin::Footer-->
        {{--                            <div class="d-flex flex-center" id="kt_sticky_toolbar_chat_toggler_2" data-toggle="tooltip" title="" data-placement="right" data-original-title="Chat Example">--}}
        {{--                                <button class="btn btn-primary font-weight-bolder font-size-sm py-3 px-14" data-toggle="modal" data-target="#kt_chat_modal">Contact School</button>--}}
        {{--                            </div>--}}
        <!--end::Footer-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Body-->
</div>
