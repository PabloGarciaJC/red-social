@include('layouts.head')
    @guest
        @yield('content')
    @else
        <main class="py-4">
            @include('includes.home.nav')
            @include('includes.home.sidebar')
            @yield('dynamic-content')
        </main>
        @include('includes.home.footer')      
    @endguest
@include('layouts.footer-script')

