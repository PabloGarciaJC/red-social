
function deletePublication(mostrarPublicationId) {
  urlAjax = baseUrl + 'publicationDelete/' + mostrarPublicationId;

  ajaxPeticion(urlAjax);
}

function ajaxPeticion(urlAjax) {
  $.ajax({
    type: "GET",
    url: urlAjax,
    success: function (response) {

      if (response == '') {
        Swal.fire({
          icon: 'success',
          text: 'Se ha borrado correctamente',
        }).then(function(){
          location.reload();
      });
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'No puedes borrar esta publicacion',
        })
      }
    }
  })
}
