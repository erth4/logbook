@extends('layout')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <h5>Log Book</h5>
        </div>
        <div class="col-lg-4">
            <div class="pull-right mb-2">
                <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">
                    Tambah User
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @error('error')
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 1%;">No</th>
                                    <th>Name</th>
                                    <th style="width: 15%;">Email</th>
                                    <th style="width: 8%;">Phone</th>
                                    <th style="width: 15%;">Address</th>
                                    <th style="width: 10%;">Role</th>
                                    <th style="width: 12%;">Activated at</th>
                                    <th style="width: 12%;">Created at</th>
                                    <th style="width: 7%;">Action</th>
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
        var konfirm = confirm("Anda yakin akan menghapus user ini?")
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
                    alert(error.responseJSON.message)
                }
            })
        } else {
            return false
        }
    }
    var table = $('.table').DataTable({
        ordering: false,
        serverSide: true,
        ajax: {
            url: `{{ route('users.list') }}`,
            type: 'post',
        },
        columns: [
            { "data": "no", sClass:"text-center" },
            { "data": "name" },
            { "data": "email" },
            { "data": "phone" },
            { "data": "address" },
            { "data": "role_name" },
            { "data": null, sClass:"text-center", render:function(data, type, row, meta) {
                return `<a href="${data.activation}">${data.status}</a>`;
            } },
            { "data": "created_at", sClass: "text-center" },
            { "data": null, sClass:"text-center", render: function(data, type, row, meta) {
                return `
                        <a class="btn btn-sm btn-success" href="${data.edit}"><i class="fa fa-edit"></i></a>
                        <a class="btn btn-sm btn-danger" onclick="btnDelete('${data.delete}','${data.id}')"><i class="fa fa-trash"></i></a>
                    `
            } },
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
</script>
@endpush
