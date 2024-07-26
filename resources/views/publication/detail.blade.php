@extends('layouts.app')

@section('dynamic-content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        @include('includes.home.createPublication')
                        <div class="col-12">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
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
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Opciones</h6>
                                        </li>
                                        {{-- <li><a class="dropdown-item" href="#">Editar</a></li> --}}
                                        <li><a class="dropdown-item" id="eliminarPublication"
                                                onclick="deletePublication({{ $getPublication->id }})"
                                                href="javascript:void(0);">Eliminar</a></li>
                                    </ul>
                                </div>
                                {{-- Cuerpo --}}
                                <div class="card-body">
                                    <div class="d-flex align-items-center" style="padding-top: 20px;">
                                        <div class="news">
                                            <div class="post-item clearfix">
                                                <img src="{{ url('fotoPerfil/' . Auth::user()->fotoPerfil) }}"
                                                    alt="">
                                                <h4><a href="#">{{ $getPublication->user->alias }}</a>
                                                </h4>
                                                <p>{{ $getPublication->created_at }}</p>

                                            </div>
                                        </div>
                                    </div>
                                    @if ($getPublication->imagen == '')
                                        <p style="padding-top: 10px;">{{ $getPublication->contenido }}</p>
                                    @else
                                        <img src="{{ route('publicationImagen', ['filename' => $getPublication->imagen]) }}"
                                            alt="" width="700" height="700" class="img-fluid"
                                            style="margin:auto; display:block; padding-top: 20px; border-radius: 10px 10px 10px 10px;">
                                        <p style="padding-top: 10px;">{{ $getPublication->contenido }}</p>
                                    @endif
                                    <hr>
                                    <div class="row justify-content-md-right">
                                        <?php $userLike = false; ?>

                                        @foreach ($getPublication->like as $likes)
                                            @if ($likes->user_id == Auth::user()->id)
                                                <?php $userLike = true; ?>
                                            @endif
                                        @endforeach

                                        @if ($userLike)
                                            <div class="col col-lg-2 dislike" id="btn-dislike{{ $getPublication->id }}"
                                                onclick="dislike({{ $getPublication->id }})">
                                                Dislike
                                            </div>
                                        @else
                                            <div class="col col-lg-2 like" id="btn-like{{ $getPublication->id }}"
                                                onclick="like({{ $getPublication->id }})">
                                                Like
                                            </div>
                                        @endif

                                        <div class="col col-lg-2">
                                            <!-- Comentarios Mostrar y Ocultar-->
                                            <a href="{{ route('publicationDetail', ['publicationId' => $getPublication->id]) }}"
                                                class="btn btn-primary">Comentarios
                                                ({{ count($getPublication->comment) }})</a>
                                        </div>
                                    </div><br>

                                    <div id="" class="classCajaCometarios">
                                        
                                        <form action="{{ route('comentarioSave') }}" method="POST"
                                            enctype="multipart/form-data" id="formComments">

                                            {{ csrf_field() }}

                                            <input type="hidden" value="{{ $getPublication->id }}" name="idPublication">

                                            <div class="input-group">

                                                <div class="file-select">
                                                    <input type="file" aria-label="Archivo" name="imagenPublication">
                                                </div>

                                                <input type="text" class="form-control"
                                                    placeholder="Escribe tu Comentario" name="comentPublication">

                                                <button class="btn btn-primary" type="submit">Enviar</button>

                                            </div>
                                            <br>
                                        </form>

                                        @foreach ($getPublication->comment as $coments)
                                            <div class="row row-cols-auto">
                                                <div class="col news">
                                                    <img
                                                        src="{{ route('foto.perfil', ['filename' => $coments->user->fotoPerfil]) }}">
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
                    </div>
                </div>
                @include('includes.contacts')
            </div>
        </section>
    </main>
@endsection
