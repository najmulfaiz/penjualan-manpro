@extends('layouts.master')

@section('title') Arus Stok @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Arus Stok @endslot
        @slot('title') Arus Stok @endslot
    @endcomponent

    @include('layouts.alert')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-nowrap mb-0" id="arusStokDatatable">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Waktu</th>
                                    <th>Transaksi</th>
                                    <th>Produk</th>
                                    <th>Masuk</th>
                                    <th>Keluar</th>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment-with-locales.min.js" integrity="sha512-4F1cxYdMiAW98oomSLaygEwmCnIP38pb4Kx70yQYqRwLVCs3DbRumfBq82T08g/4LJ/smbFGFpmeFlQgoDccgg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        var arusStokDatatable = $('#arusStokDatatable').DataTable({
            lengthChange: !1,
            buttons:["copy","excel","pdf","colvis"],
            dom: 'Bfrtip',
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('arus_stok.index') }}',
                data: function(d) { }
            },
            order: [[ 1, "desc" ]],
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
                    data: 'created_at',
                    name: 'created_at',
                    className: 'text-center fit-column',
                    render: function (data, type, row, meta) {
                        return moment(data).format('DD-MM-YYYY HH:mm:ss');
                    }

                },
                {
                    data: 'transaksi',
                    name: 'transaksi',
                    defaultContent: '-'
                },
                {
                    data: 'produk.name',
                    name: 'produk.name',
                    defaultContent: '-'
                },
                {
                    data: 'masuk',
                    name: 'masuk',
                    defaultContent: '-',
                    className: 'text-center fit-column',
                },
                {
                    data: 'keluar',
                    name: 'keluar',
                    defaultContent: '-',
                    className: 'text-center fit-column',
                },
            ]
        }).buttons().container().appendTo("#arusStokDatatable_wrapper .col-md-6:eq(0)");
    });
</script>
@endsection
