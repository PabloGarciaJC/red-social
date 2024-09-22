// Crear Comentarios
window.Echo.channel('broadcastComment-channel')
    .listen('.broadcastComment-event', (e) => {
        let comment = e.comment.original.data;
        let contnPublication = $(`[data-post-id="${comment.publication_id}"]`);
        let contenidoHtml = comment.contenido ? `<p>${comment.contenido}</p>` : '<p>No hay contenido</p>';
        let commentButton = contnPublication.closest('.wrapper-comments').prev('.btn__comments');

        let commentHtml = `
            <div class="row row-cols-auto mb-2">
                <div class="col news">
                    <img src="${baseUrl}fotoPerfil/${comment.user.fotoPerfil}" 
                        alt="${comment.user.alias}'s profile picture" 
                        class="rounded-circle" width="40" height="40"/>
                </div>
                <div class="col">
                    <a href="${baseUrl}usuario/${comment.user.alias}?estado=confirmado">${comment.user.name}</a>
                    <p>${contenidoHtml}</p>
                    ${comment.imagen ? `<img src="${baseUrl}comentarioImagen/${comment.imagen}" 
                                        alt="Comment Image" 
                                        class="img-fluid" 
                                        style="max-width: 100%; height: auto;">` : ''}
                </div>
            </div>
        `;
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
    });