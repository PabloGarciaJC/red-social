@extends('layouts.app')

@section('core-content')
<main id="main" class="game-wrapper">
    <div class="game-container">
        <h2 class="title-games">Ahorcado</h2>
        <p>Adivina la palabra</p>
        <div id="word-display" class="word-display"></div>
        <div id="letters" class="letters"></div>
        <div id="result" class="result"></div>
        <div class="progress-container">
            <div id="progress-bar" class="progress-bar"></div>
        </div>
        <button id="hintButton" class="hint-button">Pedir Pista</button>
        <button id="resetButton" class="reset-button" style="display: none;">Jugar de nuevo</button>
        <div id="hintText" class="result" style="color: #17a2b8; display: none;"></div> <!-- Pista mostrada aquí -->
    </div>
</main>
@endsection
