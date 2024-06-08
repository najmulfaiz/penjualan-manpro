<?php $__env->startSection('title'); ?>
    Supplier
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Supplier
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Tambah Supplier
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <?php echo $__env->make('layouts.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-lg-4 col-xs-12">
            <div class="card">
                <form action="<?php echo e(route('supplier.store')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" name="name" id="name"
                                value="<?php echo e(old('name')); ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" name="alamat" id="alamat"
                                value="<?php echo e(old('alamat')); ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label for="telepon">Telepon</label>
                            <input type="text" class="form-control" name="telepon" id="telepon"
                                value="<?php echo e(old('telepon')); ?>">
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="<?php echo e(route('supplier.index')); ?>" class="btn btn-secondary btn-sm">Kembali</a>
                        <button class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\sites\penjualan\resources\views/pages/supplier/create.blade.php ENDPATH**/ ?>