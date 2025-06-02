class CommentClass {

    protectionLayer() {
        const protectionLayerValue = $('#protection-layer').text().trim();
        if (protectionLayerValue === '1') {
            Swal.fire({
                icon: 'warning',
                title: 'Acceso Restringido',
                html: `
                <p class="contact-message">
                Para utilizar los módulos de esta red social, te invito a contactarme mediante cualquiera de mis redes sociales.
                </p>
                <div class="social-links">
                <a href="https://www.facebook.com/PabloGarciaJC" target="_blank" title="Facebook"><i class="emoji-48"></i></a>
                <a href="https://www.instagram.com/pablogarciajc" target="_blank" title="Instagram"><i class="emoji-49"></i></a>
                <a href="https://www.linkedin.com/in/pablogarciajc" target="_blank" title="LinkedIn"><i class="emoji-50"></i></a>
                <a href="https://www.youtube.com/channel/UC5I4oY7BeNwT4gBu1ZKsEhw" target="_blank" title="YouTube"><i class="emoji-52"></i></a>
                </div>
                `,
                confirmButtonText: 'Cerrar',
            });
            return false;
        }
        return true;
    }

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

        const self = this;

        // Evento para el submit del formulario (solo para texto)
        $(elementForm).off("submit").on("submit", function (e) {
            e.preventDefault();
            let form = $(this);

            // Desactivar el botón de envío para evitar múltiples envíos
            const submitButton = form.find("button[type='submit']");
            submitButton.prop("disabled", true); // Desactiva el botón

            if (!self.protectionLayer()) {
                return;
            }

            // Verificar si el input de archivo tiene algo anpublications-id de enviar el formulario
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
        const self = this;

        $(elementBtnDelete).off("click").on("click", function (e) {
            e.preventDefault();

            let publication = $(this).closest('.col-12.mb-3').find('.form__comments');
            let idPublication = publication.data('post-id');
            let comments = $(this).closest('.comments__btns');
            let idComments = comments.data('id-comments');
            let csrfToken = $('meta[name="csrf-token"]').attr('content');

            if (!self.protectionLayer()) {
                return;
            }

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
                    <form action="javascript:void(0)" method="POST" enctype="multipart/form-data" class="modal__form-comments-edit">
                        <div class="form-group">
                            <textarea class="button form-control form__comentario-input" name="editcomentariopublicacion"></textarea>
                        </div>
                        <input type="hidden" class="id-post__edit-comentario">
                        <input type="hidden" class="publications-id" value="">
                        <div class="form-group modal__group">
                            <div class="modal__form-actions-commnets">
                                <button type="button" class="button modal__button--emoji-toggle"><i class="modal__icon emoji-31"></i></button>
                                <div class="emojis-wrapper"></div>
                            </div>
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

            // Asignar valores al formulario y al campo `.publications-id`
            $('.modal-edit-comentario').find('form').attr('action', href);
            $('.modal-edit-comentario').find('.id-post__edit-comentario').val(idComments);
            $('.modal-edit-comentario').find('textarea').val(commentsText);

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

        const self = this;

        // Enviar el formulario
        let isEditing = false; // Bandera para evitar envíos múltiples
        $(".modal__form-comments-edit").off("submit").on("submit", function (e) {
            e.preventDefault();

            if (isEditing) return;

            if (!self.protectionLayer()) {
                return;
            }

            isEditing = true;
            let form = $(this);
            let formData = new FormData(this);
            let commentId = form.find('.id-post__edit-comentario').val();

            if (!commentId) {

                let postId = form.find('.publications-id').val();
                formData.append("post_id", postId);


                // Obtener el contenido del textarea correctamente
                let comentarioTexto = form.find('.form__comentario-input').val();
                formData.append("comentario", comentarioTexto);

                // Enviar los datos por AJAX
                $.ajax({
                    url: form.attr("action"),
                    method: "POST",
                    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        form[0].reset();
                        $('.modal-edit-comentario').removeClass('modal--active');
                        Swal.fire({
                            icon: 'success',
                            title: '¡Comentario creado con éxito!',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        $('.modal-edit-comentario').removeClass('modal--active').fadeOut();
                    },
                    error: function (xhr, status, error) {
                        console.error("Error:", error);
                    }
                });

                isEditing = false;
                return;
            }

            formData.append("comment_id", commentId);
            $.ajax({
                url: form.attr('action'),
                method: "POST",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    form[0].reset();
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
                },
                complete: function () {
                    isEditing = false;
                },
            });
        });
    }

    createCommentsModal(elementEdit) {

        // Desplegar el Modal al hacer clic en `elementEdit`
        $(elementEdit).off("click").on("click", function (e) {
            e.preventDefault();

            let href = $(this).attr('href');
            let publicationId = $(this).data('publication-id');

            // Vaciar el contenido del textarea y del campo oculto
            $('.modal__form-comments-edit').find('.form__comentario-input').val('');
            $('.modal__form-comments-edit').find('.id-post__edit-comentario').val('');

            // Actualizar el atributo 'action' del formulario con el valor de `href`
            $('.modal__form-comments-edit').attr('action', href);

            // Asignar el valor de `publicationId` al campo `.publications-id`
            $('.modal__form-comments-edit').find('.publications-id').val(publicationId);

            // console.log("Valor actual de .publications-id:", $('.modal__form-comments-edit').find('.publications-id').val());

            // Mostrar el modal
            $('.modal-edit-comentario').addClass('modal--active').fadeIn();

            // Cerrar el modal al hacer clic en el botón de cierre o fuera del modal
            $('.modal__close, .button--modal-close').on('click', function () {
                $('.modal-edit-comentario').removeClass('modal--active').fadeOut();
            });

            $('.modal-edit-comentario').on('click', function (event) {
                if (event.target === this) {
                    $('.modal-edit-comentario').removeClass('modal--active').fadeOut();
                }
            });
        });
    }


    startCommentClass() {
        this.showComments(".btn__comments");
        this.collapseComments(".form__collapse");
        this.save(".form__comments");
        this.delete('.comments__btn-delete');
        this.edit('.comments__btn-edit');

        this.createCommentsModal('.comentar-publication');

    }
}

window.initComment = new CommentClass();
window.initComment.startCommentClass();
