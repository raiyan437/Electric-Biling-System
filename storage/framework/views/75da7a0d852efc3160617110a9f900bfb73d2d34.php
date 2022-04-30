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
                <h1 class="m-0">Connection List</h1>
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
                        <th>Contact No</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($item->cid); ?></td>
                        <td><?php echo e($item->appname); ?></td>
                        <td><?php echo e($item->contactno); ?></td>
                        <td><button class="btn btn-primary btn-block" data-target="#detailsModal<?php echo e($item->cid); ?>" data-toggle="modal">Details</button></td>
                        <td><button class="btn btn-danger btn-block" data-target="#deleteModal<?php echo e($item->cid); ?>" data-toggle="modal">Delete</button></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="detailsModal<?php echo e($item->cid); ?>" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" style="width: 45.7rem">
        <div class="modal-header">
          <h5 class="modal-title" id="detailsModalLabel">Connection Details# <?php echo e($item->cid); ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <h3><b>Connection Name: </b></h3>
                        <h4><?php echo e($item->appname); ?></h4>
                    </div>
                    <div class="form-group">
                        <h3><b>Email: </b></h3>
                        <h4><?php echo e($item->nid); ?></h4>
                    </div>
                    <div class="form-group">
                        <h3><b>NID: </b></h3>
                        <h4><?php echo e($item->nid); ?></h4>
                    </div>
                    <div class="form-group">
                        <h3><b>Gender: </b></h3>
                        <h4><?php echo e($item->nid); ?></h4>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <h3><b>Address: </b></h3>
                        <h4><?php echo e($item->conaddress); ?></h4>
                    </div>
                    <div class="form-group">
                        <h3><b>Contact No: </b></h3>
                        <h4><?php echo e($item->conaddress); ?></h4>
                    </div>
                    <div class="form-group">
                        <h3><b>Bill Month: </b></h3>
                        <h4><?php echo e($item->billmonth); ?></h4>
                    </div>
                    <div class="form-group">
                        <h3><b>Application Date: </b></h3>
                        <h4><?php echo e($item->appdate); ?></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="deleteModal<?php echo e($item->cid); ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Delete Connection# <?php echo e($item->cid); ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="<?php echo e(route('admin_deleteconnection')); ?>" id="deleteForm<?php echo e($item->cid); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="cid" value="<?php echo e($item->cid); ?>">
                <input type="hidden" name="email" value="<?php echo e($item->email); ?>">
                <h3>Are You Sure?</h3>
            </form>
        </div>
        <div class="modal-footer">
          <button type="submit" form="deleteForm<?php echo e($item->cid); ?>" class="btn btn-danger">Delete</button>
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

<?php echo $__env->make('layouts.admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\class\versity project for students\electribill\resources\views/admin/connectionlist.blade.php ENDPATH**/ ?>