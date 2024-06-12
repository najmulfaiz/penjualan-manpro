@extends('layouts.master')

@section('title')
    Penjualan
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Penjualan
        @endslot
        @slot('title')
            Tambah Penjualan
        @endslot
    @endcomponent

    @include('layouts.alert')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('penjualan.store') }}" method="post" enctype="multipart/form-data" id="form_transaksi">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-bordered align-middle" id="table_transaksi">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Produk</th>
                                            <th style="width: 6%;">Stock</th>
                                            <th style="width: 15%;">Harga</th>
                                            <th style="width: 6%;">Qty</th>
                                            <th style="width: 15%;">Total</th>
                                            <th style="width: 5%;" class="text-center">
                                                <button type="button" class="btn btn-primary btn-sm" onclick="addRow();"><i class="bx bx-plus"></i></button>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <div class="col-lg-4 col-xs-12">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group mb-3">
                                            <label for="diskon_persen">Diskon Persen</label>
                                            <input type="number" class="form-control" name="diskon_global_persen" id="diskon_global_persen"
                                                value="{{ old('diskon_persen') }}">
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="form-group mb-3">
                                            <label for="diskon_rp">Diskon Rp.</label>
                                            <input type="number" class="form-control" name="diskon_global_rupiah" id="diskon_global_rupiah"
                                                value="{{ old('diskon_rp') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 border-top border-bottom py-3">
                                <h2 class="fw-bold mb-0">Jumlah Total : <span id="jumlah_total_text">Rp 0,00</span></h2>
                                <input type="hidden" name="total_global" id="total_global">
                            </div>
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
    $(document).ready(function() {
        addRow();
    });

    $('#supplier').select2({
        ajax: {
            url: '{{ route('supplier.select2') }}',
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

    function initProductSelect2(el) {
        el.select2({
            ajax: {
                url: '{{ route('produk.select2') }}',
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
        }).on("select2:select", function(e) {
            var data = $(this).select2('data');
            var select_id    = data[0]['element']['parentElement']['id'];
            var key          = select_id.split('_').pop();
            var selectedData = data[0]['data'];

            $('#harga_' + key).val(selectedData['harga']);
            $('#stock_' + key).val(selectedData['sisa_stok']);
        });
    }

    $(document).on('keyup', '#diskon_global_persen', function() {
        var jumlah_total = 0;
        $.each($('.total'), function(k, v) {
            jumlah_total += parseFloat($(v).val()) || 0;
        });

        var diskon_global_persen = parseFloat($('#diskon_global_persen').val()) || 0;
        var diskon_global_rupiah = (jumlah_total) * (diskon_global_persen / 100);
        $('#diskon_global_rupiah').val(diskon_global_rupiah);

        hitungJumlahTotal();
    });

    $(document).on('keyup', '.qty, .harga, #diskon_global_rupiah', function() {
        hitungJumlahTotal();
    });

    $(document).on('keyup', '#diskon_global_rupiah', function() {
        $('#diskon_global_persen').val('');
    });

    $(document).on('keyup', '.qty', function() {
        var key = ($(this).attr('id')).split('_').pop();
        var stock = parseFloat($('#stock_' + key).val()) || 0;
        var qty = parseFloat($('#qty_' + key).val()) || 0;

        if(qty > stock) {
            alert('Qty melebihi stock');
            $(this).val(stock);
            hitungJumlahTotal();
            return;
        }

        if(qty < 0) {
            alert('Qty kurang dari 0');
            $(this).val(0);
            hitungJumlahTotal();
            return;
        }
    });

    function hitungJumlahTotal() {
        var jumlah_total = 0;
        $.each($('.harga'), function(k, v) {
            var key = ($(v).attr('id')).split('_').pop();
            var harga = parseFloat($('#harga_' + key).val()) || 0;
            var qty = parseFloat($('#qty_' + key).val()) || 0;
            var total = harga * qty;

            $('#total_' + key).val(total);
            jumlah_total += total;
        });

        var diskon_global_rupiah = parseFloat($('#diskon_global_rupiah').val()) || 0;;
        jumlah_total = jumlah_total - diskon_global_rupiah;

        $('#diskon_global_rupiah').val(diskon_global_rupiah);
        $('#jumlah_total_text').text(new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(jumlah_total));
        $('#total_global').val(jumlah_total);
    }

    function addRow() {
        var key = Math.random().toString(20).substr(2, 5);
        var row = '<tr>'+
                        '<td>'+
                            '<select class="form-select produk" name="produk[]" id="produk_' + key + '" data-placeholder="Pilih produk">'+
                                '<option></option>'+
                            '</select>'+
                        '</td>'+
                        '<td>'+
                            '<input type="text" class="form-control stock" id="stock_' + key + '" name="stock[]" readonly />'+
                        '</td>'+
                        '<td>'+
                            '<div class="input-group">'+
                                '<span class="input-group-text">Rp</span>'+
                                '<input type="text" class="form-control harga" id="harga_' + key + '" name="harga[]" />'+
                            '</div>'+
                        '</td>'+
                        '<td>'+
                            '<input type="text" class="form-control qty" id="qty_' + key + '" name="qty[]" />'+
                        '</td>'+
                        '<td>'+
                            '<div class="input-group">'+
                                '<span class="input-group-text">Rp</span>'+
                                '<input type="text" class="form-control total" id="total_' + key + '" name="total[]" readonly />'+
                            '</div>'+
                        '</td>'+
                        '<td class="text-center">'+
                            '<button type="button" class="btn btn-danger btn-sm btn-remove" data-key="' + key + '"><i class="bx bx-trash"></i></button>'+
                        '</td>'+
                    '</tr>';

        $('#table_transaksi tbody').append(row);
        initProductSelect2($('.produk:last'));
    }

    $(document).on('click', '.btn-remove', function() {
        var index = $('.btn-remove').index(this);
        $('#table_transaksi tbody tr:eq(' + index + ')').remove();
    });

    $(document).on('submit', '#form_transaksi', function(e) {
        e.preventDefault();

        $.ajax({
            url: '{{ url('penjualan') }}',
            type: 'post',
            dataType: 'json',
            data: $(this).serialize(),
            success: function(res) {
                if(res.isError) {
                    toastr['error'](res.message);
                } else {
                    toastr['success'](res.message);
                }

                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            }
        });
    });
</script>
@endsection
