@if( env('APP_ENV') !== 'dev')
    <script src="{{ mix('js/manifest.js') }}" defer></script>
    <script src="{{ mix('js/vendor.js') }}" defer></script>
@endif
    <script src="{{ asset('js/polyfills.min.js') }}" defer></script>
