<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('dashboard.admin.layout.partials.head')
</head>

<body>
    <div class="wrapper">
        <div class="preloader"></div>

        @include('dashboard.admin.layout.partials.header')

        <main>
            @yield('content')
        </main>
    </div>

    @include('dashboard.admin.layout.partials.footer_script')

    @yield('scripts')

</body>

</html>
