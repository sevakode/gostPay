{{-- Extends layout --}}
@extends('pages.account_bank.layout')

{{-- Content --}}
@section('content-widget')
    <div class="card card-custom card-stretch gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0">
            <h3 class="card-title font-weight-bolder text-dark">Аккаунты</h3>
            <div class="card-toolbar">
                <a href="{{ route('bank.account.create') }}" class="btn btn-primary mr-2">Создать</a>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-2">
        @foreach($accounts->get() as $account)
            <!--begin::Item-->
                <div class="d-flex align-items-center mb-10" id="account-id-{{ $account->id }}">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-40 symbol-light-success mr-5">
                        <span class="svg-icon svg-icon-2x">
                            {{ \App\Classes\Theme\Metronic::getSVG( $account->bank->icon) }}
                        </span>
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Text-->
                    <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                        <a href="{{ route('bank.account.edit', $account->id) }}" class="text-dark text-hover-primary mb-1 font-size-lg">
                            {{ $account->bank->title }}
                        </a>
                        <span class="text-muted" id="user-role-id-{{ $account->id }}">{{ $account->name }}</span>
                    </div>
                    <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                        <span class="text-dark text-hover-primary mb-1 font-size-lg">{{ $account->name }}</span>
                        <span class="text-muted">{{ $account->getDateRefresh() }}</span>
                    </div>
{{--                    <span style="width: 122px;">--}}
{{--                        <span class="label label-lg font-weight-bold  label-light-primary label-inline">--}}
{{--                            {{ $account->getDateRefresh() }}--}}
{{--                        </span>--}}
{{--                    </span>--}}
                    <!--end::Text-->
                    <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" data-html="true" data-placement="left"
                         data-original-title="">
                        <a href="#" class="btn btn-hover-light-danger btn-sm btn-icon btn-delete-ajax"
                           aria-haspopup="true" aria-expanded="false"
                           data-account-id="{{ $account->id }}">
                            <i class="fas fa-trash text-danger"></i>
                        </a>
                    </div>
                </div>
                <!--end::Item-->
            @endforeach
        </div>
        <!--end::Body-->
    </div>
@endsection

@section('scripts')
    <script>
        $('.btn-delete-ajax').on('click', function () {
            let accountId = $(this).attr("data-account-id");
            console.log(accountId);
            $.ajax({
                type:'delete',
                url:'{{ route('bank.account.delete') }}',
                dataType: "json",
                data:{
                    '_token':$('meta[name="csrf-token"]').attr('content'),
                    'id': accountId,
                },
                success: function (data) {
                    console.log(data);
                    div = $('#account-id-'+ data.account_id);
                    div.html('')
                    sendNotification()
                },
                error: function () {
                    sendNotification()
                }
            });
            // let roleId = $(this).attr("data-role-id");
        });
    </script>
@endsection
