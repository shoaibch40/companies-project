<!doctype html>
<html>
<head>
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>@yield('pageTitle')</title>
    @include('layouts.css_file')
</head>
<body>

    <div>
        @include('layouts.header')
    </div>
    <div class="content">
        @yield('content')
    </div>
    <footer class="row">
        @include('layouts.footer')
    </footer>
    @include('layouts.js_file')
</body>
</html>
