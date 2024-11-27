@extends('layouts.app')

@section('core-content')
<main id="main" class="main">
    <div class="card info-card sales-card">
        <div class="quiz-container">
            <div class="quiz-header">
                <h2>Trivia Quiz: (Pregunta <span id="current-question"></span> de <span id="total-questions"></span>)</h2>
            </div>
            <div id="quiz">
                <p class="quiz-question"></p>
                <ul class="quiz-options"></ul>
            </div>
            <div id="quiz-result" class="hidden">
                <p class="quiz-result"></p>
                <a class="btn btn-primary " id="restart-btn">Restart Quiz</a>
            </div>
        </div>
    </div>
</main>
@endsection
