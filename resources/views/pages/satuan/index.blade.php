@extends('layouts.master')

@section('title') Satuan @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Satuan @endslot
        @slot('title') Satuan @endslot
    @endcomponent

    @include('layouts.alert')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('satuan.create') }}" class="btn btn-primary btn-sm waves-effect btn-label waves-light">
                        <i class="bx bx-plus label-icon"></i> Tambah
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap mb-0" id="satuanDatatable">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <!-- end table-responsive -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-bottom')
<script>
var satuanDatatable = $('#satuanDatatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('satuan.index') }}',
            data: function(d) { }
        },
        columns: [
            {
                data: 'id',
                name: 'id',
                className: 'text-center fit-column',
                render: function ( data, type, full, meta ) {
                    return meta.settings._iDisplayStart + (meta.row + 1);
                }
            },
            {
                data: 'name',
                name: 'name',
            },
            {
                data: 'aksi',
                name: 'aksi',
                searchable: false,
                className: 'text-center fit-column',
            },
        ]
    });

    $(document).on('click', '.btn_delete', function() {
        var id = $(this).data('id');

        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data yang telah dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: 'Ya, hapus data!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '{{ url('satuan') }}/' + id,
                    type: 'post',
                    data: {
                        _method: 'DELETE',
                    },
                    dataType: 'json',
                    success: function(res) {
                        if(res.isError) {
                            toastr['error'](res.message);
                        } else {
                            toastr['success'](res.message);
                        }

                        satuanDatatable.ajax.reload();
                    }
                });
            }
        });
    });
</script>
@endsection
