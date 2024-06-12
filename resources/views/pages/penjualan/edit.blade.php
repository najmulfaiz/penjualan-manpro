@extends('layouts.master')

@section('title') Penjualan @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Penjualan @endslot
        @slot('title') Ubah Penjualan @endslot
    @endcomponent

    @include('layouts.alert')

    <div class="row">
        <div class="col-lg-6 col-xs-12">
            <div class="card">
                <form action="{{ route('penjualan.update', $penjualan->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="name">Nama Penjualan</label>
                            <input type="text" class="form-control" name="name" id="name"
                                value="{{ old('name', $penjualan->name) }}">
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="harga">Harga</label>
                                    <input type="number" class="form-control" name="harga" id="harga"
                                        value="{{ old('harga', $penjualan->harga) }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="stok">Stok</label>
                                    <input type="number" class="form-control" name="stock" id="stock"
                                        value="{{ old('stock', $penjualan->stock) }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="satuan">Satuan</label>
                            <select class="form-select" name="satuan" id="satuan" data-placeholder="Pilih satuan">
                                <option value="{{ $penjualan->satuan->id }}">{{ $penjualan->satuan->name }}</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3">{{ old('deskripsi', $penjualan->deskripsi) }}</textarea>
                        </div>
                        <div class="form-check form-switch form-switch-lg mb-3">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="true" {{ $penjualan->is_active == 'true' ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Status</label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                        <button class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script-bottom')
<script>
    $('#satuan').select2({
        ajax: {
            url: '{{ route('satuan.select2') }}',
            dataType: 'json',
            data: function (params) {
                return {
                    q: $.trim(params.term)
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
</script>
@endsection
