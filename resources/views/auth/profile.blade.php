@extends('layout')
@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<h5>Profile</h5>
		</div>
		<div class="col-lg-9">
			<div class="card shadow-sm">
				<div class="card-body">
					@if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
					@error('error')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror

					<form method="post" action="{{ route('profile') }}">
					@csrf

					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								{!! eform_input('text', 'Identity Number', 'identity_number', auth()->user()->identity_number) !!}
								@error('identity_number')
			                    <div class="invalid-feedback" style="display: block;">
			                        {{ $message }}
			                    </div>
			                    @enderror
			                </div>
			            </div>
						<div class="col-lg-6">
							<div class="form-group">
								{!! eform_input('text', 'Name', 'name', auth()->user()->name) !!}
								@error('name')
			                    <div class="invalid-feedback" style="display: block;">
			                        {{ $message }}
			                    </div>
			                    @enderror
			                </div>
			            </div>
						
					</div>

					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								{!! eform_input('text', 'Phone', 'phone', auth()->user()->phone) !!}
								@error('phone')
	                            <div class="invalid-feedback" style="display: block;">
	                                {{ $message }}
	                            </div>
	                            @enderror
	                        </div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								{!! eform_input('text', 'Email', 'email', auth()->user()->email) !!}
								@error('email')
		                        <div class="invalid-feedback" style="display: block;">
		                            {{ $message }}
		                        </div>
		                        @enderror
		                    </div>
						</div>
					</div>

					<div class="form-group">
						{!! eform_area('Address', 'address', auth()->user()->address) !!}
						@error('address')
	                    <div class="invalid-feedback" style="display: block;">
	                        {{ $message }}
	                    </div>
	                    @enderror
	                </div>

	                <div class="form-group">
						{!! eform_area('Title Project', 'title_project', auth()->user()->title_project) !!}
						@error('title_project')
	                    <div class="invalid-feedback" style="display: block;">
	                        {{ $message }}
	                    </div>
	                    @enderror
	                </div>

	                <div class="row">
						<div class="col-lg-4">
							<div class="form-group">
                                {!! eform_input('text', 'Dosen Pembimbing KP', 'dosen_pembimbing', auth()->user()->dosen_pembimbing, '') !!}
								@error('dosen_pembimbing')
	                            <div class="invalid-feedback" style="display: block;">
	                                {{ $message }}
	                            </div>
	                            @enderror
	                        </div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
                                {!! eform_input('text', 'Dosen Pengampu Kelas KP', 'dosen_kp', auth()->user()->dosen_kp, '') !!}
								@error('dosen_kp')
	                            <div class="invalid-feedback" style="display: block;">
	                                {{ $message }}
	                            </div>
	                            @enderror
	                        </div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
                                {!! eform_input('text', 'Pembimbing Lapangan', 'dosen_lap', auth()->user()->dosen_lap, '') !!}
								@error('dosen_lap')
	                            <div class="invalid-feedback" style="display: block;">
	                                {{ $message }}
	                            </div>
	                            @enderror
		                    </div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								{!! eform_input('password', 'Password', 'password', '', '', '') !!}
								@error('password')
	                            <div class="invalid-feedback" style="display: block;">
	                                {{ $message }}
	                            </div>
	                            @enderror
	                        </div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								{!! eform_input('password', 'Password Confirmation', 'password_confirmation', '', '', '') !!}
								@error('password_confirmation')
	                            <div class="invalid-feedback" style="display: block;">
	                                {{ $message }}
	                            </div>
	                            @enderror
	                        </div>
						</div>
					</div>

					<div class="form-group mb-0">
						<button type="submit" class="btn btn-primary">
							Simpan Perubahan
						</button>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@push('js')
<script>
$('form').on('submit', function(e) {
    $('a, button').addClass('disabled', true).attr('disabled', true)
})
</script>
@endpush