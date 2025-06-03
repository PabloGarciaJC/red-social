<?php $__currentLoopData = $publications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mostrarPublication): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-12 mb-3">
    <div class="card info-card sales-card">
        <?php if(Auth::check() && Auth::user()->id === $mostrarPublication->user_id): ?>
            <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-gear"></i> Opciones
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">                    
                    <li>
                        <a class="dropdown-item edit-publication" href="javascript:void(0);">
                            Editar
                        </a>
                        <a class="dropdown-item eliminar-publication" href="<?php echo e(route('publicationDelete', ['publicationId' => $mostrarPublication->id])); ?>">
                            Eliminar
                        </a>
                        <a class="dropdown-item comentar-publication"  href="<?php echo e(route('comentarioSave')); ?>" data-publication-id="<?php echo e($mostrarPublication->id); ?>">
                            Comentar
                        </a>
                    </li>
                </ul>
            </div>
        <?php endif; ?>
        <div class="card-body">
            <div class="d-flex align-items-center pt-3">
                <div class="news">
                    <div class="post-item clearfix">
                        <img src="<?php echo e(url('fotoPerfil/' . $mostrarPublication->user->fotoPerfil)); ?>"
                            alt="<?php echo e($mostrarPublication->user->alias); ?>'s profile picture"
                            class="rounded-circle" width="50" height="50" />
                        <a href="<?php echo e(route('detalles.perfil', ['perfil' => $mostrarPublication->user->alias, 'estado' => 'confirmado', 'idNotificacion' => 0])); ?>">
                            <?php echo e($mostrarPublication->user->alias); ?>

                        </a>
                    </div>
                </div>
            </div>
            <p class="pt-3"><?php echo e($mostrarPublication->contenido); ?></p>
            <hr>
            <div class="slick__image">
                <div id="slick-fich-<?php echo e($mostrarPublication->id); ?>" class="slick-fich slick__contn">
                    <?php $__currentLoopData = $mostrarPublication->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php 
                    $imagePath = route('publicationImagen', ['filename' => $image->image_path]);
                    $thumbPath = "product_thumb.php?img=" . $imagePath . "&w=122&h=122";
                    ?>
                    <div class="item <?php echo e($key === 0 ? 'actv' : ''); ?> imge"
                         data-thumb="<?php echo e($thumbPath); ?>"
                         data-src="<?php echo e($imagePath); ?>">
                        <a href="<?php echo e($imagePath); ?>" data-lightbox="image-<?php echo e($mostrarPublication->id); ?>">
                            <img class="imge" src="<?php echo e($imagePath); ?>" />
                        </a>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>                
            </div>
            <div class="slick__thumbnails">
                <?php $__currentLoopData = $mostrarPublication->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $imagePath = route('publicationImagen', ['filename' => $image->image_path]);
                    ?>
                    <div class="thumbnail" data-index="<?php echo e($key); ?>">
                        <img src="<?php echo e($imagePath); ?>" alt="Thumbnail" class="img-thumbnail" data-path="<?php echo e($image->image_path); ?>" />
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="row justify-content-end">
                <?php 
                $userLike = $mostrarPublication->like->contains('user_id', Auth::user()->id);
                $userLikeStatus = $mostrarPublication->like->where('user_id', Auth::id())->first();
                $hasLiked = $userLikeStatus && $userLikeStatus->type === 'like';
                $hasDisliked = $userLikeStatus && $userLikeStatus->type === 'dislike';
                ?>
                <div class="col col-lg-2 comment__btns-action">
                    <div class="btn-wrapper">
                        <div class="btn-like <?php echo $hasLiked ? 'like' : ''; ?>">
                            <i class="bi bi-hand-thumbs-up"></i> (<span class="likes-count"><?php echo e($mostrarPublication->like->where('type', 'like')->count()); ?></span>)
                        </div>                       
                        <div class="btn-dislike <?php echo $hasDisliked ? 'dislike' : ''; ?>">
                            <i class="bi bi-hand-thumbs-down"></i> (<span class="dislikes-count"><?php echo e($mostrarPublication->like->where('type', 'dislike')->count()); ?></span>)
                        </div>                      
                    </div>
                </div>
                <div class="col col-lg-2 btn__comments">Comentarios (<?php echo e(count($mostrarPublication->comment)); ?>)</div>
                <div class="wrapper-comments" style="display: none;">
                    <?php $__currentLoopData = $mostrarPublication->comment->sortBy('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coments): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="comments__card">
                            <img src="<?php echo e(route('foto.perfil', ['filename' => $coments->user->fotoPerfil])); ?>" class="rounded-circle" width="60" height="60" />
                            <div class="comments__description">
                                <div class="comments__body">
                                    <a href="<?php echo e(route('detalles.perfil', ['perfil' => $mostrarPublication->user->alias, 'estado' => 'confirmado'])); ?>"><?php echo e($coments->user->alias); ?></a>
                                    <p><?php echo e($coments->contenido); ?></p>
                                    <?php if($coments->imagen != ''): ?>
                                        <img src="<?php echo e(route('comentarioImagen', ['filename' => $coments->imagen])); ?>"  class="img-fluid" style="max-width: 100%; height: auto;">
                                    <?php endif; ?>
                                </div>
                                <div class="comments__btns" data-id-comments="<?php echo e($coments->id); ?>">
                                    <?php if(Auth::check() && Auth::user()->id === $coments->user_id): ?>
                                        <a href="<?php echo e(route('edit.comments', ['id' => $coments->id])); ?>" class="comments__btn-edit"><i class="emoji-36"></i></a>
                                        <a href="<?php echo e(route('delete.comments', ['id' => $coments->id])); ?>" class="comments__btn-delete"><i class="emoji-35"></i></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <form action="<?php echo e(route('comentarioSave')); ?>" method="POST" enctype="multipart/form-data" class="form__comments" data-post-id="<?php echo e($mostrarPublication->id); ?>">
                        <div class="form__comments-group">
                            <input type="text" class="button form-control form__comentario-input" placeholder="Escribe tu Comentario" name="comentario">
                            <button type="button" class="button btn-secondary form__emojis-toggle"><i class="modal__icon emoji-31"></i></button>
                            <button class="button" type="button submit"><i class="form__send-icon emoji-34"></i></button>
                        </div>
                        <div class="emojis-wrapper emojis-wrapper-grid-large"></div>
                        <div class="text-center form__collapse"><i class="modal__icon emoji-37"></i></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php /**PATH /var/www/html/resources/views/publication/show.blade.php ENDPATH**/ ?>