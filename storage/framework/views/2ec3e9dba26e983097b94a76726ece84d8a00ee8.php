<?php $__env->startSection('core-content'); ?>
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
        <a href="javascript:void(0)" id="hintButton" class="btn btn-primary mt-3">Pedir Pista</a>
        <a href="javascript:void(0)" id="resetButton" class="btn btn-primary mt-3" style="display: none;">Jugar de nuevo</a>
        <div id="hintText" class="result" style="color: #17a2b8; display: none;"></div> <!-- Pista mostrada aquí -->
    </div>
</main>
<?php $__env->stopSection(); ?>

    
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/game/hanged.blade.php ENDPATH**/ ?>