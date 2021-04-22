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
                <a class="nav-link active" data-toggle="tab" href="#quick_panel_all_payments">Сообщение от банка</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#quick_panel_user_cards_payments">Сообщение от карт</a>
            </li>
        </ul>
        <div class="offcanvas-close mt-n1 pr-5">
            <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_panel_close">
                <i class="ki ki-close icon-xs text-muted"></i>
            </a>
        </div>
    </div>

    {{-- Content --}}
    <div class="offcanvas-content px-10">
        <div class="tab-content">
            {{-- Tabpane --}}
            @include('quick-panel.item-payment-list', [
                'id' => 'quick_panel_all_payments',
                'payments' => request()->user()->company->invoices()->payments()->nowDay()->getNotCards(),
                'image' => request()->user()->company->avatar('small') ?? asset('media/svg/avatars/009-boy-4.svg'),
                'title' => request()->user()->company->name,
                ])

            @include('quick-panel.item-payment-list', [
                'id' => 'quick_panel_user_cards_payments',
                'payments' => request()->user()->company->invoices()->payments()->nowDay()->getCards(),
                'image' => request()->user()->company->avatar('small') ?? asset('media/svg/avatars/009-boy-4.svg'),
                'title' => request()->user()->company->name,
                ])
        </div>
    </div>
</div>

