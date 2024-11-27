@extends('layouts.app')

@section('core-content')
    <main id="main" class="main">
        <div class="card info-card sales-card">
            <div class="intro-board">
                <div class="card__info card-game">
                    
                    <div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
                        <div class="col">
                            <div class="card info-card feature-card h-90">
                                <a href="{{ route('game.memory') }}" class="card-header card-cntn-memory">
                                    <span class="card-memory"><i class="emoji-40"></i></span>
                                    <span class="card-memory"><i class="emoji-41"></i></span>
                                    <span class="card-memory"><i class="emoji-42"></i></span>
                                    <span class="card-memory"><i class="emoji-43"></i></span>
                                    <span class="card-memory"><i class="emoji-44"></i></span>
                                    <span class="card-memory"><i class="emoji-45"></i></span>
                                    <span class="card-memory"><i class="emoji-46"></i></span>
                                    <span class="card-memory"><i class="emoji-47"></i></span>
                                    <span class="card-memory"><i class="emoji-41"></i></span>  
                                </a>
                                <div class="card-body">
                                    <h3 class="card-title">Juego de Memoria</h3>
                                    <p class="card-text">Pon a prueba tu memoria con este divertido juego. Encuentra todas las parejas de cartas en el menor tiempo posible. Ideal para todas las edades y una excelente forma de ejercitar tu mente.</p>
                                    <a href="{{ route('game.memory') }}" class="btn btn-primary mt-3">¡Jugar ahora!</a>
                                </div>
                            </div>
                        </div>
              
                        <div class="col">
                            <div class="card info-card feature-card h-90">
                                <a href="{{ route('game.trivia') }}" class="card-header card-cntn-trivia">
                                    <div class="answer-option">Danubio <i class="bi bi-check-circle"></i></div>
                                    <div class="answer-option">Volga <i class="bi bi-x-circle"></i></div>
                                    <div class="answer-option">Rin <i class="bi bi-check-circle"></i></div>
                                    <div class="answer-option">Loira <i class="bi bi-x-circle"></i></div>
                                    <div class="answer-option">Rin <i class="bi bi-check-circle"></i></div>
                                    <div class="answer-option">Loira <i class="bi bi-x-circle"></i></div>
                                </a>
                                <div class="card-body">
                                    <h3 class="card-title">Juego de Trivia Quiz</h3>
                                    <p class="card-text">Descubre cuánto sabes con este entretenido juego de preguntas y respuestas. Reta tu conocimiento mientras aprendes datos interesantes. ¿Puedes responderlas todas correctamente?</p>
                                    <a href="{{ route('game.trivia') }}" class="btn btn-primary mt-3">¡Jugar ahora!</a>
                                </div>
                            </div>
                        </div>
            
                        <div class="col">
                            <div class="card info-card feature-card h-90">
                                <div class="card-header card-cntn-memory">
                                    <span class="card-memory"><i class="emoji-40"></i></span>
                                    <span class="card-memory"><i class="emoji-41"></i></span>
                                    <span class="card-memory"><i class="emoji-42"></i></span>
                                    <span class="card-memory"><i class="emoji-43"></i></span>
                                    <span class="card-memory"><i class="emoji-44"></i></span>
                                    <span class="card-memory"><i class="emoji-45"></i></span>
                                    <span class="card-memory"><i class="emoji-46"></i></span>
                                    <span class="card-memory"><i class="emoji-47"></i></span>
                                    <span class="card-memory"><i class="emoji-41"></i></span>  
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">Juego de Ahorcado</h3>
                                    <p class="card-text">Pon a prueba tus habilidades para adivinar palabras en este emocionante juego de Ahorcado. Tendrás que adivinar la palabra secreta antes de que se complete el dibujo del ahorcado.</p>
                                    <a href="{{ route('game.hanged') }}" class="btn btn-primary mt-3">¡Jugar ahora!</a>
                                </div>
                                
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection