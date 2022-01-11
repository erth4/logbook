@extends('guest', ['title' => __('Forgot Password')])

@section('content')
<section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-5 mx-auto">
                <div class="login-brand text-center mb-3">
                    <img src="{{ asset('logo.png') }}" alt="logo" style="width: 150px;" class="text-center">
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h5 class="mb-0">{{ __('Forgot Password') }}</h5>
                    </div>
                    <div class="card-body">
                        @if(session()->has('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif
                        @error('error')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                        @enderror

                        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" tabindex="1" required autofocus>
                                @error('email')
                                <div class="invalid-feedback" style="display: block;">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block" tabindex="4">
                                    {{ __('Email Password Reset Link') }}
                                </button>
                            </div>
                        </form>
                    </div>
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
