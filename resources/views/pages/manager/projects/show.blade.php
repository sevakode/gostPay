{{-- Extends layout --}}
@extends('pages.manager.dashboard')

{{-- Content --}}
@section('content-widget')

    @include('pages.manager.projects.navbar.header')

    <div class="card card-custom gutter-b">
        <div class="card-body p-0">
            <!-- begin: Invoice-->
            <!-- begin: Invoice header-->
            <div class="row justify-content-center py-8 px-8 py-md-27 px-md-0">
                <div class="col-md-10">
                    <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                        <h1 class="display-4 font-weight-boldest mb-10">ИНФОРМАЦИЯ ПРОЕКТА</h1>
                        <div class="d-flex flex-column align-items-md-end px-0">
                            <!--begin::Logo-->
                            <a href="#" class="mb-5">
                                <h4 class="text-dark">{{ $project->name }}</h4>
                            </a>
                            <!--end::Logo-->
                            <span class="d-flex flex-column align-items-md-end opacity-70">
                                <span>{{ request()->user()->company->name }}</span>
                                <span><a  href="{{ route('projects.edit', $project->slug) }}">Изменить</a></span>
                            </span>
                        </div>
                    </div>
            </div>
            <!-- begin: Invoice footer-->
            <div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0 mx-0">
                <div class="col-md-10">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="font-weight-bold text-muted text-uppercase">КОЛИЧСЕТВО ПОЛЬЗОВАТЕЛЕЙ ПРОЕКТА</th>
                                <th class="font-weight-bold text-muted text-uppercase">КОЛИЧСЕТВО КАРТ ПРОЕКТА</th>
                                <th class="font-weight-bold text-muted text-uppercase">РАССХОД</th>
                                <th class="font-weight-bold text-muted text-uppercase">ДОХОД</th>
                                <th class="font-weight-bold text-muted text-uppercase text-right">ИТОГО</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="font-weight-bolder">
                                <td>{{ $project->users()->count() }}</td>
                                <td>{{ $project->cards()->count() }}</td>
                                <td>{{ $project->getAmountAllCards().'p' }}</td>
                                <td>{{ '0p' }}</td>
                                <td class="text-primary font-size-h3 font-weight-boldest text-right">{{ $project->getAmountAllCards().'p' }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end: Invoice footer-->
            <!-- begin: Invoice action-->
        </div>
    </div>
    </div>
    <div class="card card-custom gutter-b">
        @include('pages.manager.projects.widgets.cards-table', ['searchUser' => true, 'slug' => $project->slug])
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/pages/crud/ktdatatable/base/html-table.js') }}" type="text/javascript"></script>
@endsection
