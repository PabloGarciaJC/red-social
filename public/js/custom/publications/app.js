class InitAppPublicationClass {

  showComments() {
    $(document).on('click', '.btn__comments', (e) => {
      e.preventDefault();
      let $currentTarget = $(e.currentTarget);
      let $wrapperComments = $currentTarget.closest('.justify-content-end').find('.wrapper-comments');
      // Evita múltiples animaciones
      if ($wrapperComments.is(':animated')) return;
      // `slideToggle` para la animación de deslizamiento
      $wrapperComments.slideToggle();
    });
  }

  collapseComments() {
    $('.form__collapse').on('click', (e) => {
      $(e.currentTarget).closest('.justify-content-end').find('.wrapper-comments').slideUp();
    })
  }

  save() {
    $('.form__comments').on('submit', (e) => {
      e.preventDefault();
      let form = $(e.currentTarget);
      let formData = new FormData(form[0]);
      $.ajax({
        url: form.attr('action'),
        method: "POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          if (response.success) {
            addCommentToList(response.data, form);
            updateCommentCount(form);
            // Vaciar los campos del formulario después de enviar
            form[0].reset();
          }
        }
      });
    });

    function addCommentToList(comment, form) {
      let contenidoHtml = comment.contenido ? `<p>${comment.contenido}</p>` : '<p>No hay contenido</p>';
      let commentHtml = `
        <div class="row row-cols-auto mb-2">
            <div class="col news">
                <img src="${baseUrl}fotoPerfil/${comment.user.fotoPerfil}" 
                    alt="${comment.user.alias}'s profile picture" 
                    class="rounded-circle" width="40" height="40"/>
            </div>
            <div class="col">
                <a href="${baseUrl}usuario/${comment.user.alias}?estado=confirmado">${comment.user.name}</a>
                <p>${contenidoHtml}</p>
                ${comment.imagen ? `<img src="${baseUrl}comentarioImagen/${comment.imagen}" 
                                    alt="Comment Image" 
                                    class="img-fluid" 
                                    style="max-width: 100%; height: auto;">` : ''}
            </div>
        </div>
      `;

      form.before(commentHtml)
    }

    function updateCommentCount(formElement) {
      let commentButton = formElement.closest('.wrapper-comments').prev('.btn__comments');
      if (commentButton.length === 0) {
        console.error('El botón de comentarios no se encuentra en el DOM.');
        return;
      }
      let buttonText = commentButton.text().trim();
      let match = buttonText.match(/\d+/);
      if (!match) {
        console.error('El texto del botón no contiene un número válido.');
        return;
      }
      let currentCount = parseInt(match[0]);
      let newCount = currentCount + 1;
      commentButton.text(`Comentarios (${newCount})`);
    }
  }

  emojis() {
    // Guarda la referencia a 'this' para usarla en el evento click
    let self = this;
    // Mostrar y ocultar el selector de emojis de manera contextual para cada publicación
    $('.form__comments').each(function () {
      let form = $(this);
      // Mostrar/ocultar emojis solo dentro del formulario actual
      form.find('#emojiToggle').on('click', function () {
        form.find('.emoji-picker').toggle();
      });
      // Añadir emojis al input de comentario del formulario actual
      form.find('.chat-container__emoji').on('click', function () {
        let comentarioInput = form.find('.comentario-input');
        comentarioInput.val(comentarioInput.val() + $(this).text());
      });
    });
  }

  delete() {
    $(document).off('click', '.eliminar-publication');
    $(document).on('click', '.eliminar-publication', function (e) {
      e.preventDefault();
      $.ajax({
        url: `${$(this).attr('href')}`,
        method: 'GET',
        success: (response) => {
          if (response.message == 'success') {
            $(this).closest('.col-12.mb-3').remove();
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
    let self = this;
    $('.form-publication__create').on('submit', (e) => {
      e.preventDefault();

      let form = $(e.currentTarget);
      let formData = new FormData(form[0]);
      $.ajax({
        url: form.attr('action'),
        method: "POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          // Limpia el formulario y cierra el modal
          $('.form-publication__create')[0].reset(); // Resetea los campos del formulario
          $('#exampleModal').removeClass('modal--active'); // Cierra el modal
          // Mostrar un mensaje de éxito usando SweetAlert
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
    let $imageFileInput = $('#imageFile');
    let $imagePreview = $('#imagePreview');
    let $commentTextarea = $('#commentTextarea');

    $imageFileInput.on('change', function (event) {
      let file = event.target.files[0];
      if (file) {
        let reader = new FileReader();

        reader.onload = function (e) {
          $imagePreview.attr('src', e.target.result);
          // Muestra la imagen
          $imagePreview.show();
        };

        reader.readAsDataURL(file);
      } else {
        $imagePreview.attr('src', '');
        // Oculta la imagen si no hay archivo
        $imagePreview.hide();
      }
    });

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

    $('#emojiToggle').on('click', function () {
      $('.modal__emoji-picker').toggle(); // Muestra u oculta el selector de emojis
    });

    $('.modal__emoji-picker__emoji').on('click', function () {
      let emoji = $(this).text();
      let currentValue = $commentTextarea.val();
      $commentTextarea.val(currentValue + emoji); // Inserta el emoji en el textarea
      $('.modal__emoji-picker').hide(); // Opcional: Oculta el selector de emojis después de seleccionar
    });
  }

  // Funcionalidades
  startIniPublication() {
    this.showComments();
    this.save();
    this.collapseComments();
    this.emojis();
    this.delete();
    this.create();
    this.modal();
  }
}

let initAppPublication = new InitAppPublicationClass();
window.initAppPublication = initAppPublication;
window.initAppPublication.startIniPublication();
