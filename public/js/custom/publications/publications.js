class PublicationClass {

  delete(elementDelete) {
    $(elementDelete).off("click").on("click", function (e) {
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

  create(elementCreate) {
    $(elementCreate).off('submit').on('submit', function (e) {
      e.preventDefault();
      let form = $(this);
      let submitButton = form.find('button[type="submit"]'); // Seleccionar el botón de envío
      submitButton.prop('disabled', true); // Deshabilitar el botón

      let formData = new FormData(form[0]);

      // Recorrer todas las imágenes previsualizadas dentro del contenedor
      $('.modal__image-wrapper img').each(function (index, img) {
        let src = $(img).attr('src');
        let fileName = 'imagen_' + index + '.jpg';

        if (src && fileName) {
          let byteString = atob(src.split(',')[1]);
          let mimeString = src.split(',')[0].split(':')[1].split(';')[0];
          let arrayBuffer = new ArrayBuffer(byteString.length);
          let intArray = new Uint8Array(arrayBuffer);

          for (let i = 0; i < byteString.length; i++) {
            intArray[i] = byteString.charCodeAt(i);
          }

          let blob = new Blob([intArray], { type: mimeString });
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
          $('.modal__image-wrapper').empty();
          Swal.fire({
            icon: 'success',
            title: 'Publicación Creada',
            showConfirmButton: false,
            timer: 1000
          });
          $('#exampleModal').removeClass('modal--active').fadeOut();
        },
        complete: function () {
          submitButton.prop('disabled', false); // Volver a habilitar el botón
        }
      });
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
                            <div class="edit-image-btn" data-target="${newPreviewId}">Editar</div>
                            <div class="delete-image-btn" data-target="${newPreviewId}">Eliminar</div>
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

  desplegarModalEdit(elementEdit) {

    const self = this;

    let modalPublicacionEdit = `
      <div class="modal modal-edit">
          <div class="modal__content">
              <div class="modal__header">
                  <h5>Editar Publicación</h5>
                  <button class="modal__close modal__close--icon">×</button>
              </div>
              <div class="modal__body">
                  <form action="${baseUrl}publicationEdit" method="POST" enctype="multipart/form-data" class="form-publication__edit">
                      <div class="form-group">
                          <textarea class="form-control publication-input" name="comentarioPublicacion" placeholder="Escribe tu Comentario"></textarea>
                      </div>
                      <input type="hidden" class="id-post__edit">
                      <div class="form-group">
                          <label for="image-file-edit-publication" class="modal__image-upload">
                              <span class="modal__image-upload__icon">➕</span> Subir Imagenes
                              <input type="file" class="form-control-file" id="image-file-edit-publication" name="editimagenpublicacion">
                          </label>
                          <button type="button" class="modal__button--emoji-toggle">😊</button>
                          <!-- Aquí se inyectará el emoji-picker -->
                          <div class="form__cntn-emojis"></div>
                          <!-- Contenedor de las vistas previas de las imágenes -->
                          <div class="modal__image-preview" style="display: none;">
                              <div class="modal__edit-image-wrapper"></div>
                          </div>
                      </div>
                      <div class="modal__footer">
                          <button type="button" class="button button--modal-close" id="closeModalFooter">Cerrar</button>
                          <button type="submit sss" class="button">Aceptar</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>`;

    // Inyectar el modal en el DOM si no existe ya
    if (!$('.modal-edit').length) {
      $('body').append(modalPublicacionEdit);
    }

    $(elementEdit).off("click").on("click", function (e) {

      e.preventDefault();

      // Mostrar el modal de edición
      $('.modal-edit').addClass('modal--active').fadeIn();

      // Publicación - Comentario
      let textComent = $(this).closest('.col-12.mb-3').find('p').first().text();

      // Se obtiene Post ID, para cada publicacion
      let postId = $(this).closest('.col-12.mb-3').find('.form__comments').data("post-id");

      // Publicación - Imágenes
      let imageElements = $(this).closest('.col-12.mb-3').find('.slick__thumbnails img');

      // Modal Contenedor
      let cntnModalEdit = $(this).parents('body').find('.modal-edit');

      // Inyectar Post ID en el campo de texto oculto
      cntnModalEdit.find('.id-post__edit').attr('name', 'post-id').val(postId);

      // Mostrar Contenedor de Imagenes
      cntnModalEdit.find('.modal__image-preview').show();

      // Inyectar el comentario en el modal
      cntnModalEdit.find('.publication-input').val(textComent);

      // Limpiar vista previa de imágenes previa
      let imageWrapper = cntnModalEdit.find('.modal__edit-image-wrapper');
      imageWrapper.html(''); // Limpia cualquier vista previa anterior

      // Iterar sobre las imágenes y mostrarlas en la vista previa del modal
      imageElements.each(function (index) {
        let imgSrc = $(this).attr('src');  // Obtener la URL de la imagen
        let imgPath = $(this).data('path');

        let newPreviewId = `image-edit-${index}`; // Generar un ID único basado en el índice de la imagen

        // Crear el HTML para la vista previa de las imágenes en el modal
        const newImagePreview = `
                  <div class="modal__image-preview-item" id="image-container-${newPreviewId}">
                      <a href="${imgSrc}" class="lightbox-image" data-lightbox="gallery">
                          <img id="${newPreviewId}" src="${imgSrc}" alt="Imagen seleccionada" style="display: block; max-width: 100px; margin-right: 10px;" data-m-img-path="${imgPath}">
                      </a>
                      <div class="modal__image-actions">
                          <div class="edit-image-btn" data-target="${newPreviewId}">Editar</div>
                          <div class="delete-image-btn" data-target="${newPreviewId}">Eliminar</div>
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
  initSlickSlider(elementSlick, Elementhumbnails) {
    $(elementSlick).each(function () {
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
    $(Elementhumbnails).on('click', '.thumbnail', function () {
      let index = $(this).data('index'); // Obtiene el índice de la miniatura
      let publicationId = $(this).closest('.card-body').find('.slick-fich').attr('id');
      $('#' + publicationId).slick('slickGoTo', index);
    });
  }

  sendFormEdit(elementEdit) {
    $(elementEdit).off('submit').on('submit', function (e) {
      e.preventDefault();

      let form = $(this);
      let submitButton = form.find('button[type="submit"]'); // Seleccionar el botón de envío
      submitButton.prop('disabled', true); // Deshabilitar el botón

      let formData = new FormData(form[0]);
      formData.append("post_id", $(this).find('.id-post__edit').val());

      // Crear un array de promesas para las imágenes
      let promises = [];

      // Añadir imágenes nuevas y editadas
      form.find('.modal__edit-image-wrapper img').each(function (index, img) {
        let src = $(img).attr('src');
        let fileName = 'imagen_' + index + '.jpg';

        if (src) {
          // Crear una promesa para cada imagen
          promises.push(
            fetch(src)
              .then(response => response.blob())
              .then(blob => {
                // Añadir el archivo Blob al FormData con el nombre temporal
                formData.append('imagenPublicacion[]', blob, fileName);
              })
              .catch(error => {
                console.error('Error al obtener la imagen:', error);
              })
          );
        }
      });

      // Esperar a que todas las promesas se resuelvan
      Promise.all(promises).then(() => {
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
            $('.modal-edit').removeClass('modal--active');
            $('.modal__image-wrapper').empty();
            Swal.fire({
              icon: 'success',
              title: 'Publicación Editada',
              showConfirmButton: false,
              timer: 1000
            });
            $('.modal-edit').removeClass('modal--active').fadeOut();
          },
          error: function (xhr, status, error) {
            console.error('Error en la solicitud:', error);
          },
          complete: function () {
            submitButton.prop('disabled', false); // Volver a habilitar el botón
          }
        });
      });
    });
  }

  setupModalTriggers(openSelector, closeSelector, modalSelector) {
    $(openSelector).on('click', function () {
      $(modalSelector).addClass('modal--active').fadeIn();
    });

    $(closeSelector).on('click', function () {
      $(modalSelector).removeClass('modal--active').fadeOut();
    });

    $(modalSelector).on('click', function (event) {
      if (event.target === this) {
        $(modalSelector).removeClass('modal--active').fadeOut();
      }
    });
  }

  // Funcionalidades
  startPublicationClass() {
    this.create('.form-publication__create');
    this.setupModalTriggers('#openModal', '#closeModal, #closeModalFooter', '#exampleModal');
    this.delete('.eliminar-publication');
    this.btnChangeImagenModalPrevie($('#image-file-create-publication'), $('.modal__image-wrapper'), 0, 'preview-create-publication');
    this.desplegarModalEdit('.edit-publication');
    this.sendFormEdit('.form-publication__edit');
    this.initSlickSlider('.slick__contn', '.slick__thumbnails');
  }
}

window.initPublication = new PublicationClass();
window.initPublication.startPublicationClass();

