@include('parts.header_home')
<main>
    @include('widgets.errors')
    @yield('content')
</main>
@include('parts.footer')
