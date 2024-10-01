class LikeClass {
  constructor() {
    this.cardBody = $(".card-body"); // Un contenedor que siempre está presente
  }

  // Método para inicializar la clase
  startLikeClass() {
    this.handleLike();
    this.handleDislike();
  }

  // Método para manejar el botón like usando delegación de eventos
  handleLike() {
    this.cardBody.on("click", ".btn-like", (e) => {
      let form = $(e.target).closest('.card-body').find('form.form__comments');
      let postId = form.data('post-id');

      $.ajax({
        type: "GET",
        url: `${baseUrl}like/${postId}`,
        success: function (response) {
          if (response.status == 'like') {
            let contnDislike = `<div class="btn-dislike">
                                  <i class="bi bi-hand-thumbs-down"></i> Dislike
                                </div>`;

            // Reemplazar el botón de like por dislike
            let newDislikeButton = $(contnDislike).insertBefore(e.target);
            $(e.target).remove();
          } else {
            console.log('dislike');
          }
        }
      });
    });
  }

  // Método para manejar el botón dislike usando delegación de eventos
  handleDislike() {
    this.cardBody.on("click", ".btn-dislike", (e) => {
      let form = $(e.target).closest('.card-body').find('form.form__comments');
      let postId = form.data('post-id');

      $.ajax({
        type: "GET",
        url: `${baseUrl}dislike/${postId}`,
        success: function (response) {
          if (response.status == 'dislike') {
            let contnLike = `<div class="btn-like">
                               <i class="bi bi-hand-thumbs-up"></i> Like
                             </div>`;

            // Reemplazar el botón de dislike por like
            let newLikeButton = $(contnLike).insertBefore(e.target);
            $(e.target).remove();
          } else {
            console.log('like');
          }
        }
      });
    });
  }
}

// Instanciamos la clase
let initLike = new LikeClass();
initLike.startLikeClass();
