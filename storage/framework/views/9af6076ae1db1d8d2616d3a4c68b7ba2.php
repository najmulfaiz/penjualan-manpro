<?php if(session('success')): ?>
<div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<?php if(session('warning')): ?>
<div class="alert alert-warning"><?php echo e(session('warning')); ?></div>
<?php endif; ?>

<?php if(session('error')): ?>
<div class="alert alert-danger"><?php echo e(session('danger')); ?></div>
<?php endif; ?>

<?php if(session('errors')): ?>
<div class="alert alert-danger">
    <ul class="mb-0 ps-3">
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php endif; ?>
<?php /**PATH D:\sites\penjualan\resources\views/layouts/alert.blade.php ENDPATH**/ ?>