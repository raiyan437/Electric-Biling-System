<?php $__env->startSection('content'); ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10">
                <?php if(session('success')): ?>
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <?php echo e(session('success')); ?>

                    </div>
                 <?php elseif(session('failed')): ?>
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <?php echo e(session('failed')); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Customer Dashboard</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-6">
                <h2>WELCOME TO <span style="font-size: 2.2rem">Electr<span style="font-size: 2.8rem;color: red;font-weight: bold">i</span>Bill</span> SYSTEM</h2>
            </div>
        </div>
    </div>
</section>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\class\versity project for students\electribill\resources\views/customer/dashboard.blade.php ENDPATH**/ ?>