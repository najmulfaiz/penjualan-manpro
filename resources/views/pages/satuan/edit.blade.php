@extends('layouts.master')

@section('title') Satuan @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Satuan @endslot
        @slot('title') Ubah Satuan @endslot
    @endcomponent

    @include('layouts.alert')

    <div class="row">
        <div class="col-lg-4 col-xs-12">
            <div class="card">
                <form action="{{ route('satuan.update', $satuan->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" name="name" id="name"
                                value="{{ old('name', $satuan->name) }}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('satuan.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                        <button class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
