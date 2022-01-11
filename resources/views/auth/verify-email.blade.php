@extends('guest', ['title' => __('Verifiy Email')])
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
                        <h5 class="mb-0">{{ __('Verifiy Email') }}</h5>
                    </div>
                    <div class="card-body">
                        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}

                        @if(session('status') == 'verification-link-sent')
                            <div class="mb-3 mt-3 alert alert-success">
                                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                            </div>
                        @endif
                        <div class="d-flex justify-content-between mt-2">
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf
                                <button type="submit" class="btn btn-primary" tabindex="4">
                                    {{ __('Resend Verification Email') }}
                                </button>
                            </form>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit" class="btn btn-danger">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                            
                        </div>
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