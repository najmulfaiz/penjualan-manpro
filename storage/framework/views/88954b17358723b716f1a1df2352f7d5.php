<?php $__env->startSection('title'); ?> Dashboard <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?> Dashboard <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?> Dashboard <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <?php echo $__env->make('layouts.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">

                            <div class="d-flex flex-wrap">
                                <div class="me-3">
                                    <p class="text-muted mb-2">Total Produk</p>
                                    <h3 class="mb-0 fw-bold"><?php echo e(rand(10, 100)); ?></h3>
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
                                    <h3 class="mb-0 fw-bold">Rp<?php echo e(number_format(rand(1000000, 10000000), 2, ',', '.')); ?></h3>
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
                                    <h3 class="mb-0 fw-bold">Rp<?php echo e(number_format(rand(1000000, 10000000), 2, ',', '.')); ?></h3>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\sites\penjualan\resources\views/pages/home/index.blade.php ENDPATH**/ ?>