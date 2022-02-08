<div class="tab-pane fade show pt-3 pr-5 mr-n5" id="{{ $id }}" role="tabpanel">
    <div class="navi navi-icon-circle navi-spacer-x-0 " id="kt_notify_cards">
    </div>
</div>

@push('scripts')
    <script>
        var is_new_notify_cards = false;

        let datatable_notify = $('#kt_notify_cards').KTDatatable({
            data: {
                saveState: true,
                type: 'remote',
                source: {
                    read: {
                        url: '{{ route('notify.cards.user.index') }}',
                        method: 'GET',
                        contentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        timeout: 60000,
                        map: function map(raw) {

                            datatable_notify.setDataSourceParam('query', {})
                            var dataSet = raw;
                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;
                            }
                            return dataSet;
                        }
                    }
                },
                serverPaging: false,
                serverFiltering: false,
                serverSorting: false
            },
            layout: {
                scroll: true,
                // height: 300,
                header: false,
                footer: false,
            },
            toolbar: {
                layout: {}
            },
            rows: {
                autoHide: false,
            },
            sortable: false,
            pagination: false,
            columns: [
                {
                    field: 'insert',
                    title: '',
                    template: function template(row) {
                        let badge = '';
                        if (!row.read_at) {
                            badge = '<i class="symbol-badge bg-success"></i>';
                        }

                        return `
                           <div class="d-flex align-items-center flex-wrap mb-5">
                                <div class="symbol symbol-50 symbol-light mr-5">
                            <span class="symbol-label"
                             style="background-image:url('` + row.image + `')"
                            >
                            ` + badge + `
                        </span>
                            </div>
                            <div class="d-flex flex-column flex-grow-1 mr-2">
                                <a href="#" class="font-weight-bolder text-dark-75 text-hover-primary font-size-lg mb-1">
` + row.title + `
                                    </a>
                                    <span class="text-muted font-weight-bold">` + row.message + `</span>
                                    <span class="text-muted">` + row.created_at + `</span>
                                </div>
                            </div>`;
                    }
                },

            ],
        });


        function refreshNewNotify() {
            $.ajax({
                type: 'get',
                url: '{{ route('notify.cards.user.info') }}',
                dataType: "json",
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (data) {
                    if (data.new_count) {
                        if (! is_new_notify_cards) {
                            $('#kt_quick_panel_toggle_pulse_ring').show()
                            $('#button_kt_quick_panel_notifications_badge').show()
                            is_new_notify_cards = true;
                        }
                    } else {
                        if (!is_new_notify_cards) {
                            $('#kt_quick_panel_toggle_pulse_ring').hide()
                            $('#button_kt_quick_panel_notifications_badge').hide()
                        }
                    }
                },
                error: function (data) {

                }
            });
        }

        function realTimeNotifyCards() {
            refreshNewNotify();
            setTimeout(realTimeNotifyCards, 6000);
        }
        realTimeNotifyCards();

        var timing_for_notify_cards = false;

        function realTimeDatatable() {
            let is_active_panel = $('#kt_quick_panel.offcanvas.offcanvas-on').length;
            let is_active_page_cards = $('#button_kt_quick_panel_notifications.nav-link.active').length;
            if (is_active_panel && is_active_page_cards) {
                $('#kt_notify_cards').KTDatatable().load();
                setTimeout(realTimeDatatable, 10000)
            } else {
                clearTimeout(timing_for_notify_cards)
                timing_for_notify_cards = false;
            }
            return timing_for_notify_cards;
        }

        $('#button_kt_quick_panel_notifications').on('click', function () {
            if (!timing_for_notify_cards) {
                if (is_new_notify_cards) {
                    $('#kt_notify_cards').KTDatatable().load();
                }
                $('#kt_quick_panel_toggle_pulse_ring').hide();
                $('#button_kt_quick_panel_notifications_badge').hide();
                is_new_notify_cards = false;
                timing_for_notify_cards = setTimeout(realTimeDatatable, 20000);
            }
        });
        $('#kt_quick_panel_toggle').on('click', function () {
            let is_active_page_cards = $('#button_kt_quick_panel_notifications.nav-link.active').length;
            if (!timing_for_notify_cards && is_active_page_cards) {
                if (is_new_notify_cards) {
                    $('#kt_notify_cards').KTDatatable().load();
                }
                $('#kt_quick_panel_toggle_pulse_ring').hide()
                $('#button_kt_quick_panel_notifications_badge').hide()
                is_new_notify_cards = false;
                timing_for_notify_cards = setTimeout(realTimeDatatable, 20000);
            }
        });
    </script>
@endpush
