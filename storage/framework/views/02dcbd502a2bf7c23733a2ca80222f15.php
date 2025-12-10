

<?php $__env->startSection('title', 'Staff | Reservations'); ?>

<?php $__env->startSection('content'); ?>

<style>
    .btn-brown {
        background-color: saddlebrown;
        color: white;
        border-radius: 8px;
        padding: 6px 14px;
        border: none;
    }
    .btn-brown:hover { background-color: brown; }

    .btn-approve { background-color: seagreen; color: white; border-radius: 8px; padding: 6px 12px; }
    .btn-approve:hover { background-color: forestgreen; }

    .btn-reject { background-color: firebrick; color: white; border-radius: 8px; padding: 6px 12px; }
    .btn-reject:hover { background-color: darkred; }

    th { background-color: burlywood; color: saddlebrown; }

    .badge-pending { background-color: goldenrod; }
    .badge-approved { background-color: forestgreen; }
    .badge-released { background-color: steelblue; }
</style>

<div class="card shadow-sm p-4">

    <h2 class="text-center mb-4" style="color:sienna;">📅 Book Reservations</h2>

    <table class="table table-bordered table-hover align-middle">
        <thead>
            <tr>
                <th>User</th>
                <th>Book</th>
                <th>Reserved At</th>
                <th>Status</th>
                <th width="220">Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($res->user->name ?? 'Unknown User'); ?></td>
                <td><?php echo e($res->book->title ?? 'Unknown Book'); ?></td>
                <td><?php echo e(\Carbon\Carbon::parse($res->reserved_at)->format('M d, Y h:i A')); ?></td>

                <td>
                    <?php if(!$res->approved_at && !$res->released_at): ?>
                        <span class="badge badge-pending">Pending</span>

                    <?php elseif($res->approved_at && !$res->released_at): ?>
                        <span class="badge badge-approved">Approved</span>

                    <?php elseif($res->released_at): ?>
                        <span class="badge badge-released">Released</span>
                    <?php endif; ?>
                </td>

                <td>

                    
                    <?php if(!$res->approved_at): ?>
                    <form action="<?php echo e(route('staff.reservation.approve', $res->id)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <button class="btn btn-approve btn-sm">Approve</button>
                    </form>
                    <?php endif; ?>

                    
                    <?php if(!$res->approved_at): ?>
                    <form action="<?php echo e(route('staff.reservation.reject', $res->id)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <button class="btn btn-reject btn-sm">Reject</button>
                    </form>
                    <?php endif; ?>

                    
                    <?php if($res->approved_at && !$res->released_at): ?>
                    <form action="<?php echo e(route('staff.reservation.release', $res->id)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <button class="btn btn-brown btn-sm">Release</button>
                    </form>
                    <?php endif; ?>

                </td>

            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="5" class="text-center text-muted">No reservations found.</td>
            </tr>
            <?php endif; ?>
        </tbody>

    </table>

    <a href="<?php echo e(route('staff.dashboard')); ?>" class="btn btn-brown mt-3">⬅ Back to Dashboard</a>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Mia\Desktop\library-system\resources\views/staff/reservations.blade.php ENDPATH**/ ?>