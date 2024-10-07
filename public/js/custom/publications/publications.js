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

      let form = $(e.currentTarget);
      let formData = new FormData(form[0]);

      // Recorrer todas las imágenes previsualizadas dentro del contenedor
      $('.modal__image-wrapper img').each(function (index, img) {
        // El atributo "src" contiene la imagen en base64
        let src = $(img).attr('src');
        let fileName = 'imagen_' + index + '.jpg';

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

      // Enviar el formulario con AJAX
      $.ajax({
        url: form.attr('action'),
        method: "POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          // Resetear el formulario después de éxito
          $('.form-publication__create')[0].reset();
          $('#exampleModal').removeClass('modal--active');
          // Limpiar las imágenes previsualizadas
          $('.modal__image-wrapper').empty();
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

  edit() {
    $('.form-publication__edit').on('submit', function (e) {
      e.preventDefault();

      let form = $(e.currentTarget);
      let formData = new FormData(form[0]);

      // Recorrer todas las imágenes previsualizadas dentro del contenedor
      $('.modal__edit-image-wrapper img').each(function (index, img) {
        // El atributo "src" contiene la imagen en base64
        let src = $(img).attr('src');
        let fileName = 'imagen_' + index + '.jpg';

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
          formData.append('editimagenpublicacion[]', blob, fileName);
        }

      });

      // Enviar el formulario con AJAX
      $.ajax({
        url: form.attr('action'),
        method: "POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          // Resetear el formulario después de éxito
          $('.form-publication__edit')[0].reset();
          $('#modal-edit').removeClass('modal--active');
          // Limpiar las imágenes previsualizadas
          $('.modal__edit-image-wrapper').empty();
          Swal.fire({
            icon: 'success',
            title: 'Publicación Editada',
            showConfirmButton: false,
            timer: 1000
          });
          $('#modal-edit').removeClass('modal--active').fadeOut();
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

  modalEdit() {
    $('.edit-publication').on('click', function (e) {

      // Publicación - Comentario
      let textComent = $(this).closest('.col-12.mb-3').find('p').text();

      // Publicación - Imágenes
      let imageElements = $(this).closest('.col-12.mb-3').find('.product-sheet__thumbnails img');

      // Modal Contenedor
      let cntnModalEdit = $(this).closest('.row').find('.modal-edit');

      // Mostrar Contenedor de Imagenes
      cntnModalEdit.find('.modal__image-preview').show();

      // Inyectar el comentario en el modal
      cntnModalEdit.find('.publication-input').html(textComent);

      // Limpiar vista previa de imágenes previa
      let imageWrapper = cntnModalEdit.find('.modal__edit-image-wrapper');
      imageWrapper.html(''); // Limpia cualquier vista previa anterior

      // Iterar sobre las imágenes y mostrarlas en la vista previa del modal
      imageElements.each(function (index) {
        let imgSrc = $(this).attr('src');  // Obtener la URL de la imagen
        let newPreviewId = `image-edit-${index}`; // Generar un ID único basado en el índice de la imagen

        // Crear el HTML para la vista previa de las imágenes en el modal
        const newImagePreview = `
                <div class="modal__image-preview-item" id="image-container-${newPreviewId}">
                    <a href="${imgSrc}" class="lightbox-image" data-lightbox="gallery">
                        <img id="${newPreviewId}" src="${imgSrc}" alt="Imagen seleccionada" style="display: block; max-width: 100px; margin-right: 10px;">
                    </a>
                    <div class="modal__image-actions">
                        <button type="button" class="edit-image-btn" data-target="${newPreviewId}">
                            <i class="bi bi-pencil"></i> Editar
                        </button>
                        <button type="button" class="delete-image-btn" data-target="${newPreviewId}">
                            <i class="bi bi-trash"></i> Eliminar
                        </button>
                    </div>
                    <input type="file" class="hidden-input-file" id="input-${newPreviewId}" style="display: none;" accept="image/*">
                </div>
            `;

        // Añadir la imagen al contenedor del modal
        imageWrapper.append(newImagePreview);

        // Evento para el botón de eliminar imagen
        $(`#image-container-${newPreviewId} .delete-image-btn`).on('click', function () {
          // Elimina el contenedor de la imagen
          $(`#image-container-${newPreviewId}`).remove();
        });

        // Evento para el botón de editar imagen
        $(`#image-container-${newPreviewId} .edit-image-btn`).on('click', function () {
          // Simula un clic en el input de archivo para seleccionar otra imagen
          $(`#input-${newPreviewId}`).trigger('click');
        });

        // Evento para el input de archivo oculto (para seleccionar nueva imagen)
        $(`#input-${newPreviewId}`).on('change', function (event) {
          const newFile = event.target.files[0]; // Obtiene el nuevo archivo seleccionado

          if (newFile) {
            const newReader = new FileReader();
            newReader.onload = function (e) {
              const newFileContent = e.target.result;

              // Verifica si la nueva imagen ya existe en la vista previa
              const isDuplicate = imageWrapper.find(`img[src="${newFileContent}"]`).length > 0;
              if (isDuplicate) {
                return; // Salir si ya existe
              }

              // Actualiza la imagen de vista previa
              $(`#${newPreviewId}`).attr('src', newFileContent);
            };
            newReader.readAsDataURL(newFile); // Lee el archivo como una URL
          }
        });
      });

      // Mostrar el modal de edición
      $('.modal-edit').addClass('modal--active').fadeIn();
    });

    // Cerrar el modal
    $('.modal__close--icon, .button--modal-close').on('click', function () {
      $('.modal-edit').removeClass('modal--active').fadeOut();
    });

    $('.modal-edit').on('click', function (event) {
      if (event.target === this) {
        $('.modal-edit').removeClass('modal--active').fadeOut();
      }
    });
  }

  // Funcionalidades
  startPublicationClass() {
    this.create();
    this.modal();
    this.delete();
    this.edit(); // Falta Programar
    this.modalEdit();
  }
}

window.initPublication = new PublicationClass();
window.initPublication.startPublicationClass();

