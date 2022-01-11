@extends('layout')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <h5>Log Book</h5>
        </div>
        <div class="col-lg-4">
            <div class="pull-right mb-2">
                <a href="{{ route('logbook.create') }}" class="btn btn-sm btn-primary">
                    Tambah Logbook
                </a>
                <a href="{{ route('logbook.export', 'excel') }}?status={{ session('status') }}" target="_blank" class="btn btn-sm btn-success">
                    Export Excel
                </a>
                <a href="{{ route('logbook.export', 'pdf') }}?status={{ session('status') }}" target="_blank" class="btn btn-sm btn-danger">
                    Export PDF
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <select id="status" class="form-control">
                        <option value="0">Semua</option>
                        @foreach ($status as $value)
                            <option value="{{ $value['id'] }}" {{ (session('status') == $value['id']) ? 'selected' : '' }}>{{ $value['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="card-body">
                   
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 2%;">No</th>
                                    <th style="width: 20%;">Kegiatan dan Lokasi KP</th>
                                    <th style="width: 10%;">Waktu Pelaksanaan</th>
                                    <th style="width: 7%;">Jam</th>
                                    <th>Hasil</th>
                                    <th style="width: 20%;">Kendala, Rencana Perubahan (Jika ada)</th>
                                    <th style="width: 7%;">Opsi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
function btnDelete(url, id) {
    var konfirm = confirm("Anda yakin akan menghapus data ini?")
    if (konfirm) {
        $.ajax({
            url: url,
            type: 'post',
            data: {
                id: id
            },
            dataType: 'json',
            success:function(res) {
                if(res.status == 'success') {
                    window.location.reload()
                }
            },
            error: function(error) {
            }
        })
    } else {
        return false
    }
}

var table = $('.table').DataTable({
    ordering: false,
    serverSide: true,
    processing: true,
    // fixedHeader: true,
    responsive: true,
    stateSave: true,
    ajax: {
        url: "{{ route('logbook.json') }}",
        type: 'post',
        data: {
            status: $('#status').val()
        }
    },
    columns: [
        { "data": "no", sClass: "text-center" },
        { "data": "description" },
        { "data": "execution_date" },
        { "data": "time", sClass:"text-center" },
        { "data": "results" },
        { "data": "constraint" },
        {
            "data": null,
            sClass: "text-center",
            render: function(data, type, row, meta) {
                return `
                        <a class="btn btn-sm btn-success" href="${data.edit}"><i class="fa fa-edit"></i></a>
                        <a class="btn btn-sm btn-danger" onclick="btnDelete('${data.delete}','${data.id}')"><i class="fa fa-trash"></i></a>
                    `
            }
        },
    ],
    initComplete: function() {
        var api = this.api();
        $("input[type='search']")
            .off(".DT")
            .on("keyup.DT, blur", function(e) {
                if (e.keyCode === 13) {
                    api.search(this.value).draw();
                }
            });
    },
})

$("input[type='search']").attr('placeholder', 'Press Enter to search')

$("#status").on('change', function() {
    window.location.href = `{{ route('logbook') }}?status=${$('#status').val()}`
})

</script>
@endpush
