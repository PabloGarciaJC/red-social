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
                let slickThumbnails = publicationElement.closest('.col-12.mb-3').find('.slick__thumbnails');
                // Actualizo el comentario
                publicationElement.closest('.col-12.mb-3').find('p').first().text(publicationIdentifier.contenido);

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
                            <img class="imge" src="${imagePath}" alt="Imagen ${key + 1}"/>
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
                        <img src="${imagePath}" alt="Thumbnail" class="img-thumbnail" data-path="${imagePath}"/>
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
                let imagePaths = e.publication.imagePaths;

                // Obtener conteo de likes y dislikes
                let likesCount = publication.like.filter(like => like.type === 'like').length;
                let dislikesCount = publication.like.filter(like => like.type === 'dislike').length;

                // Inicializar la variable opcionesHtml vacía
                let opcionesHtml = '';
                
                // Opciones de Filtros
                if (window.userLogin === user.id) {
                    opcionesHtml = `
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown">
                                 <i class="bi bi-gear"></i> Opciones
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li>
                                    <a class="dropdown-item edit-publication" href="javascript:void(0);">Editar</a>
                                    <a class="dropdown-item eliminar-publication" href="${baseUrl}publicationDelete/${publication.id}">Eliminar</a>
                                </li>
                            </ul>
                        </div>
                    `;
                }

                // Generar HTML para la publicación
                let cardHtml = `
                        <div class="col-12 mb-3">
                            <div class="card info-card sales-card">
                                    ${opcionesHtml}
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
                                    ${contenido !== '' ? `<p class="pt-3">${contenido}</p>` : ''}
                                    <hr>
                                    <div class="slick__image">
                                        <div id="slick-fich-${publication.id}" class="slick-fich slick__contn">
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
                                    <div class="slick__thumbnails">
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
                                    <div class="row justify-content-end">
                                        <div class="col col-lg-2 comment__btns-action">
                                            <div class="btn-wrapper">
                                                <div class="btn-like">
                                                    <i class="bi bi-hand-thumbs-up"></i> (<span class="likes-count">${likesCount}</span>)
                                                </div>                                              
                                                <div class="btn-dislike">
                                                    <i class="bi bi-hand-thumbs-down"></i> (<span class="dislikes-count">${dislikesCount}</span>)
                                                </div>                                                
                                            </div>
                                        </div>
                                        <div class="col col-lg-2 btn__comments">Comentarios (0)</div>
                                        <div class="wrapper-comments" style="display: none;">
                                            <form action="${baseUrl}comentarioSave" method="POST" enctype="multipart/form-data" class="form__comments" data-post-id="${publication.id}">
                                                <div class="input-group">
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
                        </div>`;
                        
                $('#exampleModal').after(cardHtml);

                // Llamada a los métodos desde la clase
                window.initPublication.startPublicationClass();
                window.initComment.startCommentClass();
                window.initLike.startLikeClass();
                window.initApp.startAppClass();
        }
    });
