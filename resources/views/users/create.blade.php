@extends('layout')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <h5>Tambah User</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    @error('error')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
                    <form method="post" action="{{ route('users.store') }}">
                        @csrf
                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control" name="role" required>
                                <option value="">Role</option>
                                @foreach($roles as $value)
                                    <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                                @endforeach
                            </select>
                            @error('role')
                            <div class="invalid-feedback" style="display: block;">
                                {{ $message }}
                            </div>
                            @enderror 
                        </div>

                        <div class="form-group">
                            {!! eform_input('text', 'Name', 'name', old('name')) !!}
                            @error('name')
                            <div class="invalid-feedback" style="display: block;">
                                {{ $message }}
                            </div>
                            @enderror 
                        </div>

                        <div class="form-group">
                            {!! eform_input('text', 'Identity Number', 'identity_number', old('identity_number')) !!}
                            @error('identity_number')
                            <div class="invalid-feedback" style="display: block;">
                                {{ $message }}
                            </div>
                            @enderror 
                        </div>

                        <div class="form-group">
                            {!! eform_input('email', 'Email', 'email', old('email')) !!}
                            @error('email')
                            <div class="invalid-feedback" style="display: block;">
                                {{ $message }}
                            </div>
                            @enderror 
                        </div>

                        <div class="form-group">
                            {!! eform_input('text', 'Phone', 'phone', old('phone')) !!}
                            @error('phone')
                            <div class="invalid-feedback" style="display: block;">
                                {{ $message }}
                            </div>
                            @enderror 
                        </div>

                        <div class="form-group">
                            {!! eform_input('text', 'Address', 'address', old('address'), '', '') !!}
                            @error('address')
                            <div class="invalid-feedback" style="display: block;">
                                {{ $message }}
                            </div>
                            @enderror 
                        </div>

                        <div class="form-group">
                            {!! eform_input('text', 'Dosen Pembimbing KP', 'dosen_pembimbing', old('dosen_pembimbing'), '') !!}
                            @error('dosen_pembimbing')
                            <div class="invalid-feedback" style="display: block;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! eform_input('text', 'Dosen Pengampu Kelas KP', 'dosen_kp', old('dosen_kp'), '') !!}
                            @error('dosen_kp')
                            <div class="invalid-feedback" style="display: block;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! eform_input('text', 'Pembimbing Lapangan', 'dosen_lap', old('dosen_lap'), '') !!}
                            @error('dosen_lap')
                            <div class="invalid-feedback" style="display: block;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            {!! eform_input('password', 'Password', 'password') !!}
                            @error('password')
                            <div class="invalid-feedback" style="display: block;">
                                {{ $message }}
                            </div>
                            @enderror 
                        </div>

                        <div class="form-group">
                            {!! eform_input('password', 'Password Confirmation', 'password_confirmation') !!}
                            @error('password_confirmation')
                            <div class="invalid-feedback" style="display: block;">
                                {{ $message }}
                            </div>
                            @enderror 
                        </div>

                        <div>
                            <a href="{{ route('users') }}" class="btn btn-danger">
                                Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Simpan
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