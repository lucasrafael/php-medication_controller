<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        @include('layouts.head')
    </head>

    <body>
        <nav class="navbar navbar-default navbar-dark bg-dark navbar-fixed-top shadow-px">
            @include('layouts.navbar')
        </nav>
        <div class="container">
            @include('layouts.msg')

            <div class="panel panel-default">
                <div class="panel-heading img-responsive">
                    <h3><span class="@yield('panel-heading-class')"></span>@yield('panel-heading')</h3>
                </div>
                @yield('content')
            </div>

            @yield('panel-button')
        </div>

        <footer class="text-primary">
            @include('layouts.footer')
        </footer>
    </body>
</html>
