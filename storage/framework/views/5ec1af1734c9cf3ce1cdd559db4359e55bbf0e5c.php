<div class="tab-pane fade show <?php echo e(session('message') || $errors->any() ? '' : 'active'); ?> profile-overview" id="perfil">
    
    <?php echo $alertMessage; ?>

    <?php if(session('success')): ?>
        <div class="alert alert-success text-center" role="alert">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="alert alert-danger text-center" role="alert">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>
    <h5 class="card-title">Sobre Mi</h5>
    <p class="small"><?php echo e(Auth::user()->sobreMi); ?></p>
    <h5 class="card-title">Detalles de mi Perfil</h5>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Nombre</div>
        <?php $__currentLoopData = $usuario; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-9 col-md-8"><?php echo e($user->nombre); ?></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Apellido</div>
        <?php $__currentLoopData = $usuario; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-9 col-md-8"><?php echo e($user->apellido); ?></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Empresa</div>
        <?php $__currentLoopData = $usuario; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-9 col-md-8"><?php echo e($user->empresa); ?></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Cargo</div>
        <?php $__currentLoopData = $usuario; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-9 col-md-8"><?php echo e($user->cargo); ?></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Pais</div>
        <?php $__currentLoopData = $usuario; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-9 col-md-8"><?php echo e($user->pais); ?></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Dirección</div>
        <?php $__currentLoopData = $usuario; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-9 col-md-8"><?php echo e($user->direccion); ?></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Móvil</div>
        <?php $__currentLoopData = $usuario; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-9 col-md-8"><?php echo e($user->movil); ?></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Email</div>
        <?php $__currentLoopData = $usuario; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-9 col-md-8"><?php echo e($user->email); ?></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div><?php /**PATH /var/www/html/resources/views/user/info.blade.php ENDPATH**/ ?>