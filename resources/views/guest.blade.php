<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ $title ? $title . ' - ' . config('app.name') : config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css?v=' . microtime(true)) }}">
    <link rel="icon" href="{{ asset('logo.png') }}">
</head>

<body>
    <div id="app">
        @yield('content')
        <div class="simple-footer text-center mt-3">
            Copyright &copy; <a href="{{ route('home') }}">{{ config('app.name') }}</a> {{ date('Y') }}
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }} "></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    @stack('js')
</body>

</html>
