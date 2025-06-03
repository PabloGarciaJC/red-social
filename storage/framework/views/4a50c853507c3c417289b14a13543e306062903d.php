<?php $__env->startSection('content'); ?>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Crea una cuenta</h5>
                                    <p class="text-center small">Ingrese sus datos personales para crear una cuenta</p>
                                </div>
                                <form method="POST" class="row g-3 needs-validation" action="<?php echo e(route('register')); ?>"
                                    aria-label="<?php echo e(__('Register')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <div class="col-12">
                                        <label for="alias"
                                            class="col-md-4 col-form-label text-md-right"><?php echo e(__('Alias')); ?></label>
                                        <input id="alias" type="text"
                                            class="form-control<?php echo e($errors->has('alias') ? ' is-invalid' : ''); ?>"
                                            name="alias" value="<?php echo e(old('alias')); ?>" autofocus>
                                        <?php if($errors->has('alias')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('alias')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-12">
                                        <label for="name"
                                            class="col-md-4 col-form-label text-md-right"><?php echo e(__('Name')); ?></label>
                                        <input id="name" type="text"
                                            class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>"
                                            name="name" value="<?php echo e(old('name')); ?>" autofocus>
                                        <?php if($errors->has('name')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('name')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-12">
                                        <label for="email"
                                            class="col-md-4 col-form-label text-md-right"><?php echo e(__('E-Mail Address')); ?></label>
                                        <input id="email" type="email"
                                            class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>"
                                            name="email" value="<?php echo e(old('email')); ?>" required>

                                        <?php if($errors->has('email')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('email')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-12">
                                        <label for="password"
                                            class="col-md-4 col-form-label text-md-right"><?php echo e(__('Password')); ?></label>
                                        <input id="password" type="password"
                                            class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>"
                                            name="password" required>
                                        <?php if($errors->has('password')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('password')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-12">
                                        <label for="password-confirm"
                                            class="col-md-12 col-form-label text-md-right"><?php echo e(__('Confirm Password')); ?></label>
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary w-100">
                                            <?php echo e(__('Register')); ?>

                                        </button>
                                    </div>
                                    <div class="col-12">
                                        <a href="https://pablogarciajc.com/" class="pt-2 credits__autor">Desarrollado por <strong>PabloGarciaJC</strong></a>     
                                    </div>
                                </form>
                            </div>
                        </div>         
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/auth/register.blade.php ENDPATH**/ ?>