{{-- Extends layout --}}
@extends('pages.invoice.dashboard')

{{-- Content --}}
@section('content-widget')
    <div class="card card-custom card-stretch gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0">
            <h3 class="card-title font-weight-bolder text-dark">Пользователи</h3>
            <div class="card-toolbar">
                <a href="{{ route('add_user') }}" class="btn btn-primary mr-2">Создать пользователя</a>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-2">
        @foreach($invoices->get() as $invoice)
            <!--begin::Item-->
                <div class="d-flex align-items-center mb-10" id="account-id-{{ $invoice->id }}">
                    <!--begin::Text-->
                    <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                        <a href="{{ route('invoice.show', $invoice->account_id) }}" class="text-dark text-hover-primary mb-1 font-size-lg">
                        <span class="svg-icon svg-icon-2x">
                            {{ \App\Classes\Theme\Metronic::getSVG( $invoice->bank->icon) }}
                             {{ $invoice->bank->title }}
                        </span>
                        </a>
                    </div>
                    <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                        <a href="{{ route('invoice.show', $invoice->account_id) }}" class="text-dark text-hover-primary mb-1 font-size-lg">
                            {{ $invoice->account_id }}
                        </a>
                    </div>
                    <!--end::Text-->
                    <!--begin::Dropdown-->
                    <style>
                        .plus-permissions {
                            /*list-style-type: "+ ";*/
                            color: #00b300;
                        }
                    </style>

                    <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" data-html="true" data-placement="left"
                        data-original-title="">
                        <span class="btn btn-sm btn-light font-weight-bolder py-1 my-lg-0 my-2 text-dark-50">
                            {{ (int) $invoice->avail }} {{ $invoice->currency }}
                        </span>
                    </div>

                    <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" data-html="true" data-placement="left"
                         data-original-title="">
                        <a href="#" class="btn btn-hover-light-danger btn-sm btn-icon btn-delete-ajax"
                           aria-haspopup="true" aria-expanded="false"
                           data-account-id="{{ $invoice->id }}">
                            <i class="fas fa-trash text-danger"></i>
                        </a>
                    </div>
                    <!--end::Dropdown-->
                </div>
                <!--end::Item-->
            @endforeach
        </div>
        <!--end::Body-->
    </div>
@endsection

@section('scripts')
{{--    <script>--}}
{{--        $('.btn-delete-ajax').on('click', function () {--}}
{{--            let accountId = $(this).attr("data-account-id");--}}
{{--            console.log(accountId);--}}
{{--            $.ajax({--}}
{{--                type:'post',--}}
{{--                url:'{{ route('account_delete') }}',--}}
{{--                dataType: "json",--}}
{{--                data:{--}}
{{--                    '_token':$('meta[name="csrf-token"]').attr('content'),--}}
{{--                    'account_id': accountId,--}}
{{--                },--}}
{{--                success: function (data) {--}}
{{--                    console.log(data);--}}
{{--                    div = $('#account-id-'+ data.account_id);--}}
{{--                    div.html('')--}}
{{--                    sendNotification()--}}
{{--                },--}}
{{--                error: function () {--}}
{{--                    sendNotification()--}}
{{--                }--}}
{{--            });--}}
{{--            // let roleId = $(this).attr("data-role-id");--}}
{{--        });--}}
{{--        $('.roleEvent').on('click', function () {--}}
{{--            let accountId = $(this).attr("data-account-id");--}}
{{--            let roleId = $(this).attr("data-role-id");--}}
{{--            $.ajax({--}}
{{--                type:'post',--}}
{{--                url:'{{ route('role_update') }}',--}}
{{--                dataType: "json",--}}
{{--                data:{--}}
{{--                    '_token':$('meta[name="csrf-token"]').attr('content'),--}}
{{--                    'account_id': accountId,--}}
{{--                    'role_id': roleId--}}
{{--                },--}}
{{--                success: function (data) {--}}
{{--                    console.log(data);--}}
{{--                    div = $('#account-role-id-'+ data.account_id);--}}
{{--                    div.html(data.role)--}}
{{--                    sendNotification()--}}
{{--                },--}}
{{--                error: function () {--}}
{{--                    sendNotification()--}}
{{--                }--}}
{{--            });--}}
{{--        })--}}
{{--    </script>--}}
@endsection
