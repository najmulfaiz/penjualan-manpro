@extends('layouts.master')

@section('title') Produk @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Produk @endslot
        @slot('title') Lihat Produk @endslot
    @endcomponent

    @include('layouts.alert')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-transparent border-bottom">
                    <h4 class="card-title my-2">Detail</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <td class="fit-column">Nama Produk</td>
                            <td class="fit-column">:</td>
                            <td class="fw-bold">{{ $produk->name }}</td>
                        </tr>
                        <tr>
                            <td class="fit-column">Harga</td>
                            <td class="fit-column">:</td>
                            <td class="fw-bold">{{ $produk->harga }}</td>
                        </tr>
                        <tr>
                            <td class="fit-column">Satuan</td>
                            <td class="fit-column">:</td>
                            <td class="fw-bold">{{ $produk->satuan->name }}</td>
                        </tr>
                        <tr>
                            <td class="fit-column">Stok</td>
                            <td class="fit-column">:</td>
                            <td class="fw-bold">{{ $produk->stock }}</td>
                        </tr>
                        <tr>
                            <td class="fit-column">Deskripsi</td>
                            <td class="fit-column">:</td>
                            <td class="fw-bold">{{ $produk->deskripsi }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-transparent border-bottom">
                    <h4 class="card-title my-2">Arus Stok</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap mb-0" id="produkDatatable">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Satuan</th>
                                    <th>Stok</th>
                                    <th>Harga</th>
                                    <th>Status</th>
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
var produkDatatable = $('#produkDatatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('produk.index') }}',
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
                data: 'satuan.name',
                name: 'satuan.name',
                defaultContent: '-'
            },
            {
                data: 'stock',
                name: 'stock',
                defaultContent: '-'
            },
            {
                data: 'harga',
                name: 'harga',
                defaultContent: '-',
                render: function ( data, type, full, meta ) {
                    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(data);
                }
            },
            {
                data: 'status',
                name: 'status',
                defaultContent: '-',
                className: 'text-center fit-column',
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
                    url: '{{ url('produk') }}/' + id,
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

                        produkDatatable.ajax.reload();
                    }
                });
            }
        });
    });
</script>
@endsection
