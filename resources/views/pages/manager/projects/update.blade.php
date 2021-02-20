{{-- Extends layout --}}
@extends('pages.manager.dashboard')

{{-- Content --}}
@section('content-widget')

    @include('pages.manager.projects.navbar.header')

    <div class="card card-custom">
        @include('pages.manager.projects.widgets.insert', ['route' => route('projects.updating', $project->slug), 'project' => $project])
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/pages/crud/ktdatatable/base/html-table.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/pages/custom/profile/profile.js') }}" type="text/javascript"></script>
@endsection
