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
                                                <input type="hidden" id="user-receptor" name="userReceptor" value="{{ $userReceptor->id }}">
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
                                                    <input type="hidden" id="user-receptor" name="userReceptor" value="{{ $userReceptor->id }}">
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
                                    <button class="nav-link {{ session('message') || $errors->any() ? '' : 'active' }}"
                                        data-bs-toggle="tab" data-bs-target="#perfil">
                                        Perfil
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#chat">
                                        Chat
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2">
                                {{-- Perfil --}}
                                <div class="tab-pane fade show {{ session('message') || $errors->any() ? '' : 'active' }} profile-overview" id="perfil">
                                    {{-- Mensaje de Notificacion de estados --}}
                                    {!! $alertMessage !!}
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
                                    <h5 class="card-title">Sobre Mi</h5>
                                    <p class="small">{{ Auth::user()->sobreMi }}</p>
                                    <h5 class="card-title">Detalles de mi Perfil</h5>
                                    @foreach ($usuario as $user)
                                        <input type="hidden" id="user-receptor" value="{{ $user->id }}">
                                    @endforeach
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Nombre</div>
                                        @foreach ($usuario as $user)
                                            <div class="col-lg-9 col-md-8">{{ $user->nombre }}</div>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Apellido</div>
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
                                {{-- Chat --}}
                                <div class="tab-pane fade" id="chat">
                                    <h5 class="card-title">Chat</h5>
                                    <!-- Contenedor del Chat -->
                                    <div class="chat-container">
                                        <div class="chat-container__box">
                                            <!-- Mensajes del chat -->
                                            <div class="chat-container__message chat-container__message--received">
                                                <div class="chat-container__message-content">
                                                    <p>Hello! How are you?</p>
                                                </div>
                                            </div>
                                            <div class="chat-container__message chat-container__message--sent">
                                                <div class="chat-container__message-content">
                                                    <p>I'm good, thanks! How about you?</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Área de entrada de texto -->
                                        <div class="chat-container__input">
                                            <input type="text" id="messageInput" placeholder="Type a message...">
                                            <button type="button" id="sendMessage">Send</button>
                                            <button type="button" id="emojiButton">😊</button>
                                            <button type="button" id="videoCallButton">Video Call</button>
                                        </div>
                                        <!-- Cuadro de emojis -->
                                        <div id="emojiPicker" class="chat-container__emoji-picker" style="display: none;">
                                            <span class="chat-container__emoji" onclick="insertEmoji('😊')">😊</span>
                                            <span class="chat-container__emoji" onclick="insertEmoji('😂')">😂</span>
                                            <span class="chat-container__emoji" onclick="insertEmoji('😍')">😍</span>
                                            <span class="chat-container__emoji" onclick="insertEmoji('😉')">😉</span>
                                            <span class="chat-container__emoji" onclick="insertEmoji('😭')">😭</span>
                                            <span class="chat-container__emoji" onclick="insertEmoji('😎')">😎</span>
                                            <span class="chat-container__emoji" onclick="insertEmoji('😡')">😡</span>
                                            <span class="chat-container__emoji" onclick="insertEmoji('🥺')">🥺</span>
                                            <span class="chat-container__emoji" onclick="insertEmoji('😜')">😜</span>
                                            <span class="chat-container__emoji" onclick="insertEmoji('🤔')">🤔</span>
                                            <span class="chat-container__emoji" onclick="insertEmoji('👍')">👍</span>
                                            <span class="chat-container__emoji" onclick="insertEmoji('🙏')">🙏</span>
                                            <span class="chat-container__emoji" onclick="insertEmoji('❤️')">❤️</span>
                                            <span class="chat-container__emoji" onclick="insertEmoji('🎉')">🎉</span>
                                            <span class="chat-container__emoji" onclick="insertEmoji('🔥')">🔥</span>
                                            <span class="chat-container__emoji" onclick="insertEmoji('🤯')">🤯</span>
                                            <span class="chat-container__emoji" onclick="insertEmoji('🤩')">🤩</span>
                                            <span class="chat-container__emoji" onclick="insertEmoji('😇')">😇</span>
                                            <span class="chat-container__emoji" onclick="insertEmoji('🥳')">🥳</span>
                                            <span class="chat-container__emoji" onclick="insertEmoji('🤪')">🤪</span>
                                            <span class="chat-container__emoji" onclick="insertEmoji('👀')">👀</span>
                                            <span class="chat-container__emoji" onclick="insertEmoji('😏')">😏</span>
                                            <span class="chat-container__emoji" onclick="insertEmoji('💀')">💀</span>
                                            <span class="chat-container__emoji" onclick="insertEmoji('👻')">👻</span>
                                            <span class="chat-container__emoji" onclick="insertEmoji('🤤')">🤤</span>
                                            <span class="chat-container__emoji" onclick="insertEmoji('😴')">😴</span>
                                            <span class="chat-container__emoji" onclick="insertEmoji('👑')">👑</span>
                                            <span class="chat-container__emoji" onclick="insertEmoji('💩')">💩</span>
                                            <span class="chat-container__emoji" onclick="insertEmoji('🦄')">🦄</span>
                                            <span class="chat-container__emoji" onclick="insertEmoji('🐶')">🐶</span>
                                        </div>
                                    </div>
                                    <!-- Ventana emergente de videollamada -->
                                    <div id="videoCallModal" class="chat-container__modal" style="display: none;">
                                        <div class="chat-container__modal-content">
                                            <span class="chat-container__close" onclick="closeVideoCall()">×</span>
                                            <h2>Video Call</h2>
                                            <p>Video call with [User]</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
