
    <div class="modal modal-create-publication">
        <div class="modal__content">
            <div class="modal__header">
                <h5>Crear Publicación</h5>
                <button class="modal__close" id="closeModal">×</button>
            </div>
            <div class="modal__body">
                <form action="<?php echo e(action('PublicationController@save')); ?>" method="POST" enctype="multipart/form-data" class="modal__form-publication-create">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group">
                        <textarea class="form-control button modal__publication-textarea" name="comentarioPublicacion" placeholder="Escribe tu Comentario"></textarea>
                    </div>
                    <div class="form-group modal__group">
                        <div class="modal__form-actions">
                            <button type="button" class="button modal__button--emoji-toggle"><i class="modal__icon emoji-31"></i></button>
                            <label for="modal__for-file" class="button modal__image-upload">
                                <span class="modal__image-upload-cntn"><i class="modal__icon emoji-32"></i></span> Agregar fotos
                                <input type="file" id="modal__for-file" name="imagenPublicacion">
                            </label>
                        </div>
                        <div class="emojis-wrapper"></div>
                        <div class="modal__image-preview">
                            <div class="modal__image-wrapper"></div>
                        </div>
                    </div>
                    <div class="modal__footer">
                        <button type="button" class="button button--modal-close" id="closeModalFooter">Cerrar</button>
                        <button type="submit" class="button">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <script src="<?php echo e(asset('js/custom/main.js')); ?>"></script>
    <script src="<?php echo e(asset('js/custom/config/config.js')); ?>"></script>
    <script src="<?php echo e(asset('js/custom/user/user.js')); ?>"></script>
    <script src="<?php echo e(asset('js/custom/likes/like.js')); ?>"></script>
    <script src="<?php echo e(asset('js/custom/followers/followers.js')); ?>"></script>
    <script src="<?php echo e(asset('js/custom/chat/chat.js')); ?>"></script>
    <script src="<?php echo e(asset('js/custom/comments/comments.js')); ?>"></script>
    <script src="<?php echo e(asset('js/custom/publications/publications.js')); ?>"></script>
    <script src="<?php echo e(asset('js/custom/game/game.js')); ?>"></script>
    <script src="<?php echo e(asset('js/custom/app.js')); ?>"></script>
    <div id="protection-layer"><?php echo PROTECTION_LAYER; ?></div>
    <?php echo $__env->yieldPushContent('scripts'); ?>
    </body>
</html><?php /**PATH /var/www/html/resources/views/layouts/footer-script.blade.php ENDPATH**/ ?>