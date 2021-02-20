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
            <script src="{{ asset($script) }}" type="text/javascript"></script>
        @endforeach


        @foreach (Metronic::initScripts() as $script) <script src="{{asset($script)}}"></script> @endforeach


        <script type="text/javascript">
            console.log('dadasd');
        </script>
        {{-- Includable JS --}}
        @yield('scripts')
        @stack('scripts')

    </body>

@endsection
