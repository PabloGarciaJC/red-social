<?php echo $__env->make('layouts.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if(auth()->guard()->guest()): ?>
        <?php echo $__env->yieldContent('content'); ?>
    <?php else: ?>
        <?php echo $__env->make('home.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php echo $__env->make('layouts.footer-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php /**PATH /var/www/html/resources/views/layouts/app.blade.php ENDPATH**/ ?>