// Crear Comentarios
window.Echo.channel('broadcastComment-channel')
    .listen('.broadcastComment-event', (e) => {
        switch (e.status) {
            case 'delete':
                let publication = $(`[data-post-id="${e.comment.idPublication}"]`);
                publication.closest('.col-12.mb-3').find($(`[data-id-comments="${e.comment.idComment}"]`)).closest('.comments__card').remove();
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
                window.initComment.delete();
        }
    });



