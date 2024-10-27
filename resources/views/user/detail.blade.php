
@extends('layouts.app')

@section('core-content')
    <main id="main" class="main">
        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            @foreach ($usuario as $user)
                                @if ($user->fotoPerfil != '')
                                    <img src="{{ route('foto.perfil', ['filename' => $user->fotoPerfil]) }}" alt="Profile" class="rounded-circle">
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
                                        $estado = '';
                                        $gestionBtns = '';  
                                        $alertMessage = '';
                                        $actionUrlDenegada = '';
                                        @endphp
                                        @switch(request()->query('estado'))
                                            @case('enviado')
                                                @php
                                                    $notificacion = request()->query('notificacion');
                                                    if ($notificacion == '1') {
                                                        $actionUrl = route('cancelar');
                                                        $gestionBtns = false;
                                                    } else {
                                                        $actionUrl = route('confirmar');
                                                        $actionUrlDenegada = route('denegar');
                                                        $gestionBtns = true;
                                                    }
                                                @endphp
                                                @break
                                            @break
                                            @case('confirmado')
                                            @php
                                                $actionUrl = route('denegar');
                                                $gestionBtns = false; 
                                            @endphp
                                        @break
                                            @default
                                                @php
                                                    $actionUrl = route('enviar');
                                                    $gestionBtns = true; 
                                                @endphp
                                                @break
                                        @endswitch
                                        <form action="{{ $actionUrl }}" method="POST">
                                            @csrf
                                            @foreach ($usuario as $userReceptor)
                                                <input type="hidden" class="user-receptor" name="userReceptor" value="{{ $userReceptor->id }}">
                                            @endforeach
                                            @if ($gestionBtns)
                                                <button type="submit" class="btn btn-success">
                                                    {{ request()->query('estado')  == 'solocitud-enviada' ? 'Aceptar solicitud' : 'Agregar Amigos'}}
                                                </button>
                                            @else
                                                <input type="hidden" name="accion" value="cancelar">
                                                <button type="submit" class="btn btn-danger">
                                                    Cancelar Solicitud
                                                </button>
                                            @endif
                                        </form>
                                        @if ($actionUrlDenegada)
                                            <form action="{{ $actionUrlDenegada }}" method="POST">
                                                @csrf
                                                @foreach ($usuario as $userReceptor)
                                                    <input type="hidden" class="user-receptor" name="userReceptor" value="{{ $userReceptor->id }}">
                                                @endforeach
                                                <input type="hidden" name="accion" value="cancelar">
                                                <button type="submit" class="btn btn-danger">
                                                    Cancelar Solicitud
                                                </button>
                                            </form>
                                         @endif
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
                                    <button class="nav-link {{ session('message') || $errors->any() ? '' : 'active' }}" data-bs-toggle="tab" data-bs-target="#perfil">
                                        Perfil
                                    </button>
                                </li>
                                @if (request()->query('estado') == 'confirmado')
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#chat">
                                            Chat
                                        </button>
                                    </li>
                                 @endif
                            </ul>
                            <div class="tab-content pt-2">
                                {{-- Perfil Info --}}
                                @include('user.info')
                                {{-- Chat --}}
                                @include('chat.windows')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
