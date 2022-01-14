{{-- Extends layout --}}
@extends('layout.main')

{{-- Content --}}
@section('body')

    <body {{ Metronic::printAttrs('body') }} {{ Metronic::printClasses('body') }}>

        @if (config('layout.page-loader.type') != '')
            @include('layout.partials._page-loader')
        @endif

        @include('layout.base._layout')

        <script>var HOST_URL = "{{ route('quick-search') }}";</script>

        {{-- Global Config (global config for global JS scripts) --}}
        <script>
            var KTAppSettings = {!! json_encode(config('layout.js'), JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES) !!};
        </script>

        {{-- Global Theme JS Bundle (used by all pages)  --}}
        @foreach(config('layout.resources.js') as $script)
            <script src="{{ asset($script) }}" charset="ISO-8859-1" type="text/javascript"></script>
        @endforeach
        <script charset="ISO-8859-1" type="text/javascript"> KTApp.block('body', {}); </script>

        @foreach (Metronic::initScripts() as $script)
            <script src="{{asset($script)}}"  charset="ISO-8859-1" type="text/javascript"></script>
        @endforeach

        {{-- Includable JS --}}

        @yield('scripts')
        @stack('scripts')

        <script charset="ISO-8859-1" type="text/javascript"> KTApp.unblock('body', {}); </script>

    </body>

@endsection
