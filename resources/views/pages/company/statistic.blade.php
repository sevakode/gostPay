<div class="card card-custom gutter-b">
    <!--begin::Body-->
    <div class="card-body">
        <!--begin::Wrapper-->
        <div class="d-flex justify-content-between flex-column h-100">
            <!--begin::Container-->
            <div class="h-100" id="navbar">
                <span class="card-toolbar font-weight-bolder text-dark-75 text-hover-primary font-size-h4 m-0 pt-7 pb-1">
                    Статистика
                </span>
                <div class="pt-1">

                <div class="d-flex align-items-center pb-9">
                    <!--begin::Text-->
                    <div class="d-flex flex-column flex-grow-1">
                        <span class="text-dark-75 text-hover-primary mb-1 font-size-lg ">
                            Состояние карт:
                        </span>

                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar"
                                 style="width: {{ $card_states->get('active') }}%"
                                 aria-valuemin="0" aria-valuemax="100"
                                 data-toggle="tooltip" data-placement="right"
                                 data-original-title="Количество активных карт ({{ $card_states->get('active_count') }})"
                            ></div>
                            <div class="progress-bar bg-primary" role="progressbar"
                                 style="width: {{ $card_states->get('pending') }}%"
                                 aria-valuemin="0" aria-valuemax="100"
                                 data-toggle="tooltip" data-placement="right"
                                 data-original-title="Количество карт в ожидании ({{ $card_states->get('pending_count') }})"
                            ></div>
                            <div class="progress-bar bg-danger" role="progressbar"
                                 style="width: {{ $card_states->get('close') }}%"
                                 aria-valuemin="0" aria-valuemax="100"
                                 data-toggle="tooltip" data-placement="right"
                                 data-original-title="Количество закрытых карт ({{ $card_states->get('close_count') }})"
                            ></div>
                        </div>
                    </div>
                    <!--end::Text-->
                    @isset($count)
                    <!--begin::label-->
                        <span
                            class="font-weight-bolder label label-xl label-light-success label-inline px-3 py-5 min-w-45px">{{ $count }}</span>
                        <!--end::label-->
                    @endisset
                </div>
                <!--end::Item-->
            </div>
            <!--end::Body-->
        </div>
        <!--eng::Container-->
    </div>
    <!--end::Wrapper-->
</div>
<!--end::Body-->
</div>
