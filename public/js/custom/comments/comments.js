class CommentClass {

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
    $(document).off('click', '.form__comments');
    $('.form__comments').on('submit', function (e) {
      e.preventDefault();
      let form = $(this);
      let formData = new FormData(form[0]);
      formData.append('post_id', form.data('post-id'));
      // Enviar los datos por AJAX
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
        },
        error: function (xhr, status, error) {
          console.error('Error:', error);
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

  // Funcionalidades
  startCommentClass() {
    this.showComments();
    this.collapseComments();
    this.save();
    this.emojis();
  }
}

window.initComment = new CommentClass();
window.initComment.startCommentClass();

