@include('layouts.head')
    @guest
        @yield('content')
    @else
        @include('home.index')
    @endguest
@include('layouts.footer-script')

