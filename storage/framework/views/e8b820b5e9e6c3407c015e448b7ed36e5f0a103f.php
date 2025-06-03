<?php $__env->startSection('core-content'); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/game/trivia.blade.php ENDPATH**/ ?>