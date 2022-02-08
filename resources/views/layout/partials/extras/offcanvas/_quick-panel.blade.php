@php
    $direction = config('layout.extras.quick-panel.offcanvas.direction', 'right');
@endphp
{{-- Quick Panel --}}
<div id="kt_quick_panel" class="offcanvas offcanvas-{{ $direction }} pt-5 pb-10">
    {{-- Header --}}
    <div class="offcanvas-header offcanvas-header-navs d-flex align-items-center justify-content-between mb-5">
        <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-primary flex-grow-1 px-10"
            role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#kt_quick_panel_logs">All</a>
            </li>

            <li class="nav-item">
                <span class="badge badge-pill badge-success" id="button_kt_quick_panel_notifications_badge" style="float:right;margin-bottom:-10px;">new</span>
                <a class="nav-link" data-toggle="tab" id="button_kt_quick_panel_notifications" href="#kt_quick_panel_notifications">Сообщения для карт</a>

            </li>
        </ul>
        <div class="offcanvas-close mt-n1 pr-5">
            <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_panel_close">
                <i class="ki ki-close icon-xs text-muted"></i>
            </a>
        </div>
    </div>

    {{-- Content --}}
    <div class="offcanvas-content pl-5">
        <div class="tab-content">
            {{-- Tabpane --}}
{{--            @isset(request()->user()->company)--}}
                @include('quick-panel.item-payment-list', [
                    'id' => 'kt_quick_panel_logs',
                    'payments' => request()->user()->company->invoices()->payments()->nowDay()->getNotCards(),
                    'image' => request()->user()->company->avatar('small') ?? asset('media/svg/avatars/009-boy-4.svg'),
                    'title' => request()->user()->company->name ?? 'Компания не привязана',
                    ])

                @include('quick-panel.item-payment-notify-list', [
                    'id' => 'kt_quick_panel_notifications',
                    ])
{{--            @endisset--}}
        </div>
    </div>
</div>

