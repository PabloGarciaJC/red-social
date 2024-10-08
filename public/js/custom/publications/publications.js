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

      let form = $(this);
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

  sendFormEdit() {
    $('.form-publication__edit').on('submit', function (e) {
      e.preventDefault();

      let form = $(this);
      let formData = new FormData(form[0]);
      formData.append("post_id", $(this).find('.id-post__edit').val());

      // Añadir imágenes nuevas y editadas
      $('.modal__edit-image-wrapper .hidden-input-file').each(function (index, input) {
        const file = $(input)[0].files[0]; // Obtenemos el archivo seleccionado
        if (file) {
          formData.append('editimagenpublicacion[]', file); // Añadir el archivo al formData
        }
      });

      // Recopilar las imágenes eliminadas (si se ha marcado alguna)
      let removedImages = [];
      $('.modal__edit-image-wrapper .delete-image-btn').each(function (index, button) {
        if ($(button).data('deleted')) { // Marcamos las eliminadas con "data-deleted"
          removedImages.push($(button).data('image-id')); // Capturamos el ID de la imagen para eliminarla
        }
      });

      formData.append('removedImages', JSON.stringify(removedImages)); // Añadimos las imágenes eliminadas al formData

      $.ajax({
        url: form.attr("action"),
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
          Swal.fire({
            icon: 'success',
            title: 'Publicación actualizada',
            showConfirmButton: false,
            timer: 1000
          });
          $('.modal-edit').removeClass('modal--active').fadeOut();
        },
        error: function (xhr, status, error) {
          alert('Error al actualizar la publicación.');
        }
      });
    });
  }

  setupModalTriggers() {
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

  // Función general para manejar la vista previa de imágenes
  btnChangeImagenModalPrevie($imageFileInput, $imageWrapper, imageCount, idPrefix = 'preview') {

    // Evento que se dispara cuando el input cambia (el usuario selecciona imágenes)
    $imageFileInput.on('change', function (event) {
      const files = event.target.files; // Obtiene los archivos seleccionados

      if (files.length > 0) {
        Array.from(files).forEach((file) => {
          const reader = new FileReader();

          reader.onload = function (e) {
            const fileContent = e.target.result; // Contenido en base64 de la imagen

            // Verifica si la imagen ya existe en la vista previa
            const existingImage = $imageWrapper.find(`img[src="${fileContent}"]`);
            if (existingImage.length > 0) {
              return; // Si ya existe la imagen, no la añade
            }

            // Genera un ID único para cada imagen
            const newPreviewId = `${idPrefix}-${Date.now()}-${imageCount++}`;

            // Crear el HTML de la vista previa de la imagen
            const imagePreview = `
                  <div class="modal__image-preview-item" id="image-container-${newPreviewId}">
                      <a href="${fileContent}" class="lightbox-image" data-lightbox="gallery">
                          <img id="${newPreviewId}" src="${fileContent}" alt="Imagen seleccionada" style="display: block; max-width: 100px; margin-right: 10px;">
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

            // Añadir la imagen al contenedor de imágenes
            $imageWrapper.append(imagePreview);

            // Evento para el botón de eliminar imagen
            $(`#image-container-${newPreviewId} .delete-image-btn`).on('click', function () {
              $(`#image-container-${newPreviewId}`).remove();
            });

            // Evento para el botón de editar imagen
            $(`#image-container-${newPreviewId} .edit-image-btn`).on('click', function () {
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
                  const isDuplicate = $imageWrapper.find(`img[src="${newFileContent}"]`).length > 0;
                  if (!isDuplicate) {
                    // Reemplaza la imagen de vista previa
                    $(`#${newPreviewId}`).attr('src', newFileContent);
                  }
                };
                newReader.readAsDataURL(newFile); // Lee el archivo como una URL
              }
            });
          };

          // Leer el archivo como una URL para mostrarlo en la vista previa
          reader.readAsDataURL(file);
        });

        if (idPrefix == 'preview-create-publication') {
          // Muestra el contenedor de vista previa si hay imágenes seleccionadas
          $('.modal__image-preview').show();
        }

      }
    });
  }

  desplegarModalEdit() {

    const self = this;

    $('.edit-publication').on('click', function (e) {

      // Mostrar el modal de edición
      $('.modal-edit').addClass('modal--active').fadeIn();

      // Publicación - Comentario
      let textComent = $(this).closest('.col-12.mb-3').find('p').text();

      // Se obtiene Post ID, para cada publicacion
      let postId = $(this).closest('.col-12.mb-3').find('.form__comments').data("post-id");

      // Publicación - Imágenes
      let imageElements = $(this).closest('.col-12.mb-3').find('.product-sheet__thumbnails img');

      // Modal Contenedor
      let cntnModalEdit = $(this).closest('.row').find('.modal-edit');

      // Inyectar Post ID en el campo de texto oculto
      cntnModalEdit.find('.id-post__edit').attr('name', 'post-id').val(postId);

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

      // Cuando se preciona click en añadir archivo, este crea una imagen con los botones y sigue el orden para poder EDITAR y ELIMINAR
      self.btnChangeImagenModalPrevie($('#image-file-edit-publication'), $('.modal__edit-image-wrapper'), $('.modal__edit-image-wrapper > .modal__image-preview-item').length, 'image-edit')

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

  // Inicializa todos los slick sliders
  initSlickSlider() {
    $('.product-sheet__contn-slick').each(function () {
      if ($(this).hasClass('slick-initialized')) {
        $(this).slick('unslick');
      }
      $(this).slick({
        dots: false,
        infinite: true,
        speed: 500,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 2000,
      });
    });

    // Evento de clic en las miniaturas
    $('.product-sheet__thumbnails').on('click', '.thumbnail', function () {
      let index = $(this).data('index'); // Obtiene el índice de la miniatura
      let publicationId = $(this).closest('.card-body').find('.slick-fich').attr('id');
      $('#' + publicationId).slick('slickGoTo', index);
    });
  }

  // Funcionalidades
  startPublicationClass() {
    this.create();
    this.setupModalTriggers();
    this.delete();
    this.sendFormEdit();
    this.desplegarModalEdit();
    this.btnChangeImagenModalPrevie($('#image-file-create-publication'), $('.modal__image-wrapper'), 0, 'preview-create-publication');
    this.initSlickSlider();
  }
}

window.initPublication = new PublicationClass();
window.initPublication.startPublicationClass();

