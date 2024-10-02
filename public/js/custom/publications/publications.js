class PublicationClass {

  delete() {
    $(document).off('click', '.eliminar-publication');
    $(document).on('click', '.eliminar-publication', function (e) {
      e.preventDefault();
      $.ajax({
        url: `${$(this).attr('href')}`,
        method: 'GET',
        success: (response) => {
          if (response.message == 'success') {
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
          $('.form-publication__create')[0].reset();
          $('#exampleModal').removeClass('modal--active');
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

