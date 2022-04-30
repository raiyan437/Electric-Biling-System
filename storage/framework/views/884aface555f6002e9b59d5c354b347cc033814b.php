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
                <h1 class="m-0">Payment History</h1>
            </div>
            <div class="col-sm-6">
                <button class="btn btn-info" id="btnPrint">Print</button>
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
                        <th>Contact No</th>
                        <th>Bill Month & Year</th>
                        <th>Pay Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($item->conid); ?></td>
                        <td><?php echo e($item->appname); ?></td>
                        <td><?php echo e($item->contactno); ?></td>
                        <td><?php echo e($item->billmonth); ?> <?php echo e($item->billyear); ?></td>
                        <td><?php echo e($item->paydate); ?></td>
                        <td><button class="btn btn-success btn-block" data-target="#detailsModal<?php echo e($item->pid); ?>" data-toggle="modal">Details</button></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="detailsModal<?php echo e($item->pid); ?>" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detailsModalLabel">Payment History</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <h4>Txn ID</h4>
                <p><?php echo e($item->txnid); ?></p>
            </div>
            <div class="form-group">
                <h4>Pay Method</h4>
                <p><?php echo e($item->method); ?></p>
            </div>
        </div>
        <div class="modal-footer">
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

    $('#btnPrint').click(function(){
        window.print();
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\class\versity project for students\electribill\resources\views/admin/payhistory.blade.php ENDPATH**/ ?>