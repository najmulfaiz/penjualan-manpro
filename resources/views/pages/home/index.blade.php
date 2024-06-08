@extends('layouts.master')

@section('title') Dashboard @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Dashboard @endslot
        @slot('title') Dashboard @endslot
    @endcomponent

    @include('layouts.alert')

    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">

                            <div class="d-flex flex-wrap">
                                <div class="me-3">
                                    <p class="text-muted mb-2">Total Produk</p>
                                    <h3 class="mb-0 fw-bold">{{ rand(10, 100) }}</h3>
                                </div>

                                <div class="avatar-sm ms-auto">
                                    <div class="avatar-title bg-light rounded-circle text-primary font-size-24">
                                        <i class="bx bx-package"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card blog-stats-wid">
                        <div class="card-body">

                            <div class="d-flex flex-wrap">
                                <div class="me-3">
                                    <p class="text-muted mb-2">Total Penjualan Bulan Ini</p>
                                    <h3 class="mb-0 fw-bold">Rp{{ number_format(rand(1000000, 10000000), 2, ',', '.') }}</h3>
                                </div>

                                <div class="avatar-sm ms-auto">
                                    <div class="avatar-title bg-light rounded-circle text-primary font-size-24">
                                        <i class="bx bx-archive-in"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card blog-stats-wid">
                        <div class="card-body">
                            <div class="d-flex flex-wrap">
                                <div class="me-3">
                                    <p class="text-muted mb-2">Total Pembelian Bulan Ini</p>
                                    <h3 class="mb-0 fw-bold">Rp{{ number_format(rand(1000000, 10000000), 2, ',', '.') }}</h3>
                                </div>

                                <div class="avatar-sm ms-auto">
                                    <div class="avatar-title bg-light rounded-circle text-primary font-size-24">
                                        <i class="bx bx-archive-out"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
