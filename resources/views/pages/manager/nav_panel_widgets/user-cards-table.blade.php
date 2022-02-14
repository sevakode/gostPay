

<div class="card-header flex-wrap border-0 pt-6 pb-0">
    <div class="card-title">
        <h3 class="card-label">Карты
            <div class="text-muted pt-2 font-size-sm">{{ request()->user()->company->name }}</div>
        </h3>
    </div>

    <div class="card-title">
        <h6 id="amount-all-cards"></h6>
    </div>

</div>
<div class="card-body">
    <!--begin: Search Form-->
    <!--begin::Search Form-->
    <div class="mb-7">
        <div class="row align-items-center">
            <div class="col-lg-6 col-xl-5">
                <div class="row align-items-center">
                    <div class="col-md-6 my-2 my-md-0">
                        <div class="input-icon">
                            <input type="text" class="form-control" placeholder="Search..." id="add_cards_datatable_search_query"/>
                            <span><i class="flaticon2-search-1 text-muted"></i></span>
                        </div>
                    </div>
                    <div class="col-md-5 my-2 my-md-0">
                        <div class="d-flex align-items-center">
                            <label class="mr-3 mb-0 d-none d-md-block">Статус:</label>
                            <select class="form-control" id="add_cards_datatable_search_status">
                                <option value="{{ \App\Models\Bank\Card::ACTIVE }}">Активные</option>
                                <option value="{{ \App\Models\Bank\Card::PENDING }}">В процессе</option>
                                <option value="{{ \App\Models\Bank\Card::CLOSE }}">Зыкрытые</option>
                                <option value="">Все</option>
                            </select>
                        </div>
                    </div>
                    @isset($searchUser)
                        <div class="col-md-4 my-2 my-md-0">
                            <div class="d-flex align-items-center">
                                <label class="mr-3 mb-0 d-none d-md-block">Пользователь:</label>
                                <select class="form-control" id="add_cards_datatable_search_type">
                                    <option value="">All</option>
                                    @foreach(request()->user()->company->users()->get() as $user)
                                        <option value="{{ $user->id }}">{{ $user->fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endisset
                </div>
            </div>

            <div class="col-lg-4 col-md-9 col-sm-12">
                <div class="input-daterange input-group" id="kt_datepicker_5">
                    <input type="text" id="date-start" class="form-control" name="start">
                    <input type="text" id="date-end" class="form-control" name="end">
                </div>
            </div>

            <div class="col-lg-1 col-xl-1 text-center" style="padding-left: 0px; padding-right: 0px;">
                <div id="checkbox-parameter" class="dropdown dropdown-inline d-none">
                    <a href="javascript:;" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" data-toggle="dropdown">
                    <span class="svg-icon svg-icon-md">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="svg-icon">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"></path>
                                <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"></path>
                            </g>
                        </svg>
                    </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <ul class="navi flex-column navi-hover py-2">
                            <li class="navi-header font-weight-bolder text-uppercase font-size-xs text-primary pb-2">
                                Выберите действие:
                            </li>
                            @if(\Illuminate\Support\Facades\Route::is('profile_cards') and
                    request()->user()->hasPermission(\App\Interfaces\OptionsPermissions::ACCESS_TO_REMOVE_CARDS['slug']) or
        request()->user()->hasPermission(\App\Interfaces\OptionsPermissions::ADMIN_ROLE_SET['slug']))
                                <li class="navi-item">
                                    <a href="#" id="remove-cards" class="navi-link disabled">
                                        <span class="navi-icon"><i class="flaticon2-reply text-muted"></i></span>
                                        <span class="navi-text">Отвязать</span>
                                    </a>
                                </li>
                            @endif
                            @if(\Illuminate\Support\Facades\Route::is('profile_cards') and
    request()->user()->hasPermission(\App\Interfaces\OptionsPermissions::ACCESS_TO_CLOSE_CARDS['slug']) or
    request()->user()->hasPermission(\App\Interfaces\OptionsPermissions::ADMIN_ROLE_SET['slug']))
                                <li class="navi-item">
                                    <a href="#" data-toggle="modal" data-target="#close-cards-remove-modal" class="navi-link disabled">
                                        <span class="navi-icon"><i class="flaticon2-delete text-danger"></i></span>
                                        <span class="navi-text">Закрыть</span>
                                    </a>
                                </li>
                            @endif
                            @if(
    request()->user()->hasPermission(\App\Interfaces\OptionsPermissions::OWNER['slug']))
                                <li class="navi-item">
                                    <a href="#" data-toggle="modal" data-target="#close-cards-modal" class="navi-link disabled">
                                        <span class="navi-icon"><i class="far fa-file-excel text-danger"></i></span>
                                        <span class="navi-text">Подать заявку на закрытие</span>
                                    </a>
                                </li>
                            @endif
                            @if(
                        request()->user()->hasPermission(\App\Interfaces\OptionsPermissions::ADMIN_ROLE_SET['slug'])
                            )
                                <li class="navi-item">
                                    <a href="#" data-toggle="modal" data-target="#set-cards-limit-modal" class="navi-link disabled"
                                       id="set_limit_cards">
                                        <span class="navi-icon"><i class="fas fa-sliders-h text-primary"></i></span>
                                        <span class="navi-text">Установить лимит</span>
                                    </a>
                                </li>
                            @endif
                            @if(\Illuminate\Support\Facades\Route::is('profile_cards') or
    request()->user()->hasPermission(\App\Interfaces\OptionsPermissions::ADMIN_ROLE_SET['slug']))
                                <li class="navi-item">
                                    <a href="#" id="download-cards-txt" class="navi-link disabled">
                                        <span class="navi-icon"><i class="flaticon-doc text-warning"></i></span>
                                        <span class="navi-text">Скачать</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-1 col-xl-1 text-left" id="note_button_dropdown" style="display: none;">
                <span class="dropdown-notes dropdown dropleft dropdown-inline">
                    <button id="notes_card" class="dropdown-notes-button btn
                            btn-hover-light-warning btn-warning font-weight-bold btn-md flaticon-notes"
                            type="button" style="display: none;"></button>
                    <div class="dropdown-menu dropdown-menu-xl">
                        <div class="card card-custom" style="font-weight: 200;">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <span>Заметки</span>
                                    <span id="ql_note_create"
                                          class="ml-1 navi-icon text-hover-dark-50">
                                    <i class="la la-plus-circle text-hover-success text-success"></i>
                                </span>
                                </h3>

                                <button type="button"  id="close-dropdown-notes" class="close"
                                        data-dismiss="modal" aria-label="Close">
                                    <i aria-hidden="true" class="ki ki-close"></i>
                                </button>
                            </div>
                            <div class="card-body">
                                <div id="kt_notes_message" style="height: 100px"></div>
                                <div id="ql_footer"
                                     class="d-flex justify-content-between flex-md-row"
                                     style="border-width: 0 1px 1px 1px;
                                          color: #aaa;
                                          padding: 5px 15px;
                                          ">
                                </div>

                                <div id="kt_notes_list"></div>

                            </div>
                        </div>
                    </div>
                </span>
            </div>
        </div>
    </div>
    <div class="modal fade" id="close-cards-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Подать заявку на закрытие карт</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    Вы уверены что хотите Подать заявку на закрытие карт?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">
                        Закрыть
                    </button>
                    <button type="button" id="close-cards" class="btn btn-primary font-weight-bold" data-dismiss="modal">
                        Да
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="set-cards-limit-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Установление лимитного остатка</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-custom gutter-b">
                        <div class="card-body">
                            <div class="form-group row mb-6">
                                <label class="col-form-label text-right col-lg-3 col-sm-12">Установить лимит</label>
                                <div class="col-lg-8 col-md-12 col-sm-12">
                                    <div class="row align-items-center">
                                        <div class="col-4">
                                            <input type="text" class="form-control" id="kt_nouislider_limit_card_input" placeholder="Quantity"/>
                                        </div>
                                        <div class="col-8">
                                            <div id="kt_nouislider_limit_card" class="nouislider-drag-danger"></div>
                                        </div>
                                    </div>
                                </div>
{{--                                <div class="row">--}}
{{--                                    <div class="col-lg-9 ml-lg-auto">--}}
{{--                                        <button type="button" class="btn btn-primary" id="edit_spend_limit">--}}
{{--                                            Добавить--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">
                        Закрыть
                    </button>
                    <button type="button" id="set_limit_cards_button" class="btn btn-primary font-weight-bold" data-dismiss="modal">
                        Изменить
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="close-cards-remove-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Закрытие карт</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    Вы уверены что хотите закрыть карты?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">
                        Закрыть
                    </button>
                    <button type="button" id="close-cards-remove" class="btn btn-primary font-weight-bold" data-dismiss="modal">
                        Да
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!--end::Search Form-->
    <!--end: Search Form-->
    <!--begin: Datatable-->
    <table class="datatable datatable-bordered datatable-head-custom" id="add_cards_datatable">
    </table>
    <!--end: Datatable-->
</div>


@section('scripts_next')
    <script>
        let dropdownClass = $('.dropdown-notes');
        let dropdownButtonClass = $('.dropdown-notes-button');
        let closeButton = $('#close-dropdown-notes.close');
        dropdownButtonClass.on('click', function () {
            dropdownButtonClass.dropdown('toggle');
        });
        $('body').on('click', function (e) {
            let isTapModal = $(e.target).parents('.dropdown-notes').length;
            let isCloseButton = closeButton.is(e.target) || $(e.target).parents('#close-dropdown-notes.close').length;

            if (!isTapModal || (isTapModal && isCloseButton)) {
                dropdownButtonClass.dropdown('hide');
                statusDropdown = 0;
            }
        });
    </script>
    @if(
   // $card->bank()->first()->isApiOfContract(\App\Classes\BankContract\CardLimitContract::class) and
(\Illuminate\Support\Facades\Auth::user()->hasPermission(\App\Interfaces\OptionsPermissions::ADMIN_ROLE_SET['slug']) or
\Illuminate\Support\Facades\Route::is('card')))
        <script>
            var sliderLimitCard = document.getElementById('kt_nouislider_limit_card');

            noUiSlider.create(sliderLimitCard, {
                start: [ {{ 0 }} ],
                step: 1,
                range: {
                    'min': [ 0 ],
                    'max': [ {{ request()->user()->balance()->getSum() }} ]
                },
                format: wNumb({
                    decimals: 0
                })
            });

            // init slider input
            var sliderLimitCardInput = document.getElementById('kt_nouislider_limit_card_input');

            sliderLimitCard.noUiSlider.on('update', function( values, handle ) {
                sliderLimitCardInput.value = values[handle];
            });

            sliderLimitCardInput.addEventListener('change', function(){
                sliderLimitCard.noUiSlider.set(this.value);
            });
        </script>
    @endif
    <script>
        Quill.register('modules/footer', function(quill, options) {
            let editMessageId = false;
            let toolbar_note = $('.ql-toolbar');
            let body_note = $('#kt_notes_message');
            let footer_note = $('#ql_footer');
            let note_create_note = $('#ql_note_create');
            let footer_send_note = $(`
                        <span id="ql_footer_send"
                              class="navi-icon text-hover-success text-light-success
                              align-items-md-end">
                            <i class="la la-send"></i>
                        </span>`);
            let footer_close_note = $(`
                        <span id="ql_footer_close"
                              class="navi-icon text-hover-light text-hover-dark-50
                              align-items-md-start">
                            <i class="la la-times-circle text-danger"></i>
                        </span>`);

            if (options.close) {
                footer_note.append(footer_close_note);
            }
            if (options.send) {
                footer_note.append(footer_send_note);
            }
            if(options.hidden) {
                toolbar_note.hide();
                body_note.hide();
                footer_close_note.hide();
                footer_send_note.hide();
            }
            footer_close_note.on('click', function () {
                toolbar_note.hide();
                body_note.hide();
                footer_close_note.hide();
                footer_send_note.hide();
                quill.container.firstChild.textContent = '';
                quill.setContents({"ops": [{"insert": ""}]});

                quill.message_id = undefined;

                note_create_note.show();
            });
            footer_send_note.on('click', function () {
                toolbar_note.hide();
                body_note.hide();
                footer_close_note.hide();
                footer_send_note.hide();

                note_create_note.show();
            });
            note_create_note.on('click', function () {
                toolbar_note.show();
                body_note.show();
                footer_close_note.show();
                footer_send_note.show();

                note_create_note.hide();
            });
        });
        let toolbarSnow = [
            ['bold', 'italic', 'underline', 'strike'],
            ['blockquote'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
        ];
        let optionsSnow = {
            modules: {
                toolbar: {
                    container: toolbarSnow,
                },
                footer: {
                    send: true,
                    close: true,
                    create: true,
                    hidden: true
                },
            },
            placeholder: '...',
            theme: 'snow', // or 'bubble'
        };
        const quill = new Quill('#kt_notes_message', optionsSnow);
        function dialog_note_open(card_id) {
            let optionsReadOnly = {
                modules: {
                    toolbar: false,
                    // keyboard: false,
                },
                readOnly: true,
                placeholder: '' ,
                theme: 'bubble' // or 'bubble'
            };
            var datatable_notes = $('#kt_notes_list').KTDatatable({
                data: {
                    saveState: true,
                    type: 'remote',
                    source: {
                        read: {
                            url: '{{ asset('') }}' + 'datatables/card-notes/' + card_id,
                            method: 'POST',
                            contentType: 'application/json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            timeout: 60000,
                            map: function map(raw) {

                                datatable_notes.setDataSourceParam('query', {})
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
                    height: 300,
                    header: false,
                    footer: false,
                },
                toolbar: {
                    layout: {}
                },
                rows: {
                    autoHide: false,
                    afterTemplate: function (row, data, index) {
                        let message = new Quill('div[data-message-id="' + data.id + '"]', optionsReadOnly)
                        message.setContents(data.ops, 'api')
                    },
                },
                sortable: false,
                pagination: false,
                columns: [
                    {
                        field: 'insert',
                        title: '',
                        template: function template(row) {
                            let note_message = '<div class="kt_note_message" data-message-id="' + row.id + '" ' +
                                'id="note_message_' + row.id + '"></div>';
                            let items_status_me = 'start';
                            let side_me = 'left';
                            let color_me = 'bg-light-success';
                            let style_me = '';
                            let edit_is_me = ''
                            let del_is_me = ''
                            if (row.is_me) {
                                items_status_me = 'end';
                                side_me = 'right';
                                color_me = '';
                                style_me = 'background-color: #ffd67e;';
                                edit_is_me = '<i class="text-dark-75 text-left text-hover-primary align-items-start ml-1 mr-1 edit-note-message" ' +
                                    'style="font-size: 0.9rem !important;">edit</i>'
                                del_is_me = '<i class="text-danger text-hover-primary ml-1 mr-5 delete-note-message" ' +
                                    'style="font-size: 0.9rem !important;">del</i>';
                            }
                            @if(request()->user()->hasPermissionTo(App\Interfaces\OptionsPermissions::ADMIN_ROLE_SET['slug']))
                                del_is_me = '<i class="text-danger text-hover-primary ml-1 mr-5 delete-note-message" ' +
                                'style="font-size: 0.9rem !important;">del</i>';
                            @endif
                                return `
                            <style>
                                /*.ql-editor {padding: 0px 15px 12px 15px;}*/
                            </style>
                            <div class="d-flex flex-column align-items-` + items_status_me + `">
                                <div class="d-flex align-items-left">
<!--                                    <div class="symbol symbol-circle symbol-40 mr-3">-->
<!--                                        <img alt="Pic" src="/metronic/theme/html/demo1/dist/assets/media/users/300_12.jpg">-->
<!--                                    </div>-->
                                    <div>
                                        <a href="{{ route('dashboard') }}/user/` + row.user_id + `/cards"
                                        class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">
                                            ` + row.full_name + `
                                        </a>

                                        <span class="text-muted font-size-sm">` + row.created_at + `</span>
                                    </div>
                                </div>

                                <div class="rounded ` + color_me + ` text-dark-50 font-weight-bold font-size-lg text-` + side_me + ` max-w-300px"
                                        style="` + style_me + `">
                                    ` + note_message + `
                                </div>

                                <span class="d-flex text-left align-items-start" data-message-id="` + row.id + `">
                                    ` + edit_is_me + `
                                    ` + del_is_me + `
                                </span>


                            </div>`;
                        }
                    },

                ],
            });

            quill.enable();
        }
        function dialog_note_close() {
            quill.disable();
            quill.off();
            if ($('div#kt_notes_list.datatable.datatable-default').length) {
                $('#kt_notes_list').KTDatatable().destroy()
            }
        }
        window.addEventListener('load', function () {
            function dialog_note_open(card_id) {
                let optionsReadOnly = {
                    modules: {
                        toolbar: false,
                    },
                    readOnly: true,
                    placeholder: '' ,
                    theme: 'bubble'
                };
                var datatable_notes = $('#kt_notes_list').KTDatatable({
                    data: {
                        saveState: true,
                        type: 'remote',
                        source: {
                            read: {
                                url: '{{ asset('') }}' + 'datatables/card-notes/' + card_id,
                                method: 'POST',
                                contentType: 'application/json',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                timeout: 60000,
                                map: function map(raw) {

                                    datatable_notes.setDataSourceParam('query', {})
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
                        height: 300,
                        header: false,
                        footer: false,
                    },
                    toolbar: {
                        layout: {}
                    },
                    rows: {
                        autoHide: false,
                        afterTemplate: function (row, data, index) {
                            let message = new Quill('div[data-message-id="' + data.id + '"]', optionsReadOnly)
                            message.setContents(data.ops, 'api')
                        },
                    },
                    sortable: false,
                    pagination: false,
                    columns: [
                        {
                            field: 'insert',
                            title: '',
                            template: function template(row) {
                                let note_message = '<div class="kt_note_message" data-message-id="' + row.id + '" ' +
                                    'id="note_message_' + row.id + '"></div>';
                                let items_status_me = 'start';
                                let side_me = 'left';
                                let color_me = 'bg-light-success';
                                let style_me = '';
                                let edit_is_me = ''
                                let del_is_me = ''
                                if (row.is_me) {
                                    items_status_me = 'end';
                                    side_me = 'right';
                                    color_me = '';
                                    style_me = 'background-color: #ffd67e;';
                                    edit_is_me = '<i class="text-dark-75 text-left text-hover-primary align-items-start ml-1 mr-1 edit-note-message" ' +
                                        'style="font-size: 0.9rem !important;">edit</i>'
                                    del_is_me = '<i class="text-danger text-hover-primary ml-1 mr-5 delete-note-message" ' +
                                        'style="font-size: 0.9rem !important;">del</i>';
                                }
                                @if(request()->user()->hasPermissionTo(App\Interfaces\OptionsPermissions::ADMIN_ROLE_SET['slug']))
                                    del_is_me = '<i class="text-danger text-hover-primary ml-1 mr-5 delete-note-message" ' +
                                    'style="font-size: 0.9rem !important;">del</i>';
                                @endif
                                    return `
                            <style>
                                /*.ql-editor {padding: 0px 15px 12px 15px;}*/
                            </style>
                            <div class="d-flex flex-column align-items-` + items_status_me + `">
                                <div class="d-flex align-items-left">
<!--                                    <div class="symbol symbol-circle symbol-40 mr-3">-->
<!--                                        <img alt="Pic" src="/metronic/theme/html/demo1/dist/assets/media/users/300_12.jpg">-->
<!--                                    </div>-->
                                    <div>
                                        <a href="{{ route('dashboard') }}/user/` + row.user_id + `/cards"
                                        class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">
                                            ` + row.full_name + `
                                        </a>

                                        <span class="text-muted font-size-sm">` + row.created_at + `</span>
                                    </div>
                                </div>

                                <div class="rounded ` + color_me + ` text-dark-50 font-weight-bold font-size-lg text-` + side_me + ` max-w-300px"
                                        style="` + style_me + `">
                                    ` + note_message + `
                                </div>

                                <span class="d-flex text-left align-items-start" data-message-id="` + row.id + `">
                                    ` + edit_is_me + `
                                    ` + del_is_me + `
                                </span>


                            </div>`;
                            }
                        },

                    ],
                });

                quill.enable();
                // quill.on();
            }
            var datatable = $('#add_cards_datatable').KTDatatable({
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            url: '{{ route('datatables.user-cards') }}',
                            method: 'POST',
                            contentType: 'application/json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            params: {
                                id: {{ $user->id }},
                                access_cards: {{ $access_cards ?? '0' }},
                            },
                            timeout: 60000,
                            map: function map(raw) {
                                datatable.setDataSourceParam('query.listCartForAdding', '');
                                datatable.setDataSourceParam('query.countCards', '');
                                // datatable.setDataSourceParam('query.closeCards', '');

                                var dataSet = raw;
                                if (typeof raw.data !== 'undefined') {
                                    dataSet = raw.data;
                                }

                                if(typeof $('#amount-all-cards') !== 'undefined'){
                                    $('#amount-all-cards').html('Всего: ' + raw.amountAll)
                                }

                                if (typeof slider !== 'undefined') {
                                    if(raw.countCardsNoUser >= 0){
                                        slider.noUiSlider.options.range.max = raw.countCardsNoUser;
                                        slider.noUiSlider.updateOptions.length = raw.countCardsNoUser;
                                        slider.noUiSlider.updateOptions('max', raw.countCardsNoUser);
                                    }
                                }

                                return dataSet;
                            }
                        }
                    },
                    pageSize: 10,
                    serverPaging: true,
                    serverFiltering: true,
                    serverSorting: true,
                },

                sortable: true,
                pagination: true,
                search: {
                    input: $('#add_cards_datatable_search_query'),
                    key: 'generalSearch'
                },
                layout: {
                    scroll: true,
                },
                rows: {
                    autoHide: false,
                    afterTemplate: function (row, data, index) {
                        $('.event_click_checkbox').on('click', function () {
                            var status_check = 0;
                            let checkboxes = $('input[name="checkboxes"]:checked');
                            let notes_card = $('#notes_card');
                            let note_button_dropdown = $('#note_button_dropdown');

                            if (checkboxes.length) {
                                status_check = 1;
                            }
                            if (checkboxes.length === 1) {
                                dialog_note_open(checkboxes.val());
                                note_button_dropdown.show();
                                notes_card.show();
                            }
                            else {
                                dialog_note_close()
                                note_button_dropdown.hide()
                                notes_card.hide()
                            }

                            if (status_check) {
                                $('#checkbox-parameter').removeClass('d-none');
                            } else {
                                $('#checkbox-parameter').addClass('d-none');
                            }
                        });

                    }
                },

                columns: [
                    {
                        field: 'id',
                        title: '<label class="checkbox event_click_checkbox">' +
                            '<input  id="check_all" type="checkbox" value="" name="checkboxes"/>' +
                            '<span></span>' +
                            '</label>',
                        width: 20,
                        sortable: false,
                        template: function template(row) {
                            return '<label class="checkbox event_click_checkbox">'+
                                '<input class="check_cards" type="checkbox" value="'+row.id+'" name="checkboxes"/>'+
                                '<span></span>'+
                                '</label>'
                        }
                    },
                    {
                        field: 'number',
                        title: 'Номер карты',
                        template: function template(row) {
                            if (row.state === '{{ \App\Models\Bank\Card::ACTIVE }}') {
                                color = 'text-success';
                            }
                            else if (row.state === '{{ \App\Models\Bank\Card::PENDING }}') {
                                color = 'text-light-danger';
                            }
                            else {
                                color = 'text-danger';
                            }

                            return '<a class="text-dark" href="'+ row.numberLink +'">'+ row.number +'</a><span class="'+
                                color +' ">*</span>';
                        }
                    },
                    {
                        field: 'user',
                        title: 'Пользователь',
                        template: function template(row) {
                            if(row.user !== 'none') {
                                return '<a class="text-dark" href="'+ row.userLink +'">'+ row.user +'</a>'
                            }
                            else {
                                return row.user
                            }
                        }
                    },
                    {
                        field: 'project',
                        title: 'Проект',
                    },
                    {
                        field: 'amount',
                        title: 'Сумма платежей',
                    },
                    {
                        field: 'issue_at',
                        title: 'Дата выдачи',
                    },
                ],
            });

            $('#check_all').on('click', function () {
                $(".check_cards").prop('checked', this.checked);
            });

            $('#add_cards_datatable_search_status').on('change', function () {
                datatable.search($(this).val().toLowerCase(), 'state');
            });
            $('#add_cards_datatable_search_type').on('change', function () {
                datatable.search($(this).val().toLowerCase(), 'Type');
            });
            $('#add_cards_datatable_search_status, #add_cards_datatable_search_type').selectpicker();

            $('#adding_random_cards').on('click', function () {
                datatable.setDataSourceParam('query.removeCards', '');
                datatable.setDataSourceParam('query.downloadCardsTxt', '');

                if (sliderInput.value > 0) {
                    datatable.search({
                        "count": sliderInput.value,
                        "project": $('#selectpicker_random_project').val(),
                        "account_id": $('#selectpicker_random_invoice').val()
                    }, 'countCards');
                }
                datatable.setDataSourceParam('query.countCards', '')
                sliderInput.value = 0;
            });

            $('#adding_cards').on('click', function () {
                datatable.setDataSourceParam('query.removeCards', '');
                datatable.setDataSourceParam('query.downloadCardsTxt', '');
                datatable.setDataSourceParam('query.countCards', '');
                datatable.search({
                    "cards": $('#kt_select2_3').select2('data'),
                    "project": $('#selectpicker_project').val()
                }, 'listCartForAdding');
                $('#kt_select2_3').val(null).trigger('change');
                datatable.setDataSourceParam('query.listCartForAdding', '');
            });

            $('#remove-cards').on('click', function () {
                datatable.setDataSourceParam('query.listCartForAdding', '');
                var checkboxes_value = [];
                $('input[name="checkboxes"]').each(function(){
                    if(this.checked) {
                        checkboxes_value.push($(this).val());
                    }
                });
                checkboxes_value = checkboxes_value.toString();
                datatable.search(checkboxes_value, 'removeCards');
                datatable.setDataSourceParam('query.removeCards', '');
            });

            $('#close-cards').on('click', function () {
                datatable.setDataSourceParam('query.listCartForAdding', '');
                var checkboxes_value = [];
                $('input[name="checkboxes"]').each(function(){
                    if(this.checked) {
                        checkboxes_value.push($(this).val());
                    }
                });
                checkboxes_value = checkboxes_value.toString();
                datatable.search(checkboxes_value, 'closeCards');
                datatable.setDataSourceParam('query.closeCards', '');
            });

            $('#close-cards-remove').on('click', function () {
                datatable.setDataSourceParam('query.listCartForAdding', '');
                var checkboxes_value = [];
                $('input[name="checkboxes"]').each(function(){
                    if(this.checked) {
                        checkboxes_value.push($(this).val());
                    }
                });
                checkboxes_value = checkboxes_value.toString();
                datatable.search(checkboxes_value, 'closeCardsRemove');
                datatable.setDataSourceParam('query.closeCardsRemove', '');
            });

            $('#download-cards-txt').on('click', function () {
                var checkboxes_value = [];
                $('input[name="checkboxes"]').each(function(){
                    //if($(this).is(":checked")) {
                    if(this.checked) {
                        checkboxes_value.push($(this).val());
                    }
                });

                $.ajax({
                    type:'post',
                    url:'{{ route('cards.download.txt') }}',
                    data:{
                        '_token':$('meta[name="csrf-token"]').attr('content'),
                        'cards': checkboxes_value,
                        'id': {{ $user->id }}
                    },
                    success: function(t) {
                        if(t) {
                            var link = document.createElement('a');
                            link.setAttribute('href', t);
                            link.setAttribute('download', 'download.txt');
                            link.click();
                        }
                        return false;
                    },
                });
            });

            $('#kt_datepicker_5').datepicker().on('changeDate', function(e) {
                datatable.setDataSourceParam('query.listCartForAdding', '');
                datatable.setDataSourceParam('query.removeCards', '');
                datatable.setDataSourceParam('query.downloadCardsTxt', '');
                datatable.setDataSourceParam('query.countCards', '');

                date_start = $("#date-start").val();
                date_end = $("#date-end").val();

                date = {
                    'start': date_start,
                    'end': date_end
                };
                datatable.search(date, 'date');
            });

            $('#set_limit_cards_button').on('click', function () {
                datatable.setDataSourceParam('query.listCartForAdding', '');
                let checkboxes_value = [];
                $('input[name="checkboxes"]').each(function(){
                    if(this.checked) {
                        checkboxes_value.push($(this).val());
                    }
                });
                checkboxes_value = checkboxes_value.toString();
                datatable.setDataSourceParam('query.amountLimit', document.getElementById('kt_nouislider_limit_card_input').value);
                datatable.search(checkboxes_value, 'listCardForSetLimit');
            });
        });
        function editNote(messageId, innerHtml = '...')
        {
            $('.ql-toolbar').show();
            $('#kt_notes_message').show();
            $('#ql_footer_close').show();
            $("#ql_footer_send").show();

            quill.message_id = messageId;
            quill.container.firstChild.innerHTML = innerHtml;

            $('#ql_note_create').hide();
        }

        $('#ql_footer_send').on('click', function () {
            $('#kt_notes_list').KTDatatable().setDataSourceParam('query', {});

            if (quill.container.textContent) {
                if(quill.message_id) {
                    $('#kt_notes_list').KTDatatable().setDataSourceParam('query.messageEdit', {
                        id: quill.message_id,
                        contents: quill.getContents(),
                    });
                    quill.message_id = undefined;
                } else {
                    $('#kt_notes_list').KTDatatable().setDataSourceParam('query.messageCreate', {
                        contents: quill.getContents(),
                    });
                }

                quill.container.firstChild.textContent = '';
                quill.setContents({"ops": [{"insert": ""}]});

                $('#kt_notes_list').KTDatatable().load();
            }
        });
        $(document).on('click', '.edit-note-message', function () {

            let item = $(event.target).parent();
            let messageId = item.data('message-id');
            let objectNote = $('#note_message_'+messageId);

            editNote(messageId, objectNote.children().html());
        });
        $(document).on('click', '.delete-note-message', function () {
            $('#kt_notes_list').KTDatatable().setDataSourceParam('query', {});

            let item = $(event.target).parent();
            let messageId = item.data('message-id');

            $('#kt_notes_list').KTDatatable().setDataSourceParam('query.messageDelete', {
                id: messageId
            });
            $('#kt_notes_list').KTDatatable().load();
        });
        let timing = false;
        function realTimeDatatable() {
            if($('span.dropdown-notes.show').length) {
                $('#kt_notes_list').KTDatatable().load();
            }
            if(!timing) {
                timing = setTimeout(realTimeDatatable, 10000);
            }
        }

        $('span.dropdown-notes').on('click',  function () {
            realTimeDatatable()
        });
    </script>
    <script>
        var arrows = {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
        var demos = function () {
            $('#kt_datepicker_5').datepicker({
                rtl: KTUtil.isRTL(),
                todayHighlight: true,
                templates: arrows
            });
        };
    </script>
    <script>
        $('.event_click_checkbox').on('click', function () {
            var status_check = 0;
            $('input[name="checkboxes"]').each(function () {
                //if($(this).is(":checked")) {
                if (this.checked) {
                    status_check = 1;
                }
            });
            if (status_check) {
                $('#checkbox-parameter').removeClass('d-none');
            } else {
                $('#checkbox-parameter').addClass('d-none');
            }
        });
    </script>
@endsection


