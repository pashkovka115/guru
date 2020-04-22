@include('parts.header_main')
<main>
    @include('widgets.errors')
    @yield('content')
</main>
@include('parts.footer')
