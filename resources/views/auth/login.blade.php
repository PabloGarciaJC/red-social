@extends('layouts.app')

@section('content')
<div id="app">
    <main class="py-4">
        <div class="container">
            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/logo.png" alt="">
                                    <span class="d-none d-lg-block">PabloSocial</span>
                                </a>
                            </div><!-- End Logo -->
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Ingrese a su cuenta</h5>
                                        <p class="text-center small">Indique email y contraseña para iniciar sesión
                                        </p>
                                    </div>
                                    <form method="POST" action="{{ route('login') }}" class="row g-3 needs-validation">
                                        @csrf
                        
                                        <div class="col-12">
                                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>
                                            <input id="email" type="email"
                                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                                value="{{ old('email') }}" required autofocus>
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                        
                                        <div class="col-12">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                            <input id="password" type="password"
                                                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                        
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                    {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                        
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary w-100">
                                                {{ __('Login') }}
                                            </button>
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('¿Olvidaste tu contraseña?') }}
                                            </a>
                                        </div>
                        
                                        <div class="col-12">
                                            <p class="small mb-0">¿No tienes cuenta? <a href="{{ route('register') }}">Crea una
                                                    cuenta</a></p>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="credits">
                                Desarrollado por <strong>PabloGarciaJC</strong></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</div>
@endsection
