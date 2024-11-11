@foreach ($publications as $mostrarPublication)
<div class="col-12 mb-3">
    <div class="card info-card sales-card">
        @if (Auth::check() && Auth::user()->id === $mostrarPublication->user_id)
            <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-gear"></i> Opciones
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">                    
                    <li>
                        <a class="dropdown-item edit-publication" href="javascript:void(0);">
                            Editar
                        </a>
                        <a class="dropdown-item eliminar-publication" href="{{ route('publicationDelete', ['publicationId' => $mostrarPublication->id]) }}">
                            Eliminar
                        </a>
                        <a class="dropdown-item comentar-publication"  href="{{ route('comentarioSave') }}" data-publication-id="{{ $mostrarPublication->id }}">
                            Comentar
                        </a>
                    </li>
                </ul>
            </div>
        @endif
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
            <div class="slick__image">
                <div id="slick-fich-{{ $mostrarPublication->id }}" class="slick-fich slick__contn">
                    @foreach ($mostrarPublication->images as $key => $image)
                    @php 
                    $imagePath = route('publicationImagen', ['filename' => $image->image_path]);
                    $thumbPath = "product_thumb.php?img=" . $imagePath . "&w=122&h=122";
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
                <?php 
                $userLike = $mostrarPublication->like->contains('user_id', Auth::user()->id);
                $userLikeStatus = $mostrarPublication->like->where('user_id', Auth::id())->first();
                $hasLiked = $userLikeStatus && $userLikeStatus->type === 'like';
                $hasDisliked = $userLikeStatus && $userLikeStatus->type === 'dislike';
                ?>
                <div class="col col-lg-2 comment__btns-action">
                    <div class="btn-wrapper">
                        <div class="btn-like <?php echo $hasLiked ? 'like' : ''; ?>">
                            <i class="bi bi-hand-thumbs-up"></i> (<span class="likes-count">{{ $mostrarPublication->like->where('type', 'like')->count() }}</span>)
                        </div>                       
                        <div class="btn-dislike <?php echo $hasDisliked ? 'dislike' : ''; ?>">
                            <i class="bi bi-hand-thumbs-down"></i> (<span class="dislikes-count">{{ $mostrarPublication->like->where('type', 'dislike')->count() }}</span>)
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
                                    <a href="{{ route('detalles.perfil', ['perfil' => $mostrarPublication->user->alias, 'estado' => 'confirmado']) }}">{{ $coments->user->alias }}</a>
                                    <p>{{ $coments->contenido }}</p>
                                    @if ($coments->imagen != '')
                                        <img src="{{ route('comentarioImagen', ['filename' => $coments->imagen]) }}"  class="img-fluid" style="max-width: 100%; height: auto;">
                                    @endif
                                </div>
                                <div class="comments__btns" data-id-comments="{{ $coments->id }}">
                                    @if (Auth::check() && Auth::user()->id === $coments->user_id)
                                        <a href="{{ route('edit.comments', ['id' => $coments->id]) }}" class="comments__btn-edit"><i class="emoji-36"></i></a>
                                        <a href="{{ route('delete.comments', ['id' => $coments->id]) }}" class="comments__btn-delete"><i class="emoji-35"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <form action="{{ route('comentarioSave') }}" method="POST" enctype="multipart/form-data" class="form__comments" data-post-id="{{ $mostrarPublication->id }}">
                        <div class="form__comments-group">
                            <input type="text" class="button form-control form__comentario-input" placeholder="Escribe tu Comentario" name="comentario">
                            <button type="button" class="button btn-secondary form__emojis-toggle"><i class="modal__icon emoji-31"></i></button>
                            <button class="button" type="button submit"><i class="form__send-icon emoji-34"></i></button>
                        </div>
                        <div class="emojis-wrapper emojis-wrapper-grid-large"></div>
                        <div class="text-center form__collapse"><i class="modal__icon emoji-37"></i></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

