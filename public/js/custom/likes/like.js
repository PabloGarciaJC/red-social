class LikeClass {
  // Método para inicializar la clase
  startLikeClass() {
      this.handleLike();
      this.handleDislike();
  }

  handleLike() {
      $(".card-body").on("click", ".btn-like", (e) => {
          let form = $(e.target).closest('.card-body').find('form.form__comments');
          let postId = form.data('post-id');

          $.ajax({
              type: "GET",
              url: `${baseUrl}like/${postId}`,
              success: (response) => {
                  // Manejar la respuesta
                  let contnPublication = $(`[data-post-id="${postId}"]`).closest('.row.justify-content-end');

                  if (response.status === 'like') {
                      // Se ha añadido un like
                      contnPublication.find('.btn-like span').text(response.likes_count);
                      contnPublication.find('.btn-dislike span').text(response.dislikes_count);
                  } else if (response.status === 'removed_like') {
                      // Se ha eliminado el like
                      contnPublication.find('.btn-like span').text(response.likes_count);
                      contnPublication.find('.btn-dislike span').text(response.dislikes_count);
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
                  // Manejar la respuesta
                  let contnPublication = $(`[data-post-id="${postId}"]`).closest('.row.justify-content-end');

                  if (response.status === 'dislike') {
                      // Se ha añadido un dislike
                      contnPublication.find('.btn-like span').text(response.likes_count);
                      contnPublication.find('.btn-dislike span').text(response.dislikes_count);
                  } else if (response.status === 'removed_dislike') {
                      // Se ha eliminado el dislike
                      contnPublication.find('.btn-like span').text(response.likes_count);
                      contnPublication.find('.btn-dislike span').text(response.dislikes_count);
                  }
              }
          });
      });
  }
}

// Instanciamos la clase
window.initLike = new LikeClass();
window.initLike.startLikeClass();
