@foreach ($publications as $mostrarPublication)
    <div class="col-12">
        <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                </li>
                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
            </ul>
        </div>
        <div class="card info-card sales-card">
            {{-- Filtro --}}
            <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                        <h6>Opciones</h6>
                    </li>
                    {{-- <li><a class="dropdown-item" href="#">Editar</a></li> --}}
                    <li><a class="dropdown-item" id="eliminarPublication"
                            onclick="deletePublication({{ $mostrarPublication->id }})"
                            href="javascript:void(0);">Eliminar</a></li>
                </ul>
            </div>
            {{-- Cuerpo --}}
            <div class="card-body">
                <div class="d-flex align-items-center" style="padding-top: 20px;">

                    <div class="news">
                        <div class="post-item clearfix">
                            <img src="{{ url('fotoPerfil/' . $mostrarPublication->user->fotoPerfil) }}" alt="">
                            <h4><a
                                    href="{{ route('usuarioBuscador.perfil', ['perfil' => $mostrarPublication->user->alias, 'idNotificacion' => 0]) }}">{{ $mostrarPublication->user->alias }}</a>
                            </h4>
                            <p>{{ $mostrarPublication->created_at }}</p>
                        </div>
                    </div>

                </div>
                @if ($mostrarPublication->imagen == '')
                    <p style="padding-top: 10px;">{{ $mostrarPublication->contenido }}</p>
                @else
                    <img src="{{ route('publicationImagen', ['filename' => $mostrarPublication->imagen]) }}"
                        alt="" width="700" height="700" class="img-fluid"
                        style="margin:auto; display:block; padding-top: 20px; border-radius: 10px 10px 10px 10px;">
                    <p style="padding-top: 10px;">{{ $mostrarPublication->contenido }}</p>
                @endif
                <hr>
                <div class="row justify-content-md-right">
                    <?php $userLike = false; ?>
                    @foreach ($mostrarPublication->like as $likes)
                        @if ($likes->user_id == Auth::user()->id)
                            <?php $userLike = true; ?>
                        @endif
                    @endforeach
                    @if ($userLike)
                        <div class="col col-lg-2 dislike" id="btn-dislike{{ $mostrarPublication->id }}"
                            onclick="dislike({{ $mostrarPublication->id }})">
                            Dislike
                        </div>
                    @else
                        <div class="col col-lg-2 like" id="btn-like{{ $mostrarPublication->id }}"
                            onclick="like({{ $mostrarPublication->id }})">
                            Like
                        </div>
                    @endif
                    <div class="col col-lg-2">
                        <a href="{{ route('publicationDetail', ['publicationId' => $mostrarPublication->id]) }}"
                            class="btn btn-primary">Comentarios
                            ({{ count($mostrarPublication->comment) }})
                        </a>
                    </div>
                </div>
                <br>
                <!-- Comentarios Mostrar y Ocultar - No Desarrollada -->
                <div style="display: none" id="{{ $mostrarPublication->id }} " class="classCajaCometarios">

                    <form action="javascript:void(0);" method="POST" enctype="multipart/form-data" id="formComments">

                        {{-- {{ csrf_field() }} --}}

                        <meta name="csrf-token" content="{{ csrf_token() }}">

                        <div class="input-group">
                            <div class="file-select">
                                <input type="file" name="imagenPublicacion"
                                    id="imagenPublicacion{{ $mostrarPublication->id }}" aria-label="Archivo">
                            </div>
                            <input type="text" class="form-control" placeholder="Escribe tu Comentario"
                                id="comentarioPublicacion{{ $mostrarPublication->id }}">
                            <button class="btn btn-primary" type="submit"
                                onclick="formComments({{ $mostrarPublication->id }})">Enviar</button>
                        </div>
                        <br>
                    </form>

                    @foreach ($mostrarPublication->comment as $coments)
                        <div class="row row-cols-auto">
                            <div class="col news">
                                <img src="{{ route('foto.perfil', ['filename' => $coments->user->fotoPerfil]) }}">
                            </div>
                            <div class="col">
                                <h4><a href="#">{{ $coments->user->alias }}</a></h4>
                                <p>{{ $coments->contenido }}</p>

                                @if ($coments->imagen != '')
                                    <img
                                        src="{{ route('comentarioImagen', ['filename' => $coments->imagen]) }}"class="margenImagenComment">
                                @endif
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
        </div>
    </div>
@endforeach
