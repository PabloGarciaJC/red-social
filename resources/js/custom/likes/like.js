class LikeClass {
    
    updateCounts(contnPublication, likesCount, dislikesCount) {
        contnPublication.find('.btn-like span').text(likesCount);
        contnPublication.find('.btn-dislike span').text(dislikesCount);
    }
    
    handleLike() {
        $(".card-body").on("click", ".btn-like", (e) => {
            let form = $(e.target).closest('.card-body').find('form.form__comments');
            let postId = form.data('post-id');

            $.ajax({
                type: "GET",
                url: `${baseUrl}like/${postId}`,
                success: (response) => {
                    // Selección corregida de contenedor
                    let contnPublication = form.closest('.card-body');
                    this.updateCounts(contnPublication, response.likes_count, response.dislikes_count);

                    let btnLike = contnPublication.find('.btn-like');
                    let btnDislike = contnPublication.find('.btn-dislike');

                    if (response.status === 'like') {
                        // Añadir clase "like" y quitar "dislike"
                        btnLike.addClass('like');
                        btnDislike.removeClass('dislike');
                    } else if (response.status === 'removed_like') {
                        // Quitar clase "like"
                        btnLike.removeClass('like');
                    }
                }
            });
        });
    }

    handleDislike() {
        $(".card-body").on("click", ".btn-dislike", (e) => {
            let form = $(e.target).closest('.card-body').find('form.form__comments');
            let postId = form.data('post-id');

            $.ajax({
                type: "GET",
                url: `${baseUrl}dislike/${postId}`,
                success: (response) => {
                    // Selección corregida de contenedor
                    let contnPublication = form.closest('.card-body');
                    this.updateCounts(contnPublication, response.likes_count, response.dislikes_count);

                    let btnLike = contnPublication.find('.btn-like');
                    let btnDislike = contnPublication.find('.btn-dislike');

                    if (response.status === 'dislike') {
                        // Añadir clase "dislike" y quitar "like"
                        btnDislike.addClass('dislike');
                        btnLike.removeClass('like');
                    } else if (response.status === 'removed_dislike') {
                        // Quitar clase "dislike"
                        btnDislike.removeClass('dislike');
                    }
                }
            });
        });
    }

    // Método para inicializar la clase
    startLikeClass() {
        this.handleLike();
        this.handleDislike();
    }
}

// Instanciar y ejecutar la clase
window.initLike = new LikeClass();
window.initLike.startLikeClass();
