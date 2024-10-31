class CommentClass {

    showComments(elementBtnComments) {
        $(document).on("click", elementBtnComments, (e) => {
            e.preventDefault();
            const $currentTarget = $(e.currentTarget);
            const $wrapperComments = $currentTarget
                .closest(".justify-content-end")
                .find(".wrapper-comments");
            // Evita múltiples animaciones
            if ($wrapperComments.is(":animated")) return;
            // `slideToggle` para la animación de deslizamiento
            $wrapperComments.slideToggle();
        });
    }

    collapseComments(elementBtnCollapse) {
        $(elementBtnCollapse).on("click", (e) => {
            $(e.currentTarget)
                .closest(".justify-content-end")
                .find(".wrapper-comments")
                .slideUp();
        });
    }

    save(elementForm) {
        // Evento para el submit del formulario (solo para texto)
        $(elementForm).off("submit").on("submit", function (e) {
            e.preventDefault();
            let form = $(this);

            // Desactivar el botón de envío para evitar múltiples envíos
            const submitButton = form.find("button[type='submit']"); // Asegúrate de que el selector apunte al botón correcto
            submitButton.prop("disabled", true); // Desactiva el botón

            // Verificar si el input de archivo tiene algo antes de enviar el formulario
            const fileInput = form.find(".image-commets")[0];
            if (fileInput && fileInput.files.length > 0) {
                // Reactivar el botón si hay un archivo
                submitButton.prop("disabled", false);
                return;
            }

            // Procesar solo los campos de texto
            let formData = new FormData(form[0]);
            formData.append("post_id", form.data("post-id"));

            // Enviar los datos por AJAX
            $.ajax({
                url: form.attr("action"),
                method: "POST",
                headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.message == "success") {
                        form[0].reset(); // Reiniciar el formulario
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error:", error);
                },
                complete: function () {
                    // Reactivar el botón después de la respuesta
                    submitButton.prop("disabled", false);
                },
            });
        });
    }

    delete(elementBtnDelete) {
        $(elementBtnDelete).off("click").on("click", function (e) {
            e.preventDefault();

            let publication = $(this).closest('.col-12.mb-3').find('.form__comments');
            let idPublication = publication.data('post-id');

            let comments = $(this).closest('.comments__btns');
            let idComments = comments.data('id-comments');

            let csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: $(this).attr('href'),
                data: {
                    _token: csrfToken,
                    idPublication: idPublication,
                    idComments: idComments,
                },
                success: (response) => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Comentario Eliminado',
                        showConfirmButton: false,
                        timer: 1000
                    });
                },
                error: (err) => {
                    console.error('Error:', err);
                }
            });
        });
    }

    edit(elementEdit) {

        let modalEditComment = `
        <div class="modal modal-edit-comentario">
            <div class="modal__content">
                <div class="modal__header">
                    <h5>Editar Comentario</h5>
                    <button class="modal__close modal__close--icon">×</button>
                </div>
                <div class="modal__body">
                    <form action="javascript:void(0)" method="POST" enctype="multipart/form-data" class="form-comentario__edit">
                        <div class="form-group">
                            <textarea class="form-control comentario-input" name="editcomentariopublicacion"></textarea>
                        </div>
                        <input type="hidden" class="id-post__edit-comentario">
                        <div class="form-group">
                            <button type="button" class="modal__button--emoji-toggle">😊</button>
                            <div class="form__cntn-emojis"></div> <!-- Aquí se inyectará el emoji-picker -->
                        </div>
                        <div class="modal__footer">
                            <button type="button" class="button button--modal-close" id="closeModalFooter">Cerrar</button>
                            <button type="submit" class="button">Aceptar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>`;

        // Inyectar el modal en el DOM si no existe ya
        if (!$('.modal-edit-comentario').length) {
            $('body').append(modalEditComment);
        }

        // Desplego el Modal
        $(elementEdit).off("click").on("click", function (e) {
            e.preventDefault();

            let comments = $(this).closest('.comments__btns');
            let idComments = comments.data('id-comments');
            let commentsText = $(this).closest('.comments__btns').parent('.comments__description').find('p').text();
            let href = $(this).attr('href');

            // Asignar el valor de "href" al atributo "action" del formulario
            $('.modal-edit-comentario').find('form').attr('action', href);

            // Asigno el id del comentario
            $('.modal-edit-comentario').find('.id-post__edit-comentario').val(idComments)

            // Asigno el comentario al campo de textarea
            $('.modal-edit-comentario').find('textarea').text(commentsText);

            // CIerre del Modal
            $('.modal-edit-comentario').addClass('modal--active').fadeIn();

            $('.modal__close, .button--modal-close').on('click', function () {
                $('.modal-edit-comentario').removeClass('modal--active').fadeOut();
            });

            $('.modal-edit-comentario').on('click', function (event) {
                if (event.target === this) {
                    $('.modal-edit-comentario').removeClass('modal--active').fadeOut();
                }
            });

        });

        // Enviar 
        let isEditing = false; // Bandera para verificar si se está enviando

        $(".form-comentario__edit").off("submit").on("submit", function (e) {
            e.preventDefault(); // Evita que el formulario se envíe de la manera tradicional
        
            let form = $(this);
        
            if (isEditing) {
                return; // Si ya se está enviando, no hacer nada
            }
        
            isEditing = true; // Marcar como enviando
        
            // Crear un objeto FormData para procesar tanto los campos de texto como los archivos
            let formData = new FormData(this);
            formData.append("comment_id", form.find('.id-post__edit-comentario').val());
        
            // Enviar los datos por AJAX
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
                    form[0].reset(); // Reinicia el formulario
                    $('.modal-edit-comentario').removeClass('modal--active');
                    Swal.fire({
                        icon: 'success',
                        title: '¡Comentario editado con éxito!',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    $('.modal-edit-comentario').removeClass('modal--active').fadeOut();
                },
                error: function (xhr, status, error) {
                    console.error("Error en la edición del comentario:", error);
                    // Aquí podrías mostrar un mensaje de error a los usuarios
                },
                complete: function () {
                    isEditing = false; // Reactivar después de la respuesta
                },
            });
        });
    }

    startCommentClass() {
        this.showComments(".btn__comments");
        this.collapseComments(".form__collapse");
        this.save(".form__comments");
        this.delete('.comments__btn-delete');
        this.edit('.comments__btn-edit');
    }
}

window.initComment = new CommentClass();
window.initComment.startCommentClass();
