@extends('layouts.app')

@section('content')
<div id="app">
    <main class="py-4">
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <!-- Tarjeta con los usuarios ficticios al lado izquierdo -->
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="card bg-warning-soft p-4 bg-card">
                                        <h1 class="text-center fs-4 fw-bold text-dark">Información Importante</h1>
                                        <p class="mt-3">
                                            Los usuarios proporcionados son ficticios y están destinados para realizar pruebas. Usa el siguiente correo para simular la recuperación de contraseñas y verificar el sistema.
                                        </p>
                                        <div class="row text-center">
                                            <div class="col-12 col-md-6">
                                                <p><strong>Correo:</strong> testing@pablogarciajc.com</p>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <p><strong>Contraseña:</strong> 4vy3BONUmJeqVR!</p>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <a href="https://mail.hostinger.com/?clearSession=true&_user=testing@pablogarciajc.com&_gl=1*usdilw*_gcl_au*NjE0MzQzOTk4LjE3Mjg4MDkwODMuOTU3MTYyNTA2LjE3MzEzNDc2OTYuMTczMTM0Nzk4NQ..&_ga=2.66565486.1936021819.1732135268-1231078246.1731347216" 
                                                target="_blank" 
                                                class="btn btn-primary">
                                                Haz clic aquí para acceder al correo
                                            </a>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center flex-wrap">
                                        <h2 class="text-center fs-4 fw-bold text-dark">Seleciona un usuario</h2>
                                        <div class="row row-cols-1 row-cols-md-2 g-4 text-center">
                                            <!-- Usuario 1 -->
                                            <div class="col">
                                                <div class="card h-100 user-card bg-card" data-email="liam@user.com" data-password="password">
                                                    <div class="card-body d-flex justify-content-center align-items-center">
                                                        <p class="mb-0"><strong>Liam Keller</strong> liam@user.com</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Usuario 2 -->
                                            <div class="col">
                                                <div class="card h-100 user-card bg-card" data-email="sofia@user.com" data-password="password">
                                                    <div class="card-body d-flex justify-content-center align-items-center">
                                                        <p class="mb-0"><strong>Sofía Nakamura</strong> sofia@user.com</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Usuario 3 -->
                                            <div class="col">
                                                <div class="card h-100 user-card bg-card" data-email="marco@user.com" data-password="password">
                                                    <div class="card-body d-flex justify-content-center align-items-center">
                                                        <p class="mb-0"><strong>Marco Santis</strong> marco@user.com</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Usuario 4 -->
                                            <div class="col">
                                                <div class="card h-100 user-card bg-card" data-email="emilia@user.com" data-password="password">
                                                    <div class="card-body d-flex justify-content-center align-items-center">
                                                        <p class="mb-0"><strong>Emilia Fuentes</strong> emilia@user.com</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <style>
                                        .bg-card {
                                            background: #ffffa4b8;
                                            border: 1px solid #007bff;
                                        }

                                        .user-card {
                                            cursor: pointer;
                                            transition: transform 0.3s ease, box-shadow 0.3s ease;
                                            border: 1px solid #007bff;
                                        }
                                    
                                        .user-card:hover {
                                            transform: scale(1.05);
                                            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
                                        }

                                        .text-primary {
                                            color: #007bff;
                                        }
                                    
                                        .text-center {
                                            text-align: center;
                                        }
                                    
                                        .card-body p {
                                            font-size: 1rem;
                                            color: #333;
                                        }

                                        .user-card {cursor: pointer}

                                        .user-card.active {
                                        border: 1px solid #d1f0ff;
                                        background-color: #d1f0ff;
                                        border-color: #a2c2e6;
                                        box-shadow: 0 0 3px 0 #66b9fb;
                                        transition: background-color .15s ease-in-out;
                                        }
                                    </style>
                                </div>
                            </div>
                        </div>

                        <!-- Formulario de Login al lado derecho -->
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">                           
                                        <p class="card-title text-center pb-0 fs-4">Ingrese a su cuenta</p>
                                        <p class="text-center small">Indique email y contraseña para iniciar sesión</p>
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
                        
                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn btn-primary w-100">
                                                {{ __('Login') }}
                                            </button>
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('¿Olvidaste tu contraseña?') }}
                                            </a>
                                        </div>
                                        <div class="col-12 text-center">
                                            <p class="small mb-0">¿No tienes cuenta? <a href="{{ route('register') }}">Crea una cuenta</a></p>
                                            <a href="https://pablogarciajc.com/" class="pt-2 credits__autor">Desarrollado por <strong>PabloGarciaJC</strong></a>     
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</div>

<!-- Script para completar el formulario al hacer clic en la tarjeta de usuario -->
<script>
    // Añade comportamiento de selección a las tarjetas
    document.querySelectorAll('.user-card').forEach(card => {
        card.addEventListener('click', () => {
            // Elimina cualquier selección previa
            document.querySelectorAll('.user-card').forEach(c => c.classList.remove('selected'));
            // Añade clase 'selected' a la tarjeta clickeada
            card.classList.add('selected');
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Obtén todas las tarjetas de usuario
        const userCards = document.querySelectorAll('.user-card');
        const form = document.querySelector('form');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');

        // Recorre todas las tarjetas y añade un evento 'click'
        userCards.forEach(card => {
            card.addEventListener('click', function() {
                // Remueve la clase 'active' de todas las tarjetas
                userCards.forEach(c => c.classList.remove('active'));
                
                // Añade la clase 'active' a la tarjeta seleccionada
                card.classList.add('active');

                // Obtén los datos del correo y la contraseña desde los atributos 'data-'
                const email = card.getAttribute('data-email');
                const password = card.getAttribute('data-password');
                
                // Rellena el formulario con los datos de la tarjeta seleccionada
                emailInput.value = email;
                passwordInput.value = password;
            });
        });

        // Evento para limpiar el formulario al hacer clic fuera de las tarjetas
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.user-card') && !event.target.closest('form')) {
                emailInput.value = '';
                passwordInput.value = '';
                userCards.forEach(c => c.classList.remove('active'));
            }
        });
    });
</script>
@endsection
