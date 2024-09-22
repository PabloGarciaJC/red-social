class InitAppPublicationClass {

  showComments() {
    $(document).on('click', '.btn__comments', (e) => {
      e.preventDefault();
      const $currentTarget = $(e.currentTarget);
      const $wrapperComments = $currentTarget.closest('.justify-content-end').find('.wrapper-comments');
      // Asegúrate de que solo se maneje un `slideToggle` por vez
      if ($wrapperComments.is(':animated')) return; // Evita múltiples animaciones
      // Usa `slideToggle` para la animación de deslizamiento
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
    // Guardamos la referencia a 'this' para usarla en el evento click
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

          // let publication = response.publication;
          // let user = publication.user;
          // let contenido = (publication.contenido ?? '').trim();

          // let cardHtml = `
          //                 <div class="col-12 mb-3">
          //                     <div class="card info-card sales-card">
          //                         <div class="filter">
          //                             <a class="icon" href="#" data-bs-toggle="dropdown">
          //                                 <i class="bi bi-three-dots"></i>
          //                             </a>
          //                             <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          //                                 <li class="dropdown-header text-start">
          //                                     <span>Opciones</span>
          //                                 </li>
          //                                 <li>
          //                                     <a class="dropdown-item eliminar-publication" href="${baseUrl}publicationDelete/${publication.id}">
          //                                       Eliminar
          //                                     </a>
          //                                 </li>  
          //                             </ul>
          //                         </div>
          //                         <div class="card-body">
          //                             <div class="d-flex align-items-center pt-3">
          //                                 <div class="news">
          //                                     <div class="post-item clearfix">
          //                                         <img src="/fotoPerfil/${user.fotoPerfil}" 
          //                                             alt="${user.alias}'s profile picture"
          //                                             class="rounded-circle" width="50" height="50"/>
          //                                         <a href="/usuario/${user.alias}?estado=confirmado&idNotificacion=0">
          //                                             ${user.alias}
          //                                         </a>
          //                                     </div>
          //                                 </div>
          //                             </div>
          //                             ${publication.imagen ? `
          //                                 <img src="/publicationImagen/${publication.imagen}" 
          //                                     alt="Publication Image" 
          //                                     class="img-fluid rounded mb-3" 
          //                                     style="max-width: 100%; height: auto;">
          //                             ` : ''}
          //                             ${contenido !== '' ? `<p class="pt-3">${contenido}</p>` : ''}
          //                             <hr>
          //                             <div class="row justify-content-end">
          //                                 <div class="col col-lg-2">
          //                                     <div class="like" id="btn-like${publication.id}" onclick="like(${publication.id})">
          //                                         Like
          //                                     </div>
          //                                 </div>
          //                                 <div class="col col-lg-2 btn__comments">Comentarios (0)</div>

          //                                 <div id="${publication.id}" class="wrapper-comments" style="display: none;">

          //                                     <form action="${baseUrl}comentarioSave" method="POST" enctype="multipart/form-data" class="form__comments">
          //                                         <meta name="csrf-token" content="{{ csrf_token() }}">
          //                                         <input type="hidden" name="id" value="${publication.id}">

          //                                         <div class="input-group">

          //                                             <div class="file-select">
          //                                                 <input type="file" name="imagen" id="imagenPublicacion${publication.id}" aria-label="Archivo">
          //                                             </div>

          //                                             <!-- Botón para mostrar/ocultar el selector de emojis -->
          //                                             <button type="button" id="emojiToggle" class="btn btn-secondary">😄 Emojis</button>
          //                                               <input type="text" class="form-control comentario-input" placeholder="Escribe tu Comentario" name="comentario">
          //                                               <button class="btn btn-primary" type="submit">Enviar
          //                                             </button>

          //                                         </div>

          //                                         <div class="text-center form__collapse">contraer Formulario</div>

          //                                         <!-- Cuadro de emojis visible inicialmente -->
          //                                         <div class="emoji-picker" style="display: none; margin-top: 10px;">
          //                                             <span class="chat-container__emoji">😊</span>
          //                                             <span class="chat-container__emoji">😂</span>
          //                                             <span class="chat-container__emoji">😍</span>
          //                                             <span class="chat-container__emoji">😉</span>
          //                                             <span class="chat-container__emoji">😭</span>
          //                                             <span class="chat-container__emoji">😎</span>
          //                                             <span class="chat-container__emoji">😡</span>
          //                                             <span class="chat-container__emoji">🥺</span>
          //                                             <span class="chat-container__emoji">😜</span>
          //                                             <span class="chat-container__emoji">🤔</span>
          //                                             <span class="chat-container__emoji">👍</span>
          //                                             <span class="chat-container__emoji">🙏</span>
          //                                             <span class="chat-container__emoji">❤️</span>
          //                                             <span class="chat-container__emoji">🎉</span>
          //                                             <span class="chat-container__emoji">🔥</span>
          //                                             <span class="chat-container__emoji">🤯</span>
          //                                             <span class="chat-container__emoji">🤩</span>
          //                                             <span class="chat-container__emoji">😇</span>
          //                                             <span class="chat-container__emoji">🥳</span>
          //                                             <span class="chat-container__emoji">🤪</span>
          //                                             <span class="chat-container__emoji">👀</span>
          //                                             <span class="chat-container__emoji">😏</span>
          //                                             <span class="chat-container__emoji">💀</span>
          //                                             <span class="chat-container__emoji">👻</span>
          //                                             <span class="chat-container__emoji">🤤</span>
          //                                             <span class="chat-container__emoji">😴</span>
          //                                             <span class="chat-container__emoji">👑</span>
          //                                             <span class="chat-container__emoji">💩</span>
          //                                             <span class="chat-container__emoji">🦄</span>
          //                                             <span class="chat-container__emoji">🐶</span>
          //                                         </div>
          //                                     </form>
          //                                 </div>
          //                             </div>
          //                         </div>
          //                     </div>
          //                 </div>`;

          // $('#exampleModal').after(cardHtml);

          // Llama a los métodos usando la referencia 'self'
          // self.showComments();
          // self.save();
          // self.collapseComments();
          // self.emojis();

          // Cierra el modal y elimina el backdrop con un retraso
          // $('#exampleModal').modal('hide');

          // Asegúrate de eliminar el backdrop
          // document.querySelectorAll('.modal-backdrop').forEach(function (backdrop) {
          //   backdrop.remove(); // Elimina el backdrop del DOM
          // });

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
            $imagePreview.hide(); // Oculta la imagen si no hay archivo
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
initAppPublication.startIniPublication();
