class PublicationClass {

  delete() {
    $(document).off('click', '.eliminar-publication');
    $(document).on('click', '.eliminar-publication', function (e) {
      e.preventDefault();
      $.ajax({
        url: `${$(this).attr('href')}`,
        method: 'GET',
        success: (response) => {
          if (response.message == 'delete') {
            Swal.fire({
              icon: 'success',
              title: 'Publicación eliminada',
              showConfirmButton: false,
              timer: 1000
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Solo el autor de la publicación puede borrarla'
            });
          }
        },
        error: (err) => {
          console.error('Error:', err);
        }
      });
    });
  }

  create() {
    $('.form-publication__create').on('submit', function (e) {
      e.preventDefault();

      let form = $(e.currentTarget); // El formulario actual
      let formData = new FormData(form[0]); // Crear un objeto FormData con todos los datos del formulario

      // Recorrer todas las imágenes previsualizadas dentro del contenedor
      $('.modal__image-wrapper img').each(function (index, img) {
        // El atributo "src" contiene la imagen en base64
        let src = $(img).attr('src');
        let fileName = 'imagen_' + index + '.jpg'; // Crear un nombre de archivo temporal (puedes cambiar el formato si es necesario)

        if (src && fileName) {
          // Convertir la imagen base64 a un objeto Blob
          let byteString = atob(src.split(',')[1]); // Decodificar base64
          let mimeString = src.split(',')[0].split(':')[1].split(';')[0]; // Obtener el MIME type
          let arrayBuffer = new ArrayBuffer(byteString.length);
          let intArray = new Uint8Array(arrayBuffer);

          for (let i = 0; i < byteString.length; i++) {
            intArray[i] = byteString.charCodeAt(i);
          }

          let blob = new Blob([intArray], { type: mimeString });

          // Añadir el archivo Blob al FormData con el nombre temporal
          formData.append('imagenPublicacion[]', blob, fileName);
        }

      });

      // Verificar qué imágenes se están enviando
      for (let pair of formData.entries()) {
        if (pair[0] === 'imagenPublicacion[]') {
          // console.log('Archivo enviado:', pair[1].name);
        }
      }

      // Enviar el formulario con AJAX
      $.ajax({
        url: form.attr('action'), // La URL del controlador
        method: "POST", // Método POST
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Token CSRF
        },
        data: formData, // Enviar los datos del formulario
        processData: false, // Necesario para enviar archivos
        contentType: false, // No establecer el tipo de contenido automáticamente
        success: function (response) {
          // Resetear el formulario después de éxito
          // Resetear el formulario después de éxito
          $('.form-publication__create')[0].reset();
          $('#exampleModal').removeClass('modal--active');

          // Limpiar las imágenes previsualizadas
          $('.modal__image-wrapper').empty(); // Limpia el contenedor de imágenes
          Swal.fire({
            icon: 'success',
            title: 'Publicación Creada',
            showConfirmButton: false,
            timer: 1000
          });
          $('#exampleModal').removeClass('modal--active').fadeOut();
        }
      });
    });

  }

  modal() {
    $('#openModal').on('click', function () {
      $('#exampleModal').addClass('modal--active').fadeIn();
    });

    $('#closeModal, #closeModalFooter').on('click', function () {
      $('#exampleModal').removeClass('modal--active').fadeOut();
    });

    $('#exampleModal').on('click', function (event) {
      if (event.target === this) {
        $('#exampleModal').removeClass('modal--active').fadeOut();
      }
    });
  }

  // Funcionalidades
  startPublicationClass() {
    this.create();
    this.delete();
    this.modal();
  }
}

window.initPublication = new PublicationClass();
window.initPublication.startPublicationClass();

