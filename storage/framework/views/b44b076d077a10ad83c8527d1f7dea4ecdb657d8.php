<?php $__env->startSection('core-content'); ?>
    <main id="main" class="main">
        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <?php $__currentLoopData = $usuario; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($user->fotoPerfil != ''): ?>
                                    <img src="<?php echo e(route('foto.perfil', ['filename' => $user->fotoPerfil])); ?>" alt="Profile" class="rounded-circle">
                                <?php else: ?>
                                    <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                                <?php endif; ?>
                                <h2><?php echo e($user->alias); ?></h2>
                                <h3><?php echo e($user->cargo); ?></h3>
                                <div class="social-links mt-2">
                                    <a href="javascript:void(0)" class="twitter"><i class="bi bi-twitter"></i></a>
                                    <a href="javascript:void(0)" class="facebook"><i class="bi bi-facebook"></i></a>
                                    <a href="javascript:void(0)" class="instagram"><i class="bi bi-instagram"></i></a>
                                    <a href="javascript:void(0)" class="linkedin"><i class="bi bi-linkedin"></i></a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <div class="container">
                                <div class="row justify-content-md-center">
                                    <div class="col-md-auto">
                                        <?php
                                        $estado = '';
                                        $gestionBtns = '';  
                                        $alertMessage = '';
                                        $actionUrlDenegada = '';
                                        ?>
                                        <?php switch(request()->query('estado')):
                                            case ('enviado'): ?>
                                                <?php
                                                    $notificacion = request()->query('notificacion');
                                                    if ($notificacion == '1') {
                                                        $actionUrl = route('cancelar');
                                                        $gestionBtns = false;
                                                    } else {
                                                        $actionUrl = route('confirmar');
                                                        $actionUrlDenegada = route('denegar');
                                                        $gestionBtns = true;
                                                    }
                                                ?>
                                                <?php break; ?>
                                            <?php break; ?>
                                            <?php case ('confirmado'): ?>
                                            <?php
                                                $actionUrl = route('denegar');
                                                $gestionBtns = false; 
                                            ?>
                                        <?php break; ?>
                                            <?php default: ?>
                                                <?php
                                                    $actionUrl = route('enviar');
                                                    $gestionBtns = true; 
                                                ?>
                                                <?php break; ?>
                                        <?php endswitch; ?>
                                        <form action="<?php echo e($actionUrl); ?>" method="POST" class="form__user-perfil">
                                            <?php echo csrf_field(); ?>
                                            <?php $__currentLoopData = $usuario; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userReceptor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <input type="hidden" class="user-receptor" name="userReceptor" value="<?php echo e($userReceptor->id); ?>">
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($gestionBtns): ?>
                                                <button type="submit" class="btn btn-success">
                                                    <?php echo e(request()->query('estado')  == 'solocitud-enviada' ? 'Aceptar solicitud' : 'Agregar Amigos'); ?>

                                                </button>
                                            <?php else: ?>
                                                <input type="hidden" name="accion" value="cancelar">
                                                <button type="submit" class="btn btn-danger">
                                                    Cancelar Solicitud
                                                </button>
                                            <?php endif; ?>
                                        </form>
                                        <?php if($actionUrlDenegada): ?>
                                            <form action="<?php echo e($actionUrlDenegada); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <?php $__currentLoopData = $usuario; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userReceptor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <input type="hidden" class="user-receptor" name="userReceptor" value="<?php echo e($userReceptor->id); ?>">
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <input type="hidden" name="accion" value="cancelar">
                                                <button type="submit" class="btn btn-danger">
                                                    Cancelar Solicitud
                                                </button>
                                            </form>
                                         <?php endif; ?>
                                    </div>
                                </div>
                            </div>                           
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body pt-3">
                            
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <button class="nav-link <?php echo e(session('message') || $errors->any() ? '' : 'active'); ?>" data-bs-toggle="tab" data-bs-target="#perfil">
                                        Perfil
                                    </button>
                                </li>
                                <?php if(request()->query('estado') == 'confirmado'): ?>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#chat">
                                            Chat
                                        </button>
                                    </li>
                                 <?php endif; ?>
                            </ul>
                            <div class="tab-content pt-2">
                                
                                <?php echo $__env->make('user.info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                
                                <?php echo $__env->make('chat.windows', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/user/detail.blade.php ENDPATH**/ ?>