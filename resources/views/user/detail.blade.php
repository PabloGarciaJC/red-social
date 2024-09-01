@extends('layouts.app')

@section('dynamic-content')
    <main id="main" class="main">
        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            @foreach ($usuario as $user)
                                @if ($user->fotoPerfil != '')
                                    <img src="{{ route('foto.perfil', ['filename' => $user->fotoPerfil]) }}" alt="Profile"
                                        class="rounded-circle">
                                @else
                                    <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                                @endif
                                <span>{{ $user->alias }}</span>
                                <span>{{ $user->cargo }}</span>
                            @endforeach
                            <div class="container">
                                <div class="row justify-content-md-center">
                
                                    <div class="col-md-auto">
                                        @php
                                        $solicitudEnviada = '';  
                                    @endphp
                                    
                                    @switch(request()->query('solicitud-enviada'))
                                        @case('1')
                                            @php
                                                $actionUrl = route('aceptarContacto');
                                                $solicitudEnviada = 1;
                                            @endphp
                                            @break
                                        @case('0')
                                        @default
                                            @php
                                                $actionUrl = route('enviarSolicitud');
                                            @endphp
                                            @break
                                    @endswitch
                                    
                                    <form action="{{ $actionUrl }}" method="POST">
                                        @csrf
                                        @foreach ($usuario as $userReceptor)
                                            <input type="hidden" id="user-receptor" name="userReceptor" value="{{ $userReceptor->id }}">
                                        @endforeach
                                        @if ($solicitudEnviada != 1)
                                            <button type="submit" class="btn btn-success">
                                                Agregar Contacto
                                            </button>
                                        @endif
                                        @if ($solicitudEnviada == 1)
                                            <input type="hidden" name="accion" value="cancelar">
                                            <button type="submit" class="btn btn-danger">
                                                Cancelar Solicitud
                                            </button>
                                        @endif
                                    </form>
                                    
                                    

                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body pt-3">
                            {{-- Menu de Navegacion --}}
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <button class="nav-link {{ session('message') || $errors->any() ? '' : 'active' }}"
                                        data-bs-toggle="tab" data-bs-target="#perfil">
                                        Perfil</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#chat">
                                        Chat</button>
                                </li>
                            </ul>

                            <div class="tab-content pt-2">

                                {{-- Mensaje de Notificacion --}}
                                {{-- <div id="mensajeNotification"></div> --}}

                                @if (session('success'))
                                    <div class="alert alert-success text-center" role="alert">
                                    {{ session('success') }}
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger text-center" role="alert">
                                    {{ session('error') }}
                                    </div>
                                @endif

                                {{-- Perfil --}}
                                <div class="tab-pane fade show {{ session('message') || $errors->any() ? '' : 'active' }} profile-overview"
                                    id="perfil">
                                    <h5 class="card-title">Sobre Mi</h5>
                                    <p class="small">{{ Auth::user()->sobreMi }}</p>
                                    <h5 class="card-title">Detalles de mi Perfil</h5>

                                    @foreach ($usuario as $user)
                                        <input type="hidden" id="user-receptor" value="{{ $user->id }}">
                                    @endforeach

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Nombre</div>
                                        @foreach ($usuario as $user)
                                            <div class="col-lg-9 col-md-8">{{ $user->nombre }}</div>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Apellido</div>
                                        @foreach ($usuario as $user)
                                            <div class="col-lg-9 col-md-8">{{ $user->apellido }}</div>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Empresa</div>
                                        @foreach ($usuario as $user)
                                            <div class="col-lg-9 col-md-8">{{ $user->empresa }}</div>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Cargo</div>
                                        @foreach ($usuario as $user)
                                            <div class="col-lg-9 col-md-8">{{ $user->cargo }}</div>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Pais</div>
                                        @foreach ($usuario as $user)
                                            <div class="col-lg-9 col-md-8">{{ $user->pais }}</div>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Dirección</div>
                                        @foreach ($usuario as $user)
                                            <div class="col-lg-9 col-md-8">{{ $user->direccion }}</div>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Móvil</div>
                                        @foreach ($usuario as $user)
                                            <div class="col-lg-9 col-md-8">{{ $user->movil }}</div>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        @foreach ($usuario as $user)
                                            <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @endpush
@endsection
