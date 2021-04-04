@extends('pages.profile.default')

@section('navbar')
    @include('pages.profile.navbar.show')
@endsection

@section('asides_end')
    @include('pages.manager.navbar')
@endsection

{{-- Content --}}
@section('content_profile')
    <div class="flex-row-fluid ml-lg-8">
        <div class="card card-custom gutter-b">
            @include('pages.manager.nav_panel_widgets.user-cards-table',  compact('user'))
        </div>
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <div class="form-group row mb-6">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Добавить конкретные карты</label>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <select class="form-control select2" id="kt_select2_3" name="param" multiple="multiple"></select>
                    </div>
                    <div class="row">
                        <div class="col-lg-9 ml-lg-auto">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddCardsModal">
                                Добавить
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="AddCardsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Открыть карты</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-form-label text-right col-lg-3 col-sm-12">Проект</label>
                            <div class="col-lg-8 col-md-8 col-sm-12">
                                <div class="dropdown bootstrap-select form-control dropup">
                                    <select class="form-control selectpicker"
                                            id="selectpicker_project"
                                            data-size="12"
                                            data-live-search="true"
                                            tabindex="null">
                                        <option value="">Select</option>
                                        @foreach(request()->user()->company->projects()->get() as $project)
                                            <option value="{{$project->slug}}">{{ $project->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="dropdown-menu" style="max-height: 343px; overflow: hidden;">
                                        <div class="bs-searchbox">
                                            <input type="search" class="form-control"
                                                   autocomplete="off"
                                                   role="combobox"
                                                   aria-label="Search"
                                                   aria-controls="bs-select-6"
                                                   aria-autocomplete="list"
                                                   aria-activedescendant="bs-select-6-236">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="reset" data-dismiss="modal" id="adding_cards" class="btn btn-primary mr-2">Добавить</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <div class="form-group row mb-6">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Свободные карты</label>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="row align-items-center">
                            <div class="col-4">
                                <input type="text" class="form-control" id="kt_nouislider_1_input"  placeholder="Quantity"/>
                            </div>
                            <div class="col-8">
                                <div id="kt_nouislider_1" class="nouislider-drag-danger"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-9 ml-lg-auto">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddCardsRandomModal">
                                Добавить
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="AddCardsRandomModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Открыть карты</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-form-label text-right col-lg-3 col-sm-12">Проект</label>
                            <div class="col-lg-8 col-md-8 col-sm-12">
                                <div class="dropdown bootstrap-select form-control dropup">
                                    <select class="form-control selectpicker"
                                            id="selectpicker_random_project"
                                            data-size="12"
                                            data-live-search="true"
                                            tabindex="null">
                                        <option value="">Select</option>
                                        @foreach(request()->user()->company->projects()->get() as $project)
                                            <option value="{{$project->slug}}">{{ $project->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="dropdown-menu" style="max-height: 343px; overflow: hidden;">
                                        <div class="bs-searchbox">
                                            <input type="search" class="form-control"
                                                   autocomplete="off"
                                                   role="combobox"
                                                   aria-label="Search"
                                                   aria-controls="bs-select-6"
                                                   aria-autocomplete="list"
                                                   aria-activedescendant="bs-select-6-236">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="reset" data-dismiss="modal" id="adding_random_cards" class="btn btn-primary mr-2">Добавить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts_push')
    @if(\Illuminate\Support\Facades\Auth::user()
            ->hasPermission(\App\Interfaces\OptionsPermissions::ACCESS_TO_ADD_CARDS['slug']))
    <script>
        var slider = document.getElementById('kt_nouislider_1');

        noUiSlider.create(slider, {
            start: [ 0 ],
            step: 1,
            range: {
                'min': [ 0 ],
                'max': [ {{ \Illuminate\Support\Facades\Auth::user()->company->cards()->free()->count() }} ]
            },
            format: wNumb({
                decimals: 0
            })
        });

        // init slider input
        var sliderInput = document.getElementById('kt_nouislider_1_input');

        slider.noUiSlider.on('update', function( values, handle ) {
            sliderInput.value = values[handle];
        });

        sliderInput.addEventListener('change', function(){
            slider.noUiSlider.set(this.value);
        });
    </script>
    <script>
        $("#kt_select2_3").select2({
        placeholder: "Поиск свободных карт",
        allowClear: true,
        ajax: {
            url: "{{route('datatables.select-add-cards')}}",
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
    @endif
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/pages/custom/profile/profile.js') }}" type="text/javascript"></script>
    @yield('scripts_next')
@endpush
