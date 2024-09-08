
function dislike(idPublication) {

  let dislikePublication = document.getElementById('btn-dislike' + idPublication);
  dislikePublication.classList.remove('dislike');
  dislikePublication.innerHTML = 'Like';
  dislikePublication.classList.add('like');
  dislikePublication.setAttribute('id', 'btn-like' + idPublication);
  dislikePublication.setAttribute('onclick', 'like(' + idPublication + ');');
  let urlAjax = baseUrl + 'dislike/' + idPublication;
  ajaxPeticionLike(urlAjax);
}

function ajaxPeticionLike(urlAjax) {

  $.ajax({
    type: "GET",
    url: urlAjax,
    success: function (response) {

      if (response.like) {
        console.log('Has dado dislike a la publicacion');
      } else {
        console.log('Error al dar dislike');
      }

    }
  })
}