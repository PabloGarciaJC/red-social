class CommentClass {

    // Método para crear el HTML de la lista de emojis
    createEmojiPicker() {
        return `
            <div class="form__emoji-picker" style="display: none; margin-top: 10px;">
                <span class="form__emoji">😊</span>
                <span class="form__emoji">😂</span>
                <span class="form__emoji">😍</span>
                <span class="form__emoji">😉</span>
                <span class="form__emoji">😭</span>
                <span class="form__emoji">😎</span>
                <span class="form__emoji">😡</span>
                <span class="form__emoji">🥺</span>
                <span class="form__emoji">😜</span>
                <span class="form__emoji">🤔</span>
                <span class="form__emoji">👍</span>
                <span class="form__emoji">🙏</span>
                <span class="form__emoji">❤️</span>
                <span class="form__emoji">🎉</span>
                <span class="form__emoji">🔥</span>
                <span class="form__emoji">🤯</span>
                <span class="form__emoji">🤩</span>
                <span class="form__emoji">😇</span>
                <span class="form__emoji">🥳</span>
                <span class="form__emoji">🤪</span>
                <span class="form__emoji">👀</span>
                <span class="form__emoji">😏</span>
                <span class="form__emoji">💀</span>
                <span class="form__emoji">👻</span>
                <span class="form__emoji">🤤</span>
                <span class="form__emoji">😴</span>
                <span class="form__emoji">👑</span>
                <span class="form__emoji">💩</span>
                <span class="form__emoji">🦄</span>
                <span class="form__emoji">🐶</span>
                <span class="form__emoji">🐱</span>
                <span class="form__emoji">🐭</span>
                <span class="form__emoji">🐰</span>
                <span class="form__emoji">🐻</span>
                <span class="form__emoji">🐼</span>
                <span class="form__emoji">🐸</span>
                <span class="form__emoji">🦊</span>
                <span class="form__emoji">🐵</span>
                <span class="form__emoji">🦉</span>
                <span class="form__emoji">🐢</span>
                <span class="form__emoji">🐍</span>
                <span class="form__emoji">🐯</span>
                <span class="form__emoji">🦁</span>
                <span class="form__emoji">🐉</span>
                <span class="form__emoji">🦚</span>
                <span class="form__emoji">🌈</span>
                <span class="form__emoji">🌻</span>
                <span class="form__emoji">🌸</span>
                <span class="form__emoji">🌼</span>
                <span class="form__emoji">🌷</span>
                <span class="form__emoji">🍎</span>
                <span class="form__emoji">🍌</span>
                <span class="form__emoji">🍉</span>
                <span class="form__emoji">🍇</span>
                <span class="form__emoji">🍓</span>
                <span class="form__emoji">🍊</span>
                <span class="form__emoji">🍑</span>
                <span class="form__emoji">🥭</span>
                <span class="form__emoji">🍍</span>
                <span class="form__emoji">🥥</span>
                <span class="form__emoji">🍅</span>
                <span class="form__emoji">🥗</span>
                <span class="form__emoji">🍔</span>
                <span class="form__emoji">🍕</span>
                <span class="form__emoji">🌭</span>
                <span class="form__emoji">🍟</span>
                <span class="form__emoji">🍿</span>
                <span class="form__emoji">🥘</span>
                <span class="form__emoji">🍲</span>
                <span class="form__emoji">🍰</span>
                <span class="form__emoji">🍦</span>
                <span class="form__emoji">🍩</span>
                <span class="form__emoji">🍪</span>
                <span class="form__emoji">🎂</span>
                <span class="form__emoji">🎉</span>
                <span class="form__emoji">🍾</span>
                <span class="form__emoji">🍸</span>
                <span class="form__emoji">🍹</span>
                <span class="form__emoji">🍺</span>
                <span class="form__emoji">🥂</span>
                <span class="form__emoji">🧊</span>
                <span class="form__emoji">☕</span>
                <span class="form__emoji">🧋</span>
                <span class="form__emoji">🍵</span>
                <span class="form__emoji">🍶</span>
                <span class="form__emoji">🥤</span>
                <span class="form__emoji">🥛</span>
                <span class="form__emoji">🥡</span>
                <span class="form__emoji">🍙</span>
                <span class="form__emoji">🍚</span>
                <span class="form__emoji">🍱</span>
                <span class="form__emoji">🍛</span>
                <span class="form__emoji">🥟</span>
                <span class="form__emoji">🥙</span>
                <span class="form__emoji">🌮</span>
                <span class="form__emoji">🌯</span>
                <span class="form__emoji">🍢</span>
                <span class="form__emoji">🌿</span>
                <span class="form__emoji">🏆</span>
                <span class="form__emoji">⚽</span>
                <span class="form__emoji">🏀</span>
                <span class="form__emoji">🎾</span>
                <span class="form__emoji">🎳</span>
                <span class="form__emoji">🏋️‍♂️</span>
                <span class="form__emoji">🤸‍♂️</span>
                <span class="form__emoji">⛷️</span>
                <span class="form__emoji">🚴‍♂️</span>
                <span class="form__emoji">🚣‍♂️</span>
            </div>`;
    }

    showComments() {
        $(document).on("click", ".btn__comments", (e) => {
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

    collapseComments() {
        $(".form__collapse").on("click", (e) => {
            $(e.currentTarget)
                .closest(".justify-content-end")
                .find(".wrapper-comments")
                .slideUp();
        });
    }

    save() {
        // Evento para el submit del formulario (solo para texto)
        $(".form__comments").on("submit", function (e) {
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

    delete() {
        $('.comments__btn-delete').on('click', function (e) {
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

    initEmojiPicker(formClass, emojiContainerClass, toggleButtonClass, commentInputClass) {
        // Mostrar y ocultar el selector de emojis de manera contextual para cada formulario
        $(formClass).each((index, formElement) => {
            const form = $(formElement);

            // Verifica si ya se ha añadido el picker para evitar duplicados
            if (form.find('.form__emoji-picker').length === 0) {
                // Crear el emoji picker y añadirlo dentro del contenedor de emojis
                const emojiPicker = this.createEmojiPicker();
                form.find(emojiContainerClass).append(emojiPicker);
            }

            // Mostrar/ocultar emojis solo dentro del formulario actual
            form.find(toggleButtonClass).off('click').on('click', function () {
                form.find('.form__emoji-picker').slideToggle();
            });

            // Añadir emojis al input de comentario del formulario actual
            form.find('.form__emoji').off('click').on('click', function () {
                let comentarioInput = form.find(commentInputClass);
                comentarioInput.val(comentarioInput.val() + $(this).text());
                form.find('.form__emoji-picker').slideUp();
            });
        });
    }

    edit() {

        let modalEditComment = `
        <!-- Modal - EDITAR Comentarios -->
        <div class="modal modal-edit-comentario">
            <div class="modal__content">
                <div class="modal__header">
                    <h5>Editar Comentario</h5>
                    <button class="modal__close modal__close--icon">×</button>
                </div>
                <div class="modal__body">
                    <form action="#" method="POST" enctype="multipart/form-data" class="form-comentario__edit">
                        <div class="form-group">
                            <label for="commentTextarea">Escribe tu Comentario</label>
                            <textarea class="form-control comentario-input" name="editcomentariopublicacion"></textarea>
                        </div>
                  
                        <input type="hidden" class="id-post__edit-comentario">

                        <div class="form-group">

                            <label for="image-file-edit-comentario" class="modal__image-upload">
                                <span class="modal__image-icon-commentario">➕</span> Subir Imagenes
                                <input type="file" class="form-control-file" id="image-file-edit-comentario" name="editimagencomentario">
                            </label>

                            <button type="button" class="modal__button--emoji-toggle">😊</button>

                            <!-- Aquí se inyectará el emoji-picker -->
                            <div class="form__cntn-emojis"></div>
                            <!-- Contenedor de las vistas previas de las imágenes -->
                            <div class="modal__image-preview" style="display: none;">
                                <div class="modal__edit-image-wrapper">
                                    <a href="" class="lightbox-image" data-lightbox="gallery">
                                        <img id="image-edit-0" src="" alt="Imagen seleccionada" style="display: block; max-width: 100px; margin-right: 10px;">
                                    </a>
                                    <div class="modal__image-actions">
                                        <button type="button" class="edit-image-btn">
                                            <i class="bi bi-pencil"></i> Editar
                                        </button>
                                        <button type="button" class="delete-image-btn">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="modal__footer">
                            <button type="submit" class="button">Aceptar</button>
                            <button type="button" class="button button--modal-close" id="closeModalFooter">Cerrar</button>
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
        $('.comments__btn-edit').on('click', function (e) {
            e.preventDefault();

            let publication = $(this).closest('.col-12.mb-3').find('.form__comments');
            // let idPublication = publication.data('post-id');
            let comments = $(this).closest('.comments__btns');
            let idComments = comments.data('id-comments');
            let commentsText = $(this).closest('.comments__btns').parent('.comments__description').find('p').text();
            let commentsImg = $(this).closest('.comments__btns').parent('.comments__description').find('img');
            let href = $(this).attr('href');

            // Asignar el valor de "href" al atributo "action" del formulario
            $('.modal-edit-comentario').find('form').attr('action', href);

            // Asigno el id del comentario
            $('.modal-edit-comentario').find('.id-post__edit-comentario').val(idComments)

            // Asigno el comentario al campo de textarea
            $('.modal-edit-comentario').find('textarea').text(commentsText);

            // Muestra el contenedor de vista previa si hay imágenes seleccionadas
            if (commentsImg.length > 0) {

                // Si hay una imagen
                $('.modal-edit-comentario').find('.modal__image-preview').show();

                // Obtener el src de la imagen
                let imgSrc = commentsImg.attr('src');

                // Actualizar el href del enlace que contiene la imagen para lightbox
                $('.modal-edit-comentario').find('.modal__edit-image-wrapper .lightbox-image').attr('href', imgSrc);

                // También puedes mostrar la imagen en la vista previa
                $('.modal-edit-comentario').find('.modal__edit-image-wrapper .lightbox-image img').attr('src', imgSrc);

                // Oculto secciones del formulario
                $('.modal-edit-comentario').find('.form-group').first().hide();
                $('.modal-edit-comentario').find('.modal__button--emoji-toggle').hide();
                $('.modal-edit-comentario').find('.modal__image-upload').show();

            } else {

                // Muestro secciones del formulario
                $('.modal-edit-comentario').find('.form-group').first().show();
                $('.modal-edit-comentario').find('.modal__button--emoji-toggle').show();
                $('.modal-edit-comentario').find('.modal__image-upload').hide();
                // Si no hay imagen, ocultar el contenedor de vista previa
                $('.modal-edit-comentario').find('.modal__image-preview').hide();
            }

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

        // Escuchar cambios en el input de archivo
        $('#image-file-edit-comentario').on('change', function (e) {
            // Verificar si el usuario seleccionó un archivo
            if (e.target.files && e.target.files[0]) {
                let reader = new FileReader();

                // Leer el archivo como una URL de datos
                reader.onload = function (event) {
                    // Obtener la URL de la imagen
                    let imgSrc = event.target.result;

                    // Mostrar el contenedor de vista previa
                    $('.modal__image-preview').show();

                    // Actualizar la imagen en la vista previa
                    $('.modal__edit-image-wrapper .lightbox-image img').attr('src', imgSrc);

                    // Actualizar el href del enlace de la lightbox
                    $('.modal__edit-image-wrapper .lightbox-image').attr('href', imgSrc);
                };

                // Leer el archivo (imagen)
                reader.readAsDataURL(e.target.files[0]);

            } else {

                // Si no hay imagen, ocultar el contenedor de vista previa
                $('.modal__image-preview').hide();
            }
        });

        // Funcionalidad para el botón Editar Imagen
        $('.modal__image-preview').on('click', '.edit-image-btn', function () {
            $('#image-file-edit-comentario').click();
        });

        // Funcionalidad para el botón Eliminar Imagen
        $('.modal__image-preview').on('click', '.delete-image-btn', function () {
            // Limpiar el input de archivo
            $('#image-file-edit-comentario').val('');
            // Ocultar la vista previa de la imagen
            $('.modal__image-preview').hide();
            // Limpiar la imagen del contenedor
            $('.modal__edit-image-wrapper .lightbox-image img').attr('src', '');
            $('.modal__edit-image-wrapper .lightbox-image').attr('href', '');
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
                    // Resetear el formulario después de éxito
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
        this.showComments();
        this.collapseComments();
        this.save();
        this.delete();
        this.edit();
        this.initEmojiPicker('.form-comentario__edit', '.form__cntn-emojis', '.modal__button--emoji-toggle', '.comentario-input');
    }
}

window.initComment = new CommentClass();
window.initComment.startCommentClass();
