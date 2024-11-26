
@extends('layouts.app')

@section('core-content')

<style>
/* Estilo para el contenedor principal */
.memory-game__board {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 15px;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
    padding: 20px;
    box-sizing: border-box;
}

/* Estilo para cada carta */
.memory-game__card {
    background-color: #1e3a8a; /* Fondo azul oscuro para la parte trasera */
    border: 2px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 300px;
    max-height: 300px;
    min-height: 300px;
    position: relative;
    cursor: pointer;
    transition: transform 0.3s;
    transform-style: preserve-3d; 
    perspective: 1000px;
}

/* Parte trasera de la carta - solo muestra el signo de interrogación */
.memory-game__card::after {
    content: "?"; /* Contenido del signo de interrogación */
    font-size: 10rem; /* Tamaño grande */
    color: white; /* Color blanco */
    font-weight: bold;
    display: block;
    position: absolute;
    top: 50%; /* Centrado vertical */
    left: 50%; /* Centrado horizontal */
    transform: translate(-50%, -50%); /* Para centrar exactamente */
    backface-visibility: hidden; /* Ocultar la parte trasera cuando la carta esté volteada */
}

/* Parte delantera de la carta (emoji) */
.memory-game__card::before {
    position: absolute;
    backface-visibility: hidden; /* La parte delantera permanece oculta cuando está volteada */
    background-color: #fff; /* Fondo blanco para la parte delantera */
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 2.5rem; /* Ajusta según el tamaño de las cartas */
    color: #333;
    transform: rotateY(180deg); /* Voltear la parte frontal inicialmente */
    border-radius: 10px; /* Coincidir con el borde de la tarjeta */
}

/* Cuando la carta es volteada (flip) */
.memory-game__card--flipped::after {
    display: none; /* Ocultar el signo de interrogación al voltear la carta */
}

/* Para cartas que coinciden (se debe mostrar el emoji) */
.memory-game__card--matched::after {
    display: none; /* No mostrar el signo de interrogación en cartas emparejadas */
}

/* Mostrar el emoji en la parte delantera cuando la carta se voltea o se empareja */
.memory-game__card--flipped::before,
.memory-game__card--matched::before {
    display: block; /* Asegurar que el emoji sea visible */
}

/* Efecto al voltear */
.memory-game__card--flipped {
    transform: rotateY(180deg); /* Voltear la carta */
}

/* Para cartas que coinciden */
.memory-game__card--matched {
    background-color: #dff0d8;
    border-color: #3c763d;
    pointer-events: none;
  
}


.memory-game__card i {
    width: 155px;
    height: 170px;
}



</style>
<main id="main" class="main">
    <div class="card info-card sales-card">
        <div class="memory-game__board">
            <!-- Las cartas se generarán aquí -->
        </div>
    </div>
</main>


@endsection
