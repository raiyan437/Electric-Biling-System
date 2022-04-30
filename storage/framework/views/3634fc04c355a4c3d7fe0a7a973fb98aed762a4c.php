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
                <h1 class="m-0">Pending Bills</h1>
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
                        <th>Bill ID</th>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Amount</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($item->bid); ?></td>
                        <td><?php echo e($item->billmonth); ?></td>
                        <td><?php echo e($item->billyear); ?></td>
                        <td><?php echo e($item->amount); ?></td>
                        <td><button class="btn btn-<?php echo e($item->status == 'Reviewing' ? 'warning' : 'primary'); ?> btn-block" <?php echo e($item->status == 'Reviewing' ? 'disabled' : ''); ?> data-target="#payModal<?php echo e($item->bid); ?>" data-toggle="modal"><?php echo e($item->status == 'Reviewing' ? 'Reviewing' : 'Pay Bill'); ?></button></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="payModal<?php echo e($item->bid); ?>" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="payModalLabel">Pay Bill for <?php echo e($item->billmonth); ?> <?php echo e($item->billyear); ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="<?php echo e(route('customer_paybills')); ?>" id="payForm<?php echo e($item->bid); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="bid" value="<?php echo e($item->bid); ?>">
                <div class="form-group">
                    <label>Pay Amount</label>
                    <input type="number" name="payamount" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Pay Method</label>
                    <select name="method" class="custom-select" required>
                        <option value="" selected>--Select An Option--</option>
                        <option value="Bkash">Bkash</option>
                        <option value="Rocket">Rocket</option>
                        <option value="Nogod">Nogod</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Txn. ID</label>
                    <input type="text" name="txnid" class="form-control" required>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="submit" form="payForm<?php echo e($item->bid); ?>" class="btn btn-success" <?php echo e($item->status == 'Reviewing' ? 'disabled' : ''); ?>>Pay Bill</button>
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

<?php echo $__env->make('layouts.customer_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\USER\Desktop\electribill\resources\views/customer/duebills.blade.php ENDPATH**/ ?>