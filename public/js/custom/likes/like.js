class LikeClass {
  constructor() {
    this.btnLike = $(".btn-like-dislike");
  }

  // Método para inicializar la clase
  startLikeClass() {
    this.btnLike.on("click", function (e) {
      let target = $(e.currentTarget);
      let likePublication = target.attr("id-data-like-dislike");
      let publicationId = likePublication.split("-").pop();
      if (target.hasClass('like')) {
        target.removeClass("like");
        target.html("Dislike");
        target.addClass("dislike");
        let newIdValue = "btn-dislike-" + publicationId;
        target.attr("id-data-like-dislike", newIdValue);
        $.ajax({
          type: "GET",
          url: baseUrl + "like/" + publicationId,
          success: function (response) {
           // Se envio correctamente
          },
        });
      } else {
        target.removeClass("dislike");
        target.html("like");
        target.addClass("like");
        let newIdValue = "btn-like-" + publicationId;
        target.attr("id-data-like-like", newIdValue);
        $.ajax({
          type: "GET",
          url: baseUrl + "dislike/" + publicationId,
          success: function (response) {
          // Se envio correctamente
          },
        });
      }
    });
  }
}

// Instanciamos la clase
let initLike = new LikeClass();
initLike.startLikeClass();
