@extends('guest', ['title'  => __('Register')])

@section('content')
<section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="login-brand text-center mb-3">
                    <img src="{{ asset('logo.png') }}" alt="logo" style="width: 150px;" class="">
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h5 class="mb-0">Register</h5>
                    </div>
                    <div class="card-body">
                        @error('error')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                        @enderror
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name">
                                @error('name')
                                <div class="invalid-feedback" style="display: block;">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                                @error('email')
                                <div class="invalid-feedback" style="display: block;">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password" class="d-block">Password</label>
                                <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" placeholder="Password">
                                @error('password')
                                <div class="invalid-feedback" style="display: block;">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password2" class="d-block">Password Confirmation</label>
                                <input id="password2" type="password" class="form-control" name="password_confirmation" placeholder="Password Confirmation">
                                @error('password_confirmation')
                                <div class="invalid-feedback" style="display: block;">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                                    <label class="custom-control-label" for="agree">I agree with the <a href="{{ route('terms') }}">terms and conditions</a></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Register
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mt-3 text-muted text-center">
                    Already have account? <a href="{{ route('login') }}">Login</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('js')
<script>
$('form').on('submit', function(e) {
    $('button').addClass('disabled', true).attr('disabled', true)
})

</script>
@endpush
