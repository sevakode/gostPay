<div class="tab-pane fade show pt-3 pr-5 mr-n5 active" id="{{ $id }}" role="tabpanel">
    {{-- Section --}}
    <div class="mb-15">
{{--        <h5 class="font-weight-bold mb-5">System Messages</h5>--}}
        {{-- Item --}}
        @foreach($payments as $payment)
        <div class="d-flex align-items-center flex-wrap mb-5">
            <div class="symbol symbol-50 symbol-light mr-5">
                <span class="symbol-label">
                    <img src="{{ $image }}" class="h-50 align-self-center" alt=""/>
                </span>
            </div>
            <div class="d-flex flex-column flex-grow-1 mr-2">
                <a href="#" class="font-weight-bolder text-dark-75 text-hover-primary font-size-lg mb-1">
                    {{ $title ?? $payment->number() ?? ''}}
                </a>
                <span class="text-muted font-weight-bold">{{ $payment->description }}</span>
            </div>
            <span class="btn btn-sm btn-light font-weight-bolder py-1 my-lg-0 my-2 text-dark-50">
                {{ $payment->type == \App\Models\Bank\Payment::EXPENDITURE ? '-' : '+' }}
                {{ $payment->amount }}
                {{ $payment->currency == 'RUB' ? '₽' : '$'}}
            </span>
        </div>
        @endforeach
    </div>
</div>
