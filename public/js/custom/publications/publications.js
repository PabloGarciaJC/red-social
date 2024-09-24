class PublicationClass {

  showComments() {
    $(document).on('click', '.btn__comments', (e) => {
      e.preventDefault();
      const $currentTarget = $(e.currentTarget);
      const $wrapperComments = $currentTarget.closest('.justify-content-end').find('.wrapper-comments');
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
            form[0].reset();
          }
        }
      });
    });
  }

  emojis() {
    // Guarda la referencia a 'this' para usarla en el evento click
    const self = this;
    // Mostrar y ocultar el selector de emojis de manera contextual para cada publicación
    $('.form__comments').each(function () {
      const form = $(this);
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
    const self = this;
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
    const $imageFileInput = $('#imageFile');
    const $imagePreview = $('#imagePreview');
    const $commentTextarea = $('#commentTextarea');

    $imageFileInput.on('change', function (event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
          $imagePreview.attr('src', e.target.result);
          $imagePreview.show(); // Muestra la imagen
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
      const emoji = $(this).text();
      const currentValue = $commentTextarea.val();
      $commentTextarea.val(currentValue + emoji); // Inserta el emoji en el textarea
      $('.modal__emoji-picker').hide(); // Opcional: Oculta el selector de emojis después de seleccionar
    });
  }

  // Funcionalidades
  startPublicationClass() {
    this.showComments();
    this.save();
    this.collapseComments();
    this.emojis();
    this.delete();
    this.create();
    this.modal();
  }
}

window.initPublication = new PublicationClass();
window.initPublication.startPublicationClass();

