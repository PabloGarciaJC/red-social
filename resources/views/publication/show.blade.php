@foreach ($publications as $mostrarPublication)
<div class="col-12 mb-3">
    <div class="card info-card sales-card">
        <!-- Filtro -->
        <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown">
                <i class="bi bi-three-dots"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                    <span>Opciones</span>
                </li>
                <li>
                    <a class="dropdown-item eliminar-publication" href="{{ route('publicationDelete', ['publicationId' => $mostrarPublication->id]) }}">
                        Eliminar
                    </a>
                </li>
            </ul>
        </div>
        <!-- Cuerpo -->
        <div class="card-body">
            <div class="d-flex align-items-center pt-3">
                <div class="news">
                    <div class="post-item clearfix">
                        <img src="{{ url('fotoPerfil/' . $mostrarPublication->user->fotoPerfil) }}"
                            alt="{{ $mostrarPublication->user->alias }}'s profile picture"
                            class="rounded-circle" width="50" height="50" />
                        <a href="{{ route('detalles.perfil', ['perfil' => $mostrarPublication->user->alias, 'estado' => 'confirmado', 'idNotificacion' => 0]) }}">
                            {{ $mostrarPublication->user->alias }}
                        </a>
                    </div>
                </div>
            </div>
            @if ($mostrarPublication->imagen == '')
            <p class="pt-3">{{ $mostrarPublication->contenido }}</p>
            @else
            <img src="{{ route('publicationImagen', ['filename' => $mostrarPublication->imagen]) }}"
                alt="Publication Image"
                class="img-fluid rounded mb-3"
                style="max-width: 100%; height: auto;">
            <p class="pt-3">{{ $mostrarPublication->contenido }}</p>
            @endif
            <hr>
            <div class="row justify-content-end">
                <?php $userLike = $mostrarPublication->like->contains('user_id', Auth::user()->id); ?>

                <div class="col col-lg-2">
                    <div class="d-flex align-items-center gap-5">
                        @if($userLike)
                        <div class="btn-dislike">
                            <i class="bi bi-hand-thumbs-down"></i> Dislike
                        </div>
                        @else
                        <div class="btn-like">
                            <i class="bi bi-hand-thumbs-up"></i> Like
                        </div>
                        @endif
                    </div>
                </div>

                <div class="col col-lg-2 btn__comments">Comentarios ({{ count($mostrarPublication->comment) }})</div>
                <div class="wrapper-comments" style="display: none;">
                    @foreach ($mostrarPublication->comment->sortBy('created_at') as $coments)
                    <div class="row row-cols-auto mb-2">
                        <div class="col news">
                            <img src="{{ route('foto.perfil', ['filename' => $coments->user->fotoPerfil]) }}" class="rounded-circle" width="40" height="40" />
                        </div>
                        <div class="col">
                            <a href="#">{{ $coments->user->alias }}</a>
                            <p>{{ $coments->contenido }}</p>
                            @if ($coments->imagen != '')
                            <img src="{{ route('comentarioImagen', ['filename' => $coments->imagen]) }}"
                                alt="Comment Image"
                                class="img-fluid"
                                style="max-width: 100%; height: auto;">
                            @endif
                        </div>
                    </div>
                    @endforeach
                    <form action="{{ route('comentarioSave') }}" method="POST" enctype="multipart/form-data" class="form__comments" data-post-id="{{ $mostrarPublication->id }}">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <div class="input-group">
                            <div class="file-select">
                                <input type="file" name="imagen" aria-label="Archivo">
                            </div>
                            <button type="button" class="btn btn-secondary form__emojis-toggle">😄 Emojis</button>
                            <input type="text" class="form-control comentario-input" placeholder="Escribe tu Comentario" name="comentario">
                            <button class="btn btn-primary" type="submit">Enviar</button>
                        </div>
                        <div class="text-center form__collapse">contraer Formulario</div>
                        <!-- Aquí se inyectará el emoji-picker -->
                        <div class="form__cntn-emojis"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach