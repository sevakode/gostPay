<div class="card card-custom gutter-b">
    <!--begin::Body-->
    <div class="card-body d-flex align-items-center justify-content-between flex-wrap py-3">
        <!--begin::Info-->
        <div class="d-flex align-items-center mr-2 py-2">
            <!--begin::Title-->
            <h3 class="font-weight-bold mb-0 mr-10">Bank Cards</h3>
            <!--end::Title-->
            <!--begin::Navigation-->
            <div class="d-flex mr-3">
                <!--begin::Navi-->
                <div class="navi navi-hover navi-active navi-link-rounded navi-bold d-flex flex-row">
                    <!--begin::Item-->
                    <div class="navi-item mr-2">
                        <a href="{{ route('cards') }}" class="navi-link
                         @if(\Illuminate\Support\Facades\Request::fullUrlIs(route('cards')))
                        active
                         @endif
                        ">
                            <span class="navi-text">Карты</span>
                        </a>
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="navi-item mr-2">
                        <a href="{{ route('cards.create') }}" class="navi-link
                        @if(\Illuminate\Support\Facades\Request::fullUrlIs(route('cards.create')))
                        active
                        @endif
                            ">
                            <span class="navi-text">Добавить карты</span>
                        </a>
                    </div>
                    <!--end::Item-->
                </div>
                <!--end::Navi-->
            </div>
            <!--end::Navigation-->
        </div>
        <!--end::Info-->
    </div>
    <!--end::Body-->
</div>
