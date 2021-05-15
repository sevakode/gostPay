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
        // Class definition
        var KTFormRepeater = function() {

            // Private functions
            var demo2 = function() {
                $('#kt_repeater_2').repeater({
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
