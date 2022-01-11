@extends('layout')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h5>Ubah Log Book</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @error('error')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
                    <form method="post" action="{{ route('logbook.update') }}">
                        @csrf
                        {!! eform_hidden('id', $logbook['id']) !!}
                        <div class="form-group">
                            {!! eform_select('Status', 'status', $status, $logbook['id_status']) !!}
                            @error('status')
                            <div class="invalid-feedback" style="display: block;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! eform_input('text', 'Kegiatan dan Lokasi KP', 'description', $logbook['description']) !!}
                            @error('description')
                            <div class="invalid-feedback" style="display: block;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-4">
                                    {!! eform_input('text', 'Waktu Pelaksanaan', 'execution_date', date('Y-m-d', strtotime($logbook['execution_date']))) !!}
                                    @error('execution_date')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    {!! eform_input('text', 'Dari Jam', 'start_time', date('H:i', strtotime($logbook['start_time']))) !!}
                                    @error('execution_date')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    {!! eform_input('text', 'Sampai Jam', 'end_time', date('H:i', strtotime($logbook['end_time']))) !!}
                                    @error('execution_date')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! eform_area('Hasil', 'results', $logbook['results'], '5') !!}
                            @error('results')
                            <div class="invalid-feedback" style="display: block;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! eform_area('Kendala, Rencana Perubahan (Jika ada)', 'constraint', $logbook['constraint'], '5', '') !!}
                        </div>
                        <div>
                            <a href="{{ route('logbook') }}?status={{ session('status') }}" class="btn btn-danger">Kembali</a>
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
$('#execution_date').datepicker({
    format: "yyyy-mm-dd",
    autoclose: true
})

$('#start_time, #end_time').clockpicker({
    // placement: 'top',
    align: 'left',
    donetext: 'Done'
});

$('form').on('submit', function(e) {
    $('a, button').addClass('disabled', true).attr('disabled', true)
})

</script>
@endpush
