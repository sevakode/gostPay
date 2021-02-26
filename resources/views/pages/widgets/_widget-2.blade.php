{{-- Stats Widget 7 --}}
<div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
                <div class="d-flex flex-column mr-2">
                    <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Расходы по проектам</a>
                    <span class="text-muted font-weight-bold mt-2">Проекты</span>
                </div>
                <span class="symbol symbol-45 ">
                    <span class="symbol-label font-weight-bolder font-size-h6"
                          style="color: #ff8c00; background-color: #ffd19a;">
                        +{{ request()->user()->company->projects()->count() }}
                    </span>
                </span>
            </div>
        </div>
        <div class="card-body" style="position: relative;">
            <!--begin::Chart-->
            <div id="chart-projects" class="card-rounded-bottom align-content-center" style="height: 150px"></div>
            <!--end::Chart-->
            <div class="resize-triggers">
                <div class="expand-trigger">
                    <div style="width: 445px; height: 294px;"></div>
                </div>
                <div class="contract-trigger"></div>
            </div>
        </div>
    </div>
