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

                @include('pages.company.navbar.item', [
                    'svg' => 'Text/Bullet-list.svg',
                    'route' => route('company.list'),
                    'title' => 'Компании',
                    'description' => 'Просмотр и Управление всех компаний',
                    'count' => \App\Models\Company::count(),
                    'permission' => \App\Interfaces\OptionsPermissions::ACCESS_TO_ALL_COMPANY,
                    'scripts' => asset('js/pages/custom/profile/profile.js'),
                    ])
                @include('pages.company.navbar.item', [
                    'svg' => 'Navigation/Plus.svg',
                    'route' => route('company.create.show'),
                    'title' => 'Открыть',
                    'description' => 'Открыть новую Компанию',
                    'permission' => \App\Interfaces\OptionsPermissions::ACCESS_TO_CREATE_COMPANY,
                    'scripts' => asset('js/pages/custom/profile/profile.js'),
                    ])
                @include('pages.company.navbar.item', [
                    'svg' => 'General/Settings-2.svg',
                    'route' => route('company.edit'),
                    'title' => 'Моя компания',
                    'description' => 'Изменить данные Компании',
                    'permission' => \App\Interfaces\OptionsPermissions::ADMIN_ROLE_SET,
                    'scripts' => asset('js/pages/custom/profile/profile.js'),
                    ])
                @include('pages.company.navbar.item', [
                    'svg' => 'Files/DownloadedFile.svg',
                    'route' => route('company.download.report.users.xls'),
                    'title' => 'Отчет',
                    'description' => 'Получить отчет компании в XLS',
                    'permission' => \App\Interfaces\OptionsPermissions::ADMIN_ROLE_SET,
                    'scripts' => asset('js/pages/custom/profile/profile.js'),
                    ])
                <!--end::Item-->
                </div>
                <!--end::Body-->
            </div>
            <!--eng::Container-->
            <!--begin::Footer-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Body-->
</div>
