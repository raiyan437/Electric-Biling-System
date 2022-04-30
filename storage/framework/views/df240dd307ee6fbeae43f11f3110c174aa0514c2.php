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
                <h1 class="m-0">Payment Requests</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container">
        <div class="card p-3">
            <table id="connections" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Connection ID</th>
                        <th>Applicant Name</th>
                        <th>Amount</th>
                        <th>Pay Method</th>
                        <th>Txn ID</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($item->conid); ?></td>
                        <td><?php echo e($item->appname); ?></td>
                        <td><?php echo e($item->amount); ?></td>
                        <td><?php echo e($item->method); ?></td>
                        <td><?php echo e($item->txnid); ?></td>
                        <td><button class="btn btn-success btn-block" data-target="#acceptModal<?php echo e($item->pid); ?>" data-toggle="modal">Accept</button></td>
                        <td><button class="btn btn-danger btn-block" data-target="#rejectModal<?php echo e($item->pid); ?>" data-toggle="modal">Reject</button></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="acceptModal<?php echo e($item->pid); ?>" tabindex="-1" aria-labelledby="acceptModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="acceptModalLabel">Accept Payment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="acceptForm<?php echo e($item->pid); ?>" action="<?php echo e(route('admin_acceptpayment')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="pid" value="<?php echo e($item->pid); ?>">
                <input type="hidden" name="bid" value="<?php echo e($item->bid); ?>">
                <h3>Are You Sure?</h3>
            </form>
        </div>
        <div class="modal-footer">
          <button form="acceptForm<?php echo e($item->pid); ?>" type="submit" class="btn btn-success">Accept Payment</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="rejectModal<?php echo e($item->pid); ?>" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="rejectModalLabel">Reject Payment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="rejectForm<?php echo e($item->pid); ?>" action="<?php echo e(route('admin_rejectpayment')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="pid" value="<?php echo e($item->pid); ?>">
                <input type="hidden" name="bid" value="<?php echo e($item->bid); ?>">
                <h3>Are You Sure?</h3>
            </form>
        </div>
        <div class="modal-footer">
          <button form="rejectForm<?php echo e($item->pid); ?>" type="submit" class="btn btn-danger">Reject</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<script>
    $(document).ready(function() {
        $('#connections').DataTable();
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\class\versity project for students\electribill\resources\views/admin/payrequests.blade.php ENDPATH**/ ?>