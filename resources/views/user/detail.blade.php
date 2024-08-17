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
                                <h1>{{ $user->alias }}</h1>
                                <h3>{{ $user->cargo }}</h3>
                            @endforeach
                            <div class="container">
                                <div class="row justify-content-md-center">
                                    <div class="col-md-auto">

                                        @foreach ($usuario as $user)
                                            @if (Auth::user()->alias != $user->alias)
                                                <button type="button" id="btnAgregarContacto" class="btn btn-success">
                                                    Agregar Contacto
                                                </button>
                                                <button type="button" id="btnCancelarSolicitud" class="btn btn-primary">
                                                    Cancelar Solicitud
                                                </button>
                                            @endif
                                        @endforeach

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
                                <div id="mensajeNotification" role="alert"></div>
                                {{-- Perfil --}}
                                <div class="tab-pane fade show {{ session('message') || $errors->any() ? '' : 'active' }} profile-overview"
                                    id="perfil">
                                    <h5 class="card-title">Sobre Mi</h5>
                                    <p class="small">{{ Auth::user()->sobreMi }}</p>
                                    <h5 class="card-title">Detalles de mi Perfil</h5>

                                    <input type="hidden" id="friendRequestSend"
                                        value="{{ $friendRequestSend == 1 ? 1 : 0 }}">

                                    <input type="hidden" id="friendRequestReceived"
                                        value="{{ $friendRequestReceived == 1 ? 1 : 0 }}">

                                    <input type="hidden" id="idNotificacion" value="{{ $idNotificacion }}">

                                    <input type="hidden" id="usuarioLogin" value="{{ Auth::user()->id }}">

                                    @foreach ($usuario as $user)
                                        <input type="hidden" id="usuarioSeguido" value="{{ $user->id }}">
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

                                <style>
                                    /* Component: Chat */
                                    .chat .chat-wrapper .message-list-wrapper {
                                        border: 1px solid #ddd;
                                        height: 452px;
                                        position: relative;
                                        overflow-y: auto;
                                    }

                                    .receive-text {

                                        background: #eff5f5c9;
                                        border-radius: 18px;
                                        padding: 10px
                                    }

                                    .send-text {
                                        background: #9ef6ffc9;
                                        border-radius: 18px;
                                        padding: 10px
                                    }

                                    .textCenter {
                                        text-align: center;
                                    }

                                    .imagenText {
                                        width: 50px;
                                        float: left;
                                        border-radius: 5px;
                                        margin-left: 20px;
                                    }
                                </style>

                                {{-- Chat --}}
                                <div class="tab-pane fade show profile-overview" id="chat">
                                    {{-- Diseño --}}
                                    <div class="card-body">
                                        <div class="row p-2">
                                            <div class="col-10">
                                                <div class="row">
                                                    <div class="col-12 border rounded-lg p-3">
                                                        <ul id="messages" class="list-unstyled overflow-auto"
                                                            style="height: 45vh">
                                                            {{-- <li>Test 1: Hola</li>
                                                            <li>Test 2: Hola</li> --}}
                                                        </ul>
                                                    </div>
                                                </div>
                                                <form>
                                                    <div class="row py-3">

                                                        <div class="col-10">
                                                            <input type="text" id="message" class="form-control">
                                                        </div>

                                                        <div id="tes"></div>
                                                        <br>
                                                        <div class="col-2">
                                                            <button id="send" type="submit"
                                                                class="btn btn-primary btn-block">Enviar</button>
                                                        </div>

                                                    </div>
                                                </form>
                                            </div>

                                            <div class="col-2">
                                                <p><strong>En línea ahora</strong></p>
                                                <ul id="users" class="list-unstyled overflow-auto text-info"
                                                    style="height: 45vh">
                                                </ul>
                                            </div>

                                        </div>
                                    </div>

                                    {{-- //Diseño  --}}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    {{-- Chat Tiempo Real --}}
    @push('scripts')
        <script>
            /* Chat */
            const usersElement = document.getElementById('users');
            const sendElement = document.getElementById('send');
            const messageElement = document.getElementById('message');
            const messagesElement = document.getElementById('messages');

            Echo.join('chat')
                .here((users) => {

                    users.forEach((user, index) => {

                        let element = document.createElement('li');
                        element.setAttribute('id', user.id);
                        element.innerText = user.name;
                        usersElement.appendChild(element);

                    });

                })
                .joining((user) => {

                    let element = document.createElement('li');
                    element.setAttribute('id', user.id);
                    element.innerText = user.name;
                    usersElement.appendChild(element);

                })
                .leaving((user) => {

                    let element = document.getElementById(user.id);
                    element.parentNode.removeChild(element);

                })
                .listen('MessageSent', (e) => {

                    let element = document.createElement('li');
                    element.setAttribute('id', e.user.id);
                    element.innerText = e.user.nombre + ': ' + e.message;
                    messagesElement.appendChild(element);

                });

            sendElement.addEventListener('click', (e) => {
                e.preventDefault();

                $.ajax({
                        type: "POST",
                        url: "{{ route('chat.mesaage') }}",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            message: messageElement.value,
                        },
                    })
                    .done(function(respuestaPeticion) {

                        // $('#tes').html(respuestaPeticion);
                        // console.log(respuestaPeticion);
                        messageElement.value = '';

                    })
                    .fail(function() {
                        console.log('error');
                    })
                    .always(function() {
                        console.log('completo');
                    });

            })
        </script>

        <script>
            let btnAgregarContacto = document.getElementById('btnAgregarContacto');
            let btnCancelarSolicitud = document.getElementById('btnCancelarSolicitud');
            let usuarioLogin = document.getElementById('usuarioLogin');
            let usuarioSeguido = document.getElementById('usuarioSeguido');
            let friendRequestSend = document.getElementById('friendRequestSend');
            let friendRequestReceived = document.getElementById('friendRequestReceived');

            btnAgregarContacto?.addEventListener('click', (event) => {

                $.ajax({
                        type: "GET",
                        url: "{{ route('agregarContacto') }}",
                        data: {
                            usuarioLogin: usuarioLogin.value,
                            usuarioSeguido: usuarioSeguido.value,
                            idNotificacion: idNotificacion.value,
                            friendRequestSend: friendRequestSend.value,
                            friendRequestReceived: friendRequestReceived.value
                        },
                    })
                    .done(function(respuestaPeticion) {

                        $('#mensajeNotification').html(respuestaPeticion);

                        $('#mensajeNotification').addClass('alert alert-success text-center');

                        console.log(respuestaPeticion);

                        if (respuestaPeticion == 'send') {
                            mensajeNotification.innerText = 'Solicitud de Amistad Enviada';
                        }

                        if (respuestaPeticion == 'existSend') {
                            mensajeNotification.innerText = 'Ya Enviaste una Solicitud de Amistad';
                        }

                        if (respuestaPeticion == 'approvedFriends') {
                            mensajeNotification.innerText = 'Solicitud de Amistad Aceptada !!!';
                        }

                        if (respuestaPeticion == 'friendAfterReceived') {
                            mensajeNotification.innerText = 'Solicitud de Amistad Aceptada !!!';
                        }

                        if (respuestaPeticion == 'saveFollowerReceived') {
                            mensajeNotification.innerText =
                                'Has aceptado Solicitud de Amistad, ver en las Notificaciones !!!';

                        }

                        if (respuestaPeticion == 'sendAfterReceived') {
                            mensajeNotification.innerText = 'Solicitud de Amistad Enviada';
                        }

                        if (respuestaPeticion == 'saveAfterReceivedFriends') {
                            mensajeNotification.innerText = 'Solicitud de Amistad Aceptada !!!';
                        }

                        if (respuestaPeticion == 'saveReceivedAfterReceived') {
                            mensajeNotification.innerText = 'Solicitud de Amistad Aceptada !!!';
                        }

                    })
                    .fail(function() {
                        console.log('error');
                    })
                    .always(function() {
                        console.log('completo');
                    });
            });

            btnCancelarSolicitud?.addEventListener('click', (event) => {

                $.ajax({
                        type: "GET",
                        url: "{{ route('cancelarContacto') }}",
                        data: {
                            usuarioLogin: usuarioLogin.value,
                            usuarioSeguido: usuarioSeguido.value,
                            idNotificacion: idNotificacion.value,
                            friendRequestSend: friendRequestSend.value,
                            friendRequestReceived: friendRequestReceived.value
                        },
                    })
                    .done(function(respuestaPeticion) {

                        $('#mensajeNotification').html(respuestaPeticion);

                        console.log(respuestaPeticion);

                        $('#mensajeNotification').removeClass("alert alert-success text-center").addClass(
                            "alert alert-primary text-center");

                        if (respuestaPeticion == 'sendCancelar') {
                            mensajeNotification.innerText = 'Solicitud de Amistad Cancelada';
                        }

                        if (respuestaPeticion == 'cancelAfterReceived') {
                            mensajeNotification.innerText = 'Solicitud de Amistad Cancelada';
                        }

                        if (respuestaPeticion == 'deleteFollower') {
                            mensajeNotification.innerText = 'Has Borrado la Solicitud de Amistad';
                        }

                        if (respuestaPeticion == 'noNeedToDelete') {
                            mensajeNotification.innerText = 'No hay solicitud que borrar';
                        }

                        if (respuestaPeticion == 'existAfterReceived') {
                            mensajeNotification.innerText =
                                'Solo puedes cancelar una vez esta Solicitud de Amistad';
                        }

                        if (respuestaPeticion == 'deleteReceivedAfterReceived') {
                            mensajeNotification.innerText = 'Solicitud de Amistad Cancelada';
                        }

                        if (respuestaPeticion == 'followerReceived') {
                            mensajeNotification.innerText = 'Has Eliminado la Solicitud de Amistad !!!';
                        }

                    })
                    .fail(function() {
                        console.log('error');
                    })
                    .always(function() {
                        console.log('completo');
                    });
            });

            function hide(element) {
                element.style.display = "none";
            }

            function show(element) {
                element.style.display = "block";
            }
        </script>
    @endpush
@endsection
