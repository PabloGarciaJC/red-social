// Agregar este script después de instanciar LikeClass
Echo.channel('broadcastLikes-channel')
    .listen('.broadcastLikes-event', (e) => {
        let postId = e.postId;
        // Selecciona el contenedor de la publicación usando el data-post-id
        let contnPublication = $(`[data-post-id="${postId}"]`).closest('.row.justify-content-end');
        // Actualiza los contadores en la UI
        contnPublication.find('.btn-like span').text(e.likes);
        contnPublication.find('.btn-dislike span').text(e.dislike);
    });
