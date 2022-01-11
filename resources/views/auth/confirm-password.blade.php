@extends('guest', ['title' => __('Confirm Password')])

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
                        <h5 class="mb-0">{{ __('Confirm Password') }}</h5>
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

                        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}

                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf

                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label">Password</label>
                                </div>
                                <input id="password" type="password" class="form-control" name="password" placeholder="Password" tabindex="2" required>
                                @error('password')
                                <div class="invalid-feedback" style="display: block;">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block" tabindex="4">
                                    {{ __('Confirm') }}
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
