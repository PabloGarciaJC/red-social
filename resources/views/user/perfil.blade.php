@extends('layouts.app')

@section('dynamic-content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Perfil</h1>
        </div>
        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            @if (Auth::user()->fotoPerfil)
                                <img src="{{ route('foto.perfil', ['filename' => Auth::user()->fotoPerfil]) }}" alt="Profile"
                                    class="rounded-circle">
                            @else
                                <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                            @endif
                            <h1>{{ Auth::user()->alias }}</h1>
                            <h3>{{ Auth::user()->cargo }}</h3>
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
                                    <button class="nav-link {{ session('message') || $errors->any() ? 'active' : '' }}"
                                        data-bs-toggle="tab" data-bs-target="#perfil-edit">Editar
                                        Perfil</button>
                                </li>
                            </ul>

                            <div class="tab-content pt-2">

                                {{-- Perfil --}}
                                <div class="tab-pane fade show {{ session('message') || $errors->any() ? '' : 'active' }} profile-overview"
                                    id="perfil">
                                    <h5 class="card-title">Sobre Mi</h5>
                                    <p class="small">{{ Auth::user()->sobreMi }}</p>

                                    <h5 class="card-title">Detalles de mi Perfil</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Alias</div>
                                        <div class="col-lg-9 col-md-8">{{ Auth::user()->alias }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Nombre</div>
                                        <div class="col-lg-9 col-md-8">{{ Auth::user()->nombre }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Apellido</div>
                                        <div class="col-lg-9 col-md-8">{{ Auth::user()->apellido }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Empresa</div>
                                        <div class="col-lg-9 col-md-8">{{ Auth::user()->empresa }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Cargo</div>
                                        <div class="col-lg-9 col-md-8">{{ Auth::user()->cargo }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Pais</div>
                                        <div class="col-lg-9 col-md-8">{{ Auth::user()->pais }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Dirección</div>
                                        <div class="col-lg-9 col-md-8">{{ Auth::user()->direccion }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Móvil</div>
                                        <div class="col-lg-9 col-md-8">{{ Auth::user()->movil }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">{{ Auth::user()->email }}</div>
                                    </div>

                                </div>

                                {{-- Editar Perfil --}}
                                <div class="tab-pane fade show {{ session('message') || $errors->any() ? 'active' : '' }} profile-overview"
                                    id="perfil-edit">

                                    @if (session('message'))
                                        <br>
                                        <div class="alert alert-success" role="alert" style="text-align: center">
                                            {{ session('message') }}
                                        </div>
                                    @endif

                                    <form action="{{ action('UserController@actualizar') }}" method="POST"
                                        enctype="multipart/form-data">

                                        {{ csrf_field() }}

                                        <div class="row mb-3">
                                            <label for="fotoPerfil" class="col-md-4 col-lg-3 col-form-label">Foto del
                                                Perfil</label>
                                            <div class="col-md-8 col-lg-9">
                                                @if (Auth::user()->fotoPerfil)
                                                    <img src="{{ route('foto.perfil', ['filename' => Auth::user()->fotoPerfil]) }}"
                                                        id="previe" alt="fotoPerfil">
                                                @else
                                                    <img src="assets/img/profile-img.jpg" id="previe" alt="fotoPerfil">
                                                @endif
                                                <div class="pt-2">
                                                    <input type="file" name="fotoPerfil" id="fotoPerfil"
                                                        onchange="vista_preliminar(event)">
                                                </div>
                                                @if ($errors->has('fotoPerfil'))
                                                    <strong style="color: red">{{ $errors->first('fotoPerfil') }}</strong>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="nombre" class="col-md-4 col-lg-3 col-form-label">Alias</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="alias" type="text" class="form-control" id="alias"
                                                    value="{{ Auth::user()->alias }}" disabled>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="nombre" class="col-md-4 col-lg-3 col-form-label">Nombre</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="nombre" type="text" class="form-control" id="nombre"
                                                    value="{{ Auth::user()->nombre }}">
                                                @if ($errors->has('nombre'))
                                                    <strong style="color: red">{{ $errors->first('nombre') }}</strong>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="apellido"
                                                class="col-md-4 col-lg-3 col-form-label">Apellido</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="apellido" type="text" class="form-control"
                                                    id="apellido" value="{{ Auth::user()->apellido }}">
                                                @if ($errors->has('apellido'))
                                                    <strong style="color: red">{{ $errors->first('apellido') }}</strong>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="empresa" class="col-md-4 col-lg-3 col-form-label">Empresa</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="empresa" type="text" class="form-control" id="empresa"
                                                    value="{{ Auth::user()->empresa }}">
                                                @if ($errors->has('empresa'))
                                                    <strong style="color: red">{{ $errors->first('empresa') }}</strong>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="cargo" class="col-md-4 col-lg-3 col-form-label">Cargo</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="cargo" type="text" class="form-control" id="cargo"
                                                    value="{{ Auth::user()->cargo }}">
                                                @if ($errors->has('cargo'))
                                                    <strong style="color: red">{{ $errors->first('cargo') }}</strong>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="pais" class="col-md-4 col-lg-3 col-form-label">Pais</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="pais" type="text" class="form-control" id="pais"
                                                    value="{{ Auth::user()->pais }}">
                                                @if ($errors->has('pais'))
                                                    <strong style="color: red">{{ $errors->first('pais') }}</strong>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="direccion"
                                                class="col-md-4 col-lg-3 col-form-label">Dirección</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="direccion" type="text" class="form-control"
                                                    id="direccion" value="{{ Auth::user()->direccion }}">
                                                @if ($errors->has('direccion'))
                                                    <strong style="color: red">{{ $errors->first('direccion') }}</strong>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="movil" class="col-md-4 col-lg-3 col-form-label">Móvil</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="movil" type="text" class="form-control" id="movil"
                                                    value="{{ Auth::user()->movil }}">
                                                @if ($errors->has('movil'))
                                                    <strong style="color: red">{{ $errors->first('movil') }}</strong>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="text" class="form-control" id="email"
                                                    value="{{ Auth::user()->email }}" disabled>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="sobreMi" class="col-md-4 col-lg-3 col-form-label">Sobre
                                                Mi</label>
                                            <div class="col-md-8 col-lg-9">
                                                <textarea name="sobreMi" class="form-control" id="sobreMi" style="height: 100px">{{ Auth::user()->sobreMi }}</textarea>
                                                @if ($errors->has('sobreMi'))
                                                    <strong style="color: red">{{ $errors->first('sobreMi') }}</strong>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>
@endsection
