
<!DOCTYPE html>
<html lang="en">
    @include('partials.head')
    <body class="sb-nav-fixed">
        @include('partials.navigation')
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                @include('partials.sidebar')
            </div>
            <div id="layoutSidenav_content">
                <main>
                    @yield('content')
                </main>
                @include('partials.footer')
            </div>
        </div>
        @include('partials.scripts')
        @yield('scripts')
    </body>
</html>
