{{-- Stats Widget 7 --}}

@if(request()->user()->hasPermission(\App\Interfaces\OptionsPermissions::MANAGER_ROLE_SET))
    <div class="card card-custom {{ @$class }}">
        {{-- Body --}}
        <div class="card-body d-flex flex-column p-0">
            <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
                <div class="d-flex flex-column mr-2">
                    <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Расходы компании</a>
                    <span class="text-muted font-weight-bold mt-2">Расходы по картам пользователей</span>
                </div>
                <span class="symbol symbol-light-success symbol-45">
                <span class="symbol-label font-weight-bolder font-size-h6">+{{ request()->user()->company->users()->count() }}</span>
            </span>
            </div>
            <div id="kt_stats_widget_7_chart" class="card-rounded-bottom" style="height: 150px"></div>
        </div>
    </div>
@endif
