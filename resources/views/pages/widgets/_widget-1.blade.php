<div class="card card-custom gutter-b">
        <div class="card-body row">
            <div class=" col-lg-4 col-md-9 col-sm-12">
                <div class="input-daterange input-group" id="datepicker_chart">
                    <input type="text" class="form-control" id="date-start" name="date_start">
                    <div class="input-group-append">
                        <span class="input-group-text"><=</span>
                    </div>
                    <input type="text" class="form-control" id="date-end" name="date_end">
                </div>
                <span class="form-text text-muted">Фильтр по дате</span>
            </div>

            <div class="col-lg-1 col-xl-1" style="padding-left: 0px; padding-right: 0px;">
                <div id="checkbox-parameter" class="dropdown dropdown-inline">
                    <a href="javascript:;"
                       class="btn btn-md btn-default btn-text-primary btn-hover-primary btn-icon mr-3"
                       data-toggle="dropdown">
                    <span class="svg-icon svg-icon-md">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="svg-icon">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"></path>
                                <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"></path>
                            </g>
                        </svg>
                    </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
                        <ul class="navi flex-column navi-hover ">
                            <li class="navi-header font-weight-bolder text-uppercase font-size-xs text-primary pb-3">
                                Выберите действие:
                            </li>
                            <li class="navi-item">
                                <div class="pl-2">
                                    @include('pages.company.navbar.item', [
                                        'id' => 'get-parameters-date',
                                        'svg' => 'Files/DownloadedFile.svg',
                                        'route' => route('company.download.report.users.xls'),
                                        'title' => 'Отчет',
                                        'description' => 'Получить отчет компании в XLS',
                                        'permission' => \App\Interfaces\OptionsPermissions::ADMIN_ROLE_SET
                                        ])
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
</div>
