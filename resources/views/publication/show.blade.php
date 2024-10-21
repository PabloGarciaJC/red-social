@foreach ($publications as $mostrarPublication)
<div class="col-12 mb-3">
    <div class="card info-card sales-card">

        <!-- Mostrar el filtro solo si el usuario autenticado es el dueño de la publicación -->
        @if (Auth::check() && Auth::user()->id === $mostrarPublication->user_id)
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
                        <a class="dropdown-item edit-publication" href="javascript:void(0);">
                            Editar
                        </a>
                        <a class="dropdown-item eliminar-publication" href="{{ route('publicationDelete', ['publicationId' => $mostrarPublication->id]) }}">
                            Eliminar
                        </a>
                    </li>
                </ul>
            </div>
        @endif

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
            <p class="pt-3">{{ $mostrarPublication->contenido }}</p>
            <hr>
            <!-- Carrusel de imágenes -->
            <div class="slick__image">
                <div id="slick-fich-{{ $mostrarPublication->id }}" class="slick-fich slick__contn">
                    @foreach ($mostrarPublication->images as $key => $image)
                    @php 
                    $imagePath = route('publicationImagen', ['filename' => $image->image_path]);
                    $thumbPath = "product_thumb.php?img=" . $imagePath . "&w=122&h=122"; // Lógica para miniaturas
                    @endphp
                    <div class="item {{ $key === 0 ? 'actv' : '' }} imge"
                         data-thumb="{{ $thumbPath }}"
                         data-src="{{ $imagePath }}">
                        <a href="{{ $imagePath }}" data-lightbox="image-{{ $mostrarPublication->id }}">
                            <img class="imge" src="{{ $imagePath }}" />
                        </a>
                    </div>
                    @endforeach
                </div>                
            </div>

            <div class="slick__thumbnails">
                @foreach ($mostrarPublication->images as $key => $image)
                    @php
                        $imagePath = route('publicationImagen', ['filename' => $image->image_path]);
                    @endphp
                    <div class="thumbnail" data-index="{{ $key }}">
                        <img src="{{ $imagePath }}" alt="Thumbnail" class="img-thumbnail" data-path="{{ $image->image_path }}" />
                    </div>
                @endforeach
            </div>
            <div class="row justify-content-end">
                <?php $userLike = $mostrarPublication->like->contains('user_id', Auth::user()->id); ?>

                <div class="col col-lg-2">
                    <div class="d-flex align-items-center gap-5">
                        <div class="btn-like">
                            <i class="bi bi-hand-thumbs-up"></i> Likes (<span class="likes-count">{{ $mostrarPublication->like->where('type', 'like')->count() }}</span>)
                        </div>
                        <div>
                            <div class="btn-dislike">
                                <i class="bi bi-hand-thumbs-down"></i> Dislike (<span class="dislikes-count">{{ $mostrarPublication->like->where('type', 'dislike')->count() }}</span>)
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col col-lg-2 btn__comments">Comentarios ({{ count($mostrarPublication->comment) }})</div>
                <div class="wrapper-comments" style="display: none;">
                    @foreach ($mostrarPublication->comment->sortBy('created_at') as $coments)

                
                        <div class="comments__card">

                            <img src="{{ route('foto.perfil', ['filename' => $coments->user->fotoPerfil]) }}" class="rounded-circle" width="60" height="60" />
                            <div class="comments__description">
                                <div class="comments__body">
                                    <a href="#">{{ $coments->user->alias }}</a>
                                    <p>{{ $coments->contenido }}</p>
                                    @if ($coments->imagen != '')
                                        <img src="{{ route('comentarioImagen', ['filename' => $coments->imagen]) }}" class="img-fluid" style="max-width: 100%; height: auto;">
                                    @endif
                                </div>

                         

                                <div class="comments__btns" data-id-comments="{{ $coments->id }}">
                                    @if (Auth::check() && Auth::user()->id === $coments->user_id)
                                        <a href="{{ route('edit.comments', ['id' => $coments->id]) }}" class="comments__btn-edit">Editar</a>
                                        <a href="{{ route('delete.comments', ['id' => $coments->id]) }}" class="comments__btn-delete">Eliminar</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <form action="{{ route('comentarioSave') }}" method="POST" enctype="multipart/form-data" class="form__comments" data-post-id="{{ $mostrarPublication->id }}">
                        <div class="input-group">
                            <button type="button" class="btn btn-secondary form__emojis-toggle">😄 Emojis</button>
                            <input type="text" class="form-control comentario-input" placeholder="Escribe tu Comentario" name="comentario">
                            <button class="btn btn-primary" type="submit">Enviar</button>
                        </div>
                        <!-- Aquí se inyectará el emoji-picker -->
                        <div class="form__cntn-emojis"></div>
                        <div class="text-center form__collapse">contraer Formulario</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

