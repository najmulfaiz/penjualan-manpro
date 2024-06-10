<?php $__env->startSection('title'); ?>
    Produk
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Produk
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Tambah Produk
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <?php echo $__env->make('layouts.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-lg-6 col-xs-12">
            <div class="card">
                <form action="<?php echo e(route('produk.store')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="name">Nama Produk</label>
                            <input type="text" class="form-control" name="name" id="name"
                                value="<?php echo e(old('name')); ?>">
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="harga">Harga</label>
                                    <input type="number" class="form-control" name="harga" id="harga"
                                        value="<?php echo e(old('harga')); ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="stok">Stok</label>
                                    <input type="number" class="form-control" name="stock" id="stock"
                                        value="<?php echo e(old('stock')); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="satuan">Satuan</label>
                            <select class="form-select" name="satuan" id="satuan" data-placeholder="Pilih satuan">
                                <option></option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3"><?php echo e(old('deskripsi')); ?></textarea>
                        </div>
                        <div class="form-check form-switch form-switch-lg mb-3">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="true">
                            <label class="form-check-label" for="is_active">Status</label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="<?php echo e(route('produk.index')); ?>" class="btn btn-secondary btn-sm">Kembali</a>
                        <button class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script-bottom'); ?>
<script>
    $('#satuan').select2({
        ajax: {
            url: '<?php echo e(route('satuan.select2')); ?>',
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\sites\penjualan\resources\views/pages/produk/create.blade.php ENDPATH**/ ?>