@extends('layouts.master')

@section('title') Supplier @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Supplier @endslot
        @slot('title') Ubah Supplier @endslot
    @endcomponent

    @include('layouts.alert')

    <div class="row">
        <div class="col-lg-4 col-xs-12">
            <div class="card">
                <form action="{{ route('supplier.update', $supplier->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" name="name" id="name"
                                value="{{ old('name', $supplier->name) }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" name="alamat" id="alamat"
                                value="{{ old('alamat', $supplier->alamat) }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="telepon">Telepon</label>
                            <input type="text" class="form-control" name="telepon" id="telepon"
                                value="{{ old('telepon', $supplier->telepon) }}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('supplier.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                        <button class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
