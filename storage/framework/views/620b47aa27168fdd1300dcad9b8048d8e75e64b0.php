<?php $__env->startSection('core-content'); ?>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Perfil</h1>
        </div>
        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <?php if(Auth::user()->fotoPerfil): ?>
                                <img src="<?php echo e(route('foto.perfil', ['filename' => Auth::user()->fotoPerfil])); ?>" alt="Profile" class="rounded-circle">
                            <?php else: ?>
                                <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                            <?php endif; ?>
                            <h1><?php echo e(Auth::user()->alias); ?></h1>
                            <h3><?php echo e(Auth::user()->cargo); ?></h3>
                            <div class="social-links mt-2">
                                <a href="javascript:void(0)" class="twitter"><i class="bi bi-twitter"></i></a>
                                <a href="javascript:void(0)" class="facebook"><i class="bi bi-facebook"></i></a>
                                <a href="javascript:void(0)" class="instagram"><i class="bi bi-instagram"></i></a>
                                <a href="javascript:void(0)" class="linkedin"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body pt-3">
                            
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <button class="nav-link <?php echo e(session('message') || $errors->any() ? '' : 'active'); ?>" data-bs-toggle="tab" data-bs-target="#perfil"> Perfil</button>
                                </li>
                                <li class="nav-item">
                                     <button class="nav-link <?php echo e(session('message') || $errors->any() ? 'active' : ''); ?>" data-bs-toggle="tab" data-bs-target="#perfil-edit">Editar Perfil</button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2">
                                
                                <div class="tab-pane fade show <?php echo e(session('message') || $errors->any() ? '' : 'active'); ?> profile-overview" id="perfil">
                                    <h5 class="card-title">Sobre Mi</h5>
                                    <p class="small"><?php echo e(Auth::user()->sobreMi); ?></p>
                                    <h5 class="card-title">Detalles de mi Perfil</h5>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Alias</div>
                                        <div class="col-lg-9 col-md-8"><?php echo e(Auth::user()->alias); ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Nombre</div>
                                        <div class="col-lg-9 col-md-8"><?php echo e(Auth::user()->nombre); ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Apellido</div>
                                        <div class="col-lg-9 col-md-8"><?php echo e(Auth::user()->apellido); ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Empresa</div>
                                        <div class="col-lg-9 col-md-8"><?php echo e(Auth::user()->empresa); ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Cargo</div>
                                        <div class="col-lg-9 col-md-8"><?php echo e(Auth::user()->cargo); ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Pais</div>
                                        <div class="col-lg-9 col-md-8"><?php echo e(Auth::user()->pais); ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Dirección</div>
                                        <div class="col-lg-9 col-md-8"><?php echo e(Auth::user()->direccion); ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Móvil</div>
                                        <div class="col-lg-9 col-md-8"><?php echo e(Auth::user()->movil); ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8"><?php echo e(Auth::user()->email); ?></div>
                                    </div>
                                </div>
                                
                                <div class="tab-pane fade show <?php echo e(session('message') || $errors->any() ? 'active' : ''); ?> profile-overview" id="perfil-edit">
                                    <?php if(session('message')): ?>
                                        <br>
                                        <div class="alert alert-success" role="alert" style="text-align: center">
                                            <?php echo e(session('message')); ?>

                                        </div>
                                    <?php endif; ?>
                                    <form id="perfil-form"  action="<?php echo e(action('UserController@actualizar')); ?>" method="POST" enctype="multipart/form-data">
                                        <?php echo e(csrf_field()); ?>

                                        <div class="row mb-3">
                                            <label for="fotoPerfil" class="col-md-4 col-lg-3 col-form-label">Foto del Perfil</label>
                                            <div class="col-md-8 col-lg-9">
                                                <div class="user-perfil__img-wrapper">
                                                    <?php if(Auth::user()->fotoPerfil): ?>
                                                        <img src="<?php echo e(route('foto.perfil', ['filename' => Auth::user()->fotoPerfil])); ?>" id="preview-perfil-user" alt="fotoPerfil" class="user-perfil__img"> 
                                                    <?php endif; ?>
                                                    <div class="user-perfil__btns-actions">
                                                        <a href="javascript:void(0)" class="user-perfil__btn user-perfil__edit" title="Upload new profile image">
                                                            <i class="user-perfil__icon user-perfil__edit emoji-39"></i>
                                                        </a>
                                                    </div>
                                                    <input type="file" id="upload-profile-image" accept="image/*" style="display: none;" name="fotoPerfil">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="nombre" class="col-md-4 col-lg-3 col-form-label">Alias</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="alias" type="text" class="form-control" id="alias"
                                                    value="<?php echo e(Auth::user()->alias); ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="nombre" class="col-md-4 col-lg-3 col-form-label">Nombre</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="nombre" type="text" class="form-control" id="nombre"
                                                    value="<?php echo e(Auth::user()->nombre); ?>">
                                                <?php if($errors->has('nombre')): ?>
                                                    <strong style="color: red"><?php echo e($errors->first('nombre')); ?></strong>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="apellido"
                                                class="col-md-4 col-lg-3 col-form-label">Apellido</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="apellido" type="text" class="form-control"
                                                    id="apellido" value="<?php echo e(Auth::user()->apellido); ?>">
                                                <?php if($errors->has('apellido')): ?>
                                                    <strong style="color: red"><?php echo e($errors->first('apellido')); ?></strong>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="empresa" class="col-md-4 col-lg-3 col-form-label">Empresa</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="empresa" type="text" class="form-control" id="empresa"
                                                    value="<?php echo e(Auth::user()->empresa); ?>">
                                                <?php if($errors->has('empresa')): ?>
                                                    <strong style="color: red"><?php echo e($errors->first('empresa')); ?></strong>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="cargo" class="col-md-4 col-lg-3 col-form-label">Cargo</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="cargo" type="text" class="form-control" id="cargo"
                                                    value="<?php echo e(Auth::user()->cargo); ?>">
                                                <?php if($errors->has('cargo')): ?>
                                                    <strong style="color: red"><?php echo e($errors->first('cargo')); ?></strong>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="pais" class="col-md-4 col-lg-3 col-form-label">Pais</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="pais" type="text" class="form-control" id="pais"
                                                    value="<?php echo e(Auth::user()->pais); ?>">
                                                <?php if($errors->has('pais')): ?>
                                                    <strong style="color: red"><?php echo e($errors->first('pais')); ?></strong>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="direccion"
                                                class="col-md-4 col-lg-3 col-form-label">Dirección</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="direccion" type="text" class="form-control"
                                                    id="direccion" value="<?php echo e(Auth::user()->direccion); ?>">
                                                <?php if($errors->has('direccion')): ?>
                                                    <strong style="color: red"><?php echo e($errors->first('direccion')); ?></strong>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="movil" class="col-md-4 col-lg-3 col-form-label">Móvil</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="movil" type="text" class="form-control" id="movil"
                                                    value="<?php echo e(Auth::user()->movil); ?>">
                                                <?php if($errors->has('movil')): ?>
                                                    <strong style="color: red"><?php echo e($errors->first('movil')); ?></strong>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="text" class="form-control" id="email"
                                                    value="<?php echo e(Auth::user()->email); ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="sobreMi" class="col-md-4 col-lg-3 col-form-label">Sobre
                                                Mi</label>
                                            <div class="col-md-8 col-lg-9">
                                                <textarea name="sobreMi" class="form-control" id="sobreMi" style="height: 100px"><?php echo e(Auth::user()->sobreMi); ?></textarea>
                                                <?php if($errors->has('sobreMi')): ?>
                                                    <strong style="color: red"><?php echo e($errors->first('sobreMi')); ?></strong>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="text-center form-btn__perfil">
                                            <button type="submit" class="button">Guardar Cambios</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/user/perfil.blade.php ENDPATH**/ ?>