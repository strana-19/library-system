

<?php $__env->startSection('title', 'Student Dashboard'); ?>

<?php $__env->startSection('content'); ?>

<style>
    .btn-brown {
        background-color: saddlebrown;
        color: white;
        padding: 10px 18px;
        border-radius: 10px;
        transition: 0.3s;
        border: none;
    }
    .btn-brown:hover { background-color: brown; }

    .logout-btn {
        background-color: firebrick;
        color: white;
        padding: 8px 14px;
        border-radius: 8px;
        border: none;
    }
    .logout-btn:hover { background-color: darkred; }

    .card { background-color: floralwhite; }
</style>

<div class="card p-4 shadow-sm">

    <div class="d-flex justify-content-between">
        <h2 style="color:sienna;">🎓 Student Dashboard</h2>

        <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <button class="logout-btn">🚪 Logout</button>
        </form>
    </div>

    <p class="text-secondary">
        Manage your bookings and library activity.
    </p>

    <div class="d-flex justify-content-center flex-wrap gap-3 mt-4">

        <a href="<?php echo e(route('student.books')); ?>" class="btn btn-brown">📖 Borrow Books</a>
        <a href="<?php echo e(route('student.history')); ?>" class="btn btn-brown">📘 Borrow History</a>

    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Mia\Desktop\library-system\resources\views/student/dashboard.blade.php ENDPATH**/ ?>