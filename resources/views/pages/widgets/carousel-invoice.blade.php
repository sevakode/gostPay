@if($invoices->exists())
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="card card-custom {{ @$class }}">
            <!--begin::Body-->
            <div class="card-body">
                <div class="carousel-inner">
                    @foreach($invoices->get() as $invoice)
                        <div class="card-title carousel-item @if($loop->first) active @endif">
                            <span class="svg-icon svg-icon-2x">
                                {{ \App\Classes\Theme\Metronic::getSVG( $invoice->bank->icon) }}
                                <span class="font-weight-bolder text-dark-75 font-size-h5 mb-0 mt-6">
                                    {{ $invoice->bank->title }}
                                </span>
                            </span>
                            <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">
                                {{ $invoice->currencySign }}{{ (int) $invoice->avail }}
                            </span>
                            <span class="font-weight-bold text-muted font-size-sm">BIN: {{ $invoice->bin }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            <!--end::Body-->
        </div>


        @if($invoices->count() !== 1)
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        @endif
    </div>
@endif
