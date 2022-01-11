<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ __('Register') }} - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css?v=' . microtime(true)) }}">
    <link rel="icon" href="{{ asset('logo.png') }}">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="login-brand text-center mb-3">
                            <img src="{{ asset('logo.png') }}" alt="logo" style="width: 150px;" class="">
                        </div>
                        <div class="card card-primary">
                            <div class="card-header">
                                <h5 class="mb-0">Syarat dan Ketentuan</h5>
                            </div>
                            <div class="card-body">
                            Dengan mengakses situs web ini, Anda setuju untuk terikat dengan Syarat dan Ketentuan Penggunaan situs web ini, 
                            semua hukum dan peraturan yang berlaku, dan setuju bahwa Anda bertanggung jawab untuk mematuhi hukum setempat yang berlaku. 
                            Jika Anda tidak setuju dengan persyaratan ini, Anda dilarang menggunakan atau mengakses situs ini.

                            </div>
                        </div>

                        <div class="simple-footer mt-3 text-center">
                            Copyright &copy; <a href="{{ route('home') }}">{{ config('app.name') }}</a> {{ date('Y') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }} "></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
</body>

</html>
