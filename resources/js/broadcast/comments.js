// Crear Comentarios
window.Echo.channel('broadcastComment-channel')
    .listen('.broadcastComment-event', (e) => {
        switch (e.status) {
            case 'edit':
                let editComment = e.comment.data;

                let contnPublicacion = $(`[data-post-id="${editComment.idPublication}"]`).closest('.col-12.mb-3');

                let commentsBody = contnPublicacion.find($(`[data-id-comments="${editComment.id}"]`)).closest('.comments__description').find('.comments__body');

                let existingParagraphs = commentsBody.find('p');

                // Obtener el contenido y reemplazar múltiples saltos de línea con un único salto de línea
                let newContent = editComment.contenido.replace(/\n+/g, '\n').trim();

                // Comprobar si el contenido ya existe
                if (existingParagraphs.text() !== newContent) {
                    // Limpiar los párrafos existentes
                    existingParagraphs.remove();

                    // Crear un nuevo párrafo
                    commentsBody.append(`<p>${newContent}</p>`);
                }
                break;
            case 'delete':
                let publication = $(`[data-post-id="${e.comment.idPublication}"]`);
                let commentCard = publication.closest('.col-12.mb-3').find($(`[data-id-comments="${e.comment.idComment}"]`)).closest('.comments__card');

                // Eliminar el comentario de la interfaz
                commentCard.remove();

                // Actualizar el contador de comentarios
                let commentButtone = publication.closest('.wrapper-comments').prev('.btn__comments');
                if (commentButtone.length > 0) {
                    let buttonText = commentButtone.text().trim();
                    let match = buttonText.match(/\d+/);
                    if (match) {
                        let currentCount = parseInt(match[0]);
                        let newCount = currentCount > 0 ? currentCount - 1 : 0; // Asegúrate de no tener un contador negativo
                        commentButtone.text(`Comentarios (${newCount})`);
                    }
                }
                break;
            default:
                let comment = e.comment.original.data;
                let contnPublication = $(`[data-post-id="${comment.publication_id}"]`);
                let contenidoHtml = comment.contenido ? `<p>${comment.contenido}</p>` : '';
                let commentButton = contnPublication.closest('.wrapper-comments').prev('.btn__comments');
                let buttonsHtml = '';

                // Verifica si el usuario que está logueado es el creador del comentario
                if (window.userLogin === comment.user.id) {
                    buttonsHtml = `
                        <a href="${baseUrl}editarComentario/${comment.id}" class="comments__btn-edit">Editar</a>
                        <a href="${baseUrl}borrarComentario/${comment.id}" class="comments__btn-delete">Eliminar</a>
                    `;
                }

                let commentHtml = `
                    <div class="comments__card">
                    <img src="${baseUrl}fotoPerfil/${comment.user.fotoPerfil}" class="rounded-circle" width="60" height="60" />
                    <div class="comments__description">
                        <div class="comments__body">
                            <a href="${baseUrl}usuario/${comment.user.alias}?estado=confirmado">${comment.user.name}</a>
                            <p>${contenidoHtml}</p>
                            ${comment.imagen ? `<img src="${baseUrl}comentarioImagen/${comment.imagen}" class="img-fluid" style="max-width: 100%; height: auto;">` : ''}
                        </div>
                        <div class="comments__btns" data-id-comments=${comment.id}>
                             ${buttonsHtml}
                        </div>
                    </div>
                </div>`;

                // Encuentra el contenedor de comentarios asociado con el ID de la publicación e inyeacta el comentario
                contnPublication.before(commentHtml);

                // Actualiza el coteo del comentario
                if (commentButton.length === 0) {
                    return;
                }

                let buttonText = commentButton.text().trim();
                let match = buttonText.match(/\d+/);
                if (!match) {
                    return;
                }
                let currentCount = parseInt(match[0]);
                let newCount = currentCount + 1;
                commentButton.text(`Comentarios (${newCount})`);

                // Llamada a los métodos desde la clase
                window.initComment.delete('.comments__btn-delete');
                window.initComment.edit('.comments__btn-edit');
        }

    });



