
<!DOCTYPE html>
<html lang="en">
    @include('partials.head')
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    @yield('content')
                </main>
            </div>
            @include('partials.footer')
        </div>
        @include('partials.scripts')
        @yield('scripts')        
    </body>
</html>
