window.Echo.channel('broadcastPublication-channel')
    .listen('.broadcastPublication-event', (e) => {


        switch (e.status) {
            case 'delete':
                let contnPublication = $(`[data-post-id="${e.publication}"]`);
                contnPublication.closest('.col-12.mb-3').remove();
                break;
            default:
                let publication = e.publication.publication;
                let user = publication.user;
                let contenido = (publication.contenido ?? '').trim();
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                let imagePaths = e.publication.imagePaths

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
                                                class="rounded-circle" width="50" height="50"/>
                                            <a href="/usuario/${user.alias}?estado=confirmado&idNotificacion=0">
                                                ${user.alias}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-sheet__image">
                                    <div id="slick-fich-${publication.id}" class="slick-fich product-sheet__contn-slick">
                                        ${Array.isArray(imagePaths) && imagePaths.length > 0 ? imagePaths.map((image, key) => `
                                                <div class="item ${key === 0 ? 'actv' : ''} imge"
                                                    data-thumb="/product_thumb.php?img=/publicationImagen/${image}&w=122&h=122"
                                                    data-src="/publicationImagen/${image}">
                                                    <a href="/publicationImagen/${image}" data-lightbox="image-${publication.id}" data-title="Imagen ${key + 1}">
                                                        <img class="imge" src="/publicationImagen/${image}" alt="Imagen de publicación ${key + 1}" />
                                                    </a>
                                                </div>
                                                `).join('')
                                        : ''
                                        }
                                    </div>
                                </div>
                                <!-- Aquí añadimos el contenedor de miniaturas -->
                                <div class="product-sheet__thumbnails">
                                    ${Array.isArray(imagePaths) && imagePaths.length > 0 ? imagePaths.map((image, key) => `
                                        <div class="thumbnail" data-src="/publicationImagen/${image}">
                                            <img src="/publicationImagen/${image}" alt="Thumbnail de publicación ${key + 1}" />
                                        </div>
                                    `).join('')
                                    : ''
                                    }
                                </div>
                                ${contenido !== '' ? `<p class="pt-3">${contenido}</p>` : ''}
                                <hr>
                                <div class="row justify-content-end">
                                    <div class="col col-lg-2">
                                        <div class="d-flex align-items-center gap-5">
                                            <div class="btn-like">
                                                <i class="bi bi-hand-thumbs-up"></i> Like
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
                                                <!-- Aquí se inyectará el emoji-picker -->
                                                <div class="form__cntn-emojis"></div>
                                                <div class="text-center form__collapse">contraer Formulario</div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;

                $('#exampleModal').after(cardHtml);

                // Llamada a los métodos desde la clase
                window.initComment.startCommentClass();
                window.initLike.startLikeClass();
                window.initApp.startAppClass();
        }
    });
