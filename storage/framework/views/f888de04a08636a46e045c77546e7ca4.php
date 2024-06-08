<?php $__env->startSection('title'); ?> Satuan <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?> Satuan <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?> Ubah Satuan <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <?php echo $__env->make('layouts.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-lg-4 col-xs-12">
            <div class="card">
                <form action="<?php echo e(route('satuan.update', $satuan->id)); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="name">Question</label>
                            <input type="text" class="form-control" name="name" id="name"
                                value="<?php echo e(old('name', $satuan->name)); ?>">
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="<?php echo e(route('satuan.index')); ?>" class="btn btn-secondary btn-sm">Kembali</a>
                        <button class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\sites\penjualan\resources\views/pages/satuan/edit.blade.php ENDPATH**/ ?>