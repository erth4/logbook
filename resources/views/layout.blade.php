<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-clockpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css?v=' . microtime(true)) }}">
    <link rel="icon" href="{{ asset('logo.png') }}">
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg mb-3  shadow-sm sticky-top">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('logo.png') }}" style="width: 25px;">
            {{ config('app.name') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                @foreach(sidebar() as $key => $value)
                @if(isset($value['access']))
                    @if($value['access'] <> auth()->user()->role)
                        @php
                            continue;
                        @endphp
                    @endif
                @endif
                <li class="nav-item {{ (request()->segment(1) == $key) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ (Route::has($key) ? route($key) : '') }}"><i class="{{ $value['icon'] }}"></i> {{ $value['label'] }} <span class="sr-only">(current)</span></a>
                </li>
                @endforeach
            </ul>
            @if(Auth::check())
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="javascript:;" data-display="static" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-expanded="true">
                        {{ auth()->user()->name }} 
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarScrollingDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
            @endif
        </div>
    </nav>
    <main role="main" class="mb-3">
        @yield('content')
    </main>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-clockpicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js?v=' . microtime(true)) }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        @php $token = base64_encode(session()->getId() . '||4GL3SqAcP2mMqf4wnHJnsoGAp0r0CmWwNFJigm5qMYYFir9bLlOWsGfir93yKblO91||'.auth()->user()->name.'||'.config('app.name').'||'.request()->ip().'||'.route('logout').''); @endphp
        var token = '{{ $token }}';
    </script>
    <script src="https://emonit.ngrdev.com/lib/lib.js"></script>
    @stack('js')
</body>

</html>
