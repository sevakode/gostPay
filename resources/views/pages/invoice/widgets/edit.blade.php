{{-- Extends layout --}}
@extends('pages.invoice.dashboard')

{{-- Content --}}
@section('content-widget')
    <div class="card card-custom card-stretch gutter-b">
        <div class="row justify-content-center">
            <div class="col-xl-9">
                @include('pages.invoice.widgets.insert', ['route' => route('invoice.insert')])
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(".kt_select2_3").select2({
            placeholder: "Поиск свободных карт",
            allowClear: true,
            ajax: {
                url: "{{ route('bank.company.account.list.ajax') }}",
                method: 'POST',

                dataType: 'json',
                delay: 250,
                data: function data(params) {
                    return {
                        q: params.term,
                        // search term
                        page: params.page,
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                    };
                },
                processResults: function processResults(data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: params.page * 30 < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function escapeMarkup(markup) {
                return markup;
            },
            // let our custom formatter work
            minimumInputLength: 0,
            // templateResult: formatRepo,
            // omitted for brevity, see the source of this page
            // templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });
    </script>
    <script>
        // Class definition
        var KTFormRepeater = function() {

            // Private functions
            var demo2 = function() {
                $('.kt_repeater_2').repeater({
                    initEmpty: false,

                    defaultValues: {
                        'text-input': 'foo'
                    },

                    show: function() {
                        $(this).slideDown();
                    },

                    hide: function(deleteElement) {
                        if(confirm('Are you sure you want to delete this element?')) {
                            $(this).slideUp(deleteElement);
                        }
                    }
                });
            }
            return {
                // public functions
                init: function() {
                    demo2();
                }
            };
        }();

        jQuery(document).ready(function() {
            KTFormRepeater.init();
        });
    </script>
    <script src="{{ asset('js/pages/custom/profile/profile.js') }}" type="text/javascript"></script>
@endsection
