  {{-- Nav --}}
  <header id="header" class="header fixed-top d-flex align-items-center">
      <div class="d-flex align-items-center justify-content-between">
          <a href="{{ route('home') }}" class="logo d-flex align-items-center">
              <img src="{{ asset('assets/img/logo.png') }}" alt="">
              <span class="d-none d-lg-block">PabloGarciaJC</span>
          </a>
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
              {{-- Notificaciones --}}
              <li class="nav-item dropdown">
                  <a href="#" class="nav-link nav-icon" data-bs-toggle="dropdown">
                      <i class="bi bi-bell"></i>
                      <span class="badge bg-primary badge-number">
                          {{ count(auth()->user()->unReadNotifications) }}
                      </span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications"
                      id="notificacionesAmistad">
                      <li class="dropdown-header">
                          Tú tienes
                          <span class="count-notification">{{ count(auth()->user()->unReadNotifications) }}</span>
                          Notificaciones
                      </li>
                      @foreach (auth()->user()->notifications as $notification)
                          <a
                              href="{{ route('detalles.perfil', ['perfil' => $notification->data['alias'], 'addFriend' => $notification->data['addFriend']]) }}">
                              <span class="notification-item nt-item__group">
                                  <img src=" {{ route('foto.perfil', ['filename' => $notification->data['fotoPerfil']]) }} "
                                      class="nt-item__img" />
                                  <div class="nt-item__description">
                                      <span>{{ $notification->data['alias'] }}</span>
                                      <span>{{ $notification->data['messaje'] }}</span>
                                  </div>
                              </span>
                          </a>
                          <li>
                              <hr class="dropdown-divider">
                          </li>
                      @endforeach

                      <li class="dropdown-footer">
                          <a href="{{ route('markAsRead') }}">
                              Marcar todo como leído
                          </a>
                          <br>
                          <a href="{{ route('borrarNotificacion', ['id' => auth()->id()]) }}">
                              Borrar todas las notificaciones
                          </a>
                      </li>
                  </ul>
              </li>
              {{-- Perfil --}}
              <li class="nav-item dropdown pe-3">
                  <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                      data-bs-toggle="dropdown">
                      <img src="{{ route('foto.perfil', ['filename' => Auth::user()->fotoPerfil]) }}" alt="Profile"
                          class="rounded-circle">
                      <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->alias }}</span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                      <li class="dropdown-header">
                          <h6>{{ Auth::user()->nombre }} {{ Auth::user()->apellido }}</h6>
                          <span>{{ Auth::user()->cargo }}</span>
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>
                      <li>
                          <a class="dropdown-item d-flex align-items-center" href="{{ route('perfil') }}">
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
                          <form action="{{ route('logout') }}" method="POST">
                              {{ csrf_field() }}
                              <button type="submit" class="dropdown-item d-flex align-items-center"><i
                                      class="bi bi-box-arrow-right"></i>Cerrar Sesión</button>
                          </form>
                      </li>
                  </ul>
              </li>
          </ul>
      </nav>
  </header>
