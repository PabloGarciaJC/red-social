window.Echo.channel('broadcastPublication-channel')
    .listen('.broadcastPublication-event', (e) => {
        switch (e.status) {
            case 'delete':
                let contnPublication = $(`[data-post-id="${e.publication}"]`);
                contnPublication.closest('.col-12.mb-3').remove();
                break;
            case 'edit':

                let publicationIdentifier = e.publication.publication;
                let publicationElement = $(`[data-post-id="${publicationIdentifier.id}"]`);
                let slickContainer = publicationElement.closest('.col-12.mb-3').find('.slick-fich');
                let slickThumbnails = publicationElement.closest('.col-12.mb-3').find('.product-sheet__thumbnails');
           
                // Verificar si slick está inicializado antes de destruir
                if (slickContainer.hasClass('slick-initialized')) {
                    slickContainer.slick('unslick');
                }

                // Vaciar el contenedor de miniaturas y el carrusel de imágenes
                slickContainer.empty();
                slickThumbnails.empty();

                let newImagesHtmlCarrusel = e.publication.imagePaths.map((image, key) => {
                    let imagePath = `/publicationImagen/${image}`;
                    return `
                    <div class="item ${key === 0 ? 'actv' : ''} imge"
                         data-thumb="${imagePath}"
                         data-src="${imagePath}">
                        <a href="${imagePath}" data-lightbox="image-${publicationIdentifier.id}">
                            <img class="imge" src="${imagePath}" alt="Imagen ${key + 1}" />
                        </a>
                    </div>`;
                }).join('');

                // Añadir nuevas imágenes y miniaturas
                slickContainer.append(newImagesHtmlCarrusel);

                // Generar nuevas miniaturas y HTML para el carrusel
                let newImagesHtmlThumbnails = e.publication.imagePaths.map((image, key) => {
                    let imagePath = `/publicationImagen/${image}`;
                    return `
                    <div class="thumbnail" data-src="${imagePath}" data-index="${key}">
                        <img src="${imagePath}" alt="Thumbnail de publicación ${key + 1}" />
                    </div>`;
                }).join('');

                slickThumbnails.append(newImagesHtmlThumbnails);

                // Se reinicia Slick
                slickContainer.each(function () {
                    if ($(this).hasClass('slick-initialized')) {
                      $(this).slick('unslick');
                    }
                    $(this).slick({
                      dots: false,
                      infinite: true,
                      speed: 500,
                      slidesToShow: 1,
                      slidesToScroll: 1,
                      autoplay: false,
                      autoplaySpeed: 2000,
                    });
                  });
                break;
            default:
                let publication = e.publication.publication;
                let user = publication.user;
                let contenido = (publication.contenido ?? '').trim();
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                let imagePaths = e.publication.imagePaths;

                // Obtener conteo de likes y dislikes
                let likesCount = publication.like.filter(like => like.type === 'like').length;
                let dislikesCount = publication.like.filter(like => like.type === 'dislike').length;

                // Generar HTML para la publicación
                let cardHtml = `
                        <div class="col-12 mb-3">
                            <div class="card info-card sales-card">
                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <span>Opciones</span>
                                        </li>
                                        <li>
                                            <a class="dropdown-item edit-publication" href="javascript:void(0);">
                                                Editar
                                            </a>
                                            <a class="dropdown-item eliminar-publication" href="${baseUrl}publicationDelete/${publication.id}">
                                                Eliminar
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center pt-3">
                                        <div class="news">
                                            <div class="post-item clearfix">
                                                <img src="/fotoPerfil/${user.fotoPerfil}"
                                                    alt="${user.alias}'s profile picture"
                                                    class="rounded-circle" width="50" height="50" />
                                                <a href="/usuario/${user.alias}?estado=confirmado&idNotificacion=0">
                                                    ${user.alias}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-sheet__image">
                                        <div id="slick-fich-${publication.id}" class="slick-fich product-sheet__contn-slick">
                                            ${Array.isArray(imagePaths) && imagePaths.length > 0 ? imagePaths.map((image, key) => {
                                            // Define la ruta de la imagen y la miniatura
                                            let imagePath = `/publicationImagen/${image}`;
                                            let thumbPath = `/product_thumb.php?img=${imagePath}&w=122&h=122`;
                                            // Retorna el HTML para cada imagen en el carrusel
                                            return `
                                                    <div class="item ${key === 0 ? 'actv' : ''} imge"
                                                        data-thumb="${thumbPath}"
                                                        data-src="${imagePath}">
                                                        <a href="${imagePath}" data-lightbox="image-${publication.id}" data-title="Imagen ${key + 1}">
                                                            <img class="imge" src="${imagePath}" alt="Imagen de publicación ${key + 1}" />
                                                        </a>
                                                    </div> `;
                                            }).join('') : ''}
                                        </div>
                                    </div>
                                    <div class="product-sheet__thumbnails">
                                        ${Array.isArray(imagePaths) && imagePaths.length > 0 ? imagePaths.map((image, key) => {
                                        // Define la ruta de la imagen
                                        let imagePath = `/publicationImagen/${image}`;

                                        // Retorna el HTML para cada miniatura
                                        return `
                                                <div class="thumbnail" data-src="${imagePath}">
                                                    <img src="${imagePath}" alt="Thumbnail de publicación ${key + 1}" />
                                                </div>`;

                                        }).join('') : ''}
                                    </div>
                                    ${contenido !== '' ? `<p class="pt-3">${contenido}</p>` : ''}
                                    <hr>
                                        <div class="row justify-content-end">
                                            <div class="col col-lg-2">
                                                <div class="d-flex align-items-center gap-5">
                                                    <div class="btn-like">
                                                        <i class="bi bi-hand-thumbs-up"></i> Likes (<span class="likes-count">${likesCount}</span>)
                                                    </div>
                                                    <div>
                                                        <div class="btn-dislike">
                                                            <i class="bi bi-hand-thumbs-down"></i> Dislikes (<span class="dislikes-count">${dislikesCount}</span>)
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col col-lg-2 btn__comments">Comentarios (0)</div>
                                            <div class="wrapper-comments" style="display: none;">
                                                <form action="${baseUrl}comentarioSave" method="POST" enctype="multipart/form-data" class="form__comments" data-post-id="${publication.id}">
                                                    <input type="hidden" name="_token" value="${csrfToken}">
                                                        <div class="input-group">
                                                            <label class="modal__image-upload">
                                                                <span class="modal__image-upload__icon">📁</span> Subir Imagen o Video
                                                                <input type="file" class="form-control-file image-commets" name="imagen">
                                                            </label>
                                                            <button type="button" class="btn btn-secondary form__emojis-toggle">😄 Emojis</button>
                                                            <input type="text" class="form-control comentario-input" placeholder="Escribe tu Comentario" name="comentario">
                                                                <button class="btn btn-primary" type="submit">Enviar</button>
                                                        </div>
                                                        <div class="form__cntn-emojis"></div>
                                                        <div class="text-center form__collapse">contraer Formulario</div>
                                                </form>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Modal - Crear Publicación, se repite-->
                        <div class="modal modal-edit">
                            <div class="modal__content">
                                <div class="modal__header">
                                    <h5>Editar Publicación</h5>
                                    <button class="modal__close modal__close--icon">×</button>
                                </div>
                                <div class="modal__body">
                                    <form action="{{ action('PublicationController@edit') }}" method="POST" enctype="multipart/form-data" class="form-publication__edit">
                                        <!-- CSRF Token -->
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="commentTextarea">Escribe tu Comentario</label>
                                            <textarea class="form-control publication-input" name="editcomentariopublicacion"></textarea>
                                        </div>
                                        <input type="hidden" class="id-post__edit">
                                        <div class="form-group">
                                            <label for="image-file-edit-publication" class="modal__image-upload">
                                                <span class="modal__image-upload__icon">➕</span> Subir Imagenes
                                                <input type="file" class="form-control-file" id="image-file-edit-publication" name="editimagenpublicacion">
                                            </label>
                                            <button type="button" class="modal__button--emoji-toggle">😊</button>
                                            <!-- Aquí se inyectará el emoji-picker -->
                                            <div class="form__cntn-emojis"></div>
                                            <!-- Contenedor de las vistas previas de las imágenes -->
                                            <div class="modal__image-preview" style="display: none;">
                                                <div class="modal__edit-image-wrapper"></div>
                                            </div>
                                        </div>
                                        <div class="modal__footer">
                                            <button type="submit" class="button">Aceptar</button>
                                            <button type="button" class="button button--modal-close" id="closeModalFooter">Cerrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>`;

                $('#exampleModal').after(cardHtml);

                // Llamada a los métodos desde la clase
                window.initPublication.startPublicationClass();
                window.initComment.startCommentClass();
                window.initLike.startLikeClass();
                window.initApp.startAppClass();
        }
    });
