<div class="card card-custom card-stretch gutter-b">
    <div class="card-body">
        <select id="kt_dual_listbox_1" class="dual-listbox" multiple="multiple">
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3" selected>Three</option>
            <option value="4">Four</option>
        </select>
    </div>
</div>



@section('scripts')
    <script>
        'use strict';

        function update(value, status) {
            $.ajax({
                type:'post',
                url:'{{ route('permission_update') }}',
                dataType: "json",
                data:{
                    '_token':$('meta[name="csrf-token"]').attr('content'),
                    'value': value,
                    'status': status
                },
                success: function () {
                    sendNotification()
                },
                error: function () {
                    sendNotification()
                }
            });
        }

        window.addEventListener('load', function () {
            // Dual Listbox
            new DualListbox(document.getElementById('kt_dual_listbox_1'), {
                addEvent: function(value, test) { // Should use the event listeners
                    update(value, 'add');
                },
                removeEvent: function(value) { // Should use the event listeners
                    update(value, 'remove');
                },
                availableTitle: "Source Options",
                selectedTitle: "Destination Options",
                addButtonText: "<i class='flaticon2-next'></i>",
                removeButtonText: "<i class='flaticon2-back'></i>",
                addAllButtonText: "<i class='flaticon2-fast-next'></i>",
                removeAllButtonText: "<i class='flaticon2-fast-back'></i>",
            });
        });

    </script>
@endsection
