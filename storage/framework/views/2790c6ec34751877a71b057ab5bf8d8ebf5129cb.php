  
  <header id="header" class="header fixed-top d-flex align-items-center">
      <div class="d-flex align-items-center justify-content-between">
          <a href="<?php echo e(route('home')); ?>" class="logo d-flex align-items-center">
              <img src="<?php echo e(asset('images/logo.webp')); ?>" alt="">
              <span class="d-none d-lg-block">PabloGarciaJC</span>
          </a>
          <i class="bi bi-list toggle-sidebar-btn"></i>
      </div>
      <div class="search-bar">
          <form class="search-form d-flex align-items-center" id='formBuscador' method="POST" action="#">
              <input type="text" name="search" id="search" placeholder="Buscar en PabloSocial"
                  title="Enter search keyword">
              <button type="submit" title="Search"><i class="bi bi-search"></i></button>
          </form>
          <ul id="search-results" class="list-unstyled mt-3"></ul>
      </div>
      <nav class="header-nav ms-auto">
          <ul class="d-flex align-items-center">
            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="javascript:void(0)">
                  <i class="bi bi-search"></i>
                </a>
              </li>
              
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link nav-icon" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-primary badge-number" id="notification-count">
                            <?php echo e(count(auth()->user()->unReadNotifications)); ?>

                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications" id="notificacionesAmistad">
                        <li class="dropdown-header">
                            Tú tienes <span id="total-notifications"><?php echo e(count(auth()->user()->unReadNotifications)); ?></span> Notificaciones
                        </li>
                        <!-- Aquí se insertarán dinámicamente las notificaciones -->
                        <div id="notifications-list">
                            <?php $__currentLoopData = auth()->user()->notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('detalles.perfil', ['perfil' => $notification->data['alias'], 'estado' => $notification->data['estado']])); ?>">
                                <span class="notification-item nt-item__group">
                                    <img src="<?php echo e(route('foto.perfil', ['filename' => $notification->data['fotoPerfil']])); ?>" class="nt-item__img" />
                                    <div class="nt-item__description">
                                        <span><?php echo e($notification->data['alias']); ?></span>
                                        <span><?php echo e($notification->data['messaje']); ?></span>
                                    </div>
                                </span>
                            </a>
                            <li><hr class="dropdown-divider"></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <li class="dropdown-footer">
                            <a href="<?php echo e(route('markAsRead')); ?>">Marcar todo como leído</a><br>
                            <a href="<?php echo e(route('borrarNotificacion', ['id' => auth()->id()])); ?>">Borrar todas las notificaciones</a>
                        </li>
                    </ul>
                </li>

                
                <div class="nav-item dropdown nav-item-users">
                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-people fs-2"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                      <div class="news show-contacts show-emisor"></div>
                      <div class="news show-contacts show-follower"></div>
                    </div>
                </div>

              
              <li class="nav-item dropdown pe-3">
                  <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                      data-bs-toggle="dropdown">
                      <img src="<?php echo e(route('foto.perfil', ['filename' => Auth::user()->fotoPerfil])); ?>" alt="Profile"
                          class="rounded-circle">
                      <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo e(Auth::user()->alias); ?></span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                      <li class="dropdown-header">
                          <h6><?php echo e(Auth::user()->nombre); ?> <?php echo e(Auth::user()->apellido); ?></h6>
                          <span><?php echo e(Auth::user()->cargo); ?></span>
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>
                      <li>
                          <a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('perfil')); ?>">
                              <i class="bi bi-gear"></i>
                              <span>Perfil</span>
                          </a>
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>
                      <li>
                          <form action="<?php echo e(route('logout')); ?>" method="POST">
                              <?php echo e(csrf_field()); ?>

                              <button type="submit" class="dropdown-item d-flex align-items-center">
                                <i class="bi bi-box-arrow-right"></i>Cerrar Sesión
                            </button>
                          </form>
                      </li>
                  </ul>
              </li>
          </ul>
      </nav>
  </header>
<?php /**PATH /var/www/html/resources/views/home/header.blade.php ENDPATH**/ ?>