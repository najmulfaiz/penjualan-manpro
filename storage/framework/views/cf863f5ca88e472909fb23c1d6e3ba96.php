<?php $__env->startSection('title'); ?> Supplier <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?> Supplier <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?> Supplier <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <?php echo $__env->make('layouts.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <a href="<?php echo e(route('supplier.create')); ?>" class="btn btn-primary btn-sm waves-effect btn-label waves-light">
                        <i class="bx bx-plus label-icon"></i> Tambah
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap mb-0" id="supplierDatatable">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script-bottom'); ?>
<script>
var supplierDatatable = $('#supplierDatatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?php echo e(route('supplier.index')); ?>',
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
                data: 'alamat',
                name: 'alamat',
                defaultContent: '-'
            },
            {
                data: 'telepon',
                name: 'telepon',
                defaultContent: '-'
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
                    url: '<?php echo e(url('supplier')); ?>/' + id,
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

                        supplierDatatable.ajax.reload();
                    }
                });
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\sites\penjualan\resources\views/pages/supplier/index.blade.php ENDPATH**/ ?>