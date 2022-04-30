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
                <h1 class="m-0">Due Bill List</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card p-3">
            <table id="connections" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Connection ID</th>
                        <th>Applicant Name</th>
                        <th>Due Amount</th>
                        <th>Month & Year</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($item->cid); ?></td>
                        <td><?php echo e($item->appname); ?></td>
                        <td><?php echo e($item->amount); ?></td>
                        <td><?php echo e($item->billmonth); ?> <?php echo e($item->billyear); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</section>



<script>
    $(document).ready(function() {
        $('#connections').DataTable();
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\class\versity project for students\electribill\resources\views/admin/duebills.blade.php ENDPATH**/ ?>