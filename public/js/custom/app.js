class AppClass {

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
                form.find('.form__emoji-picker').toggle();
            });

            // Añadir emojis al input de comentario del formulario actual
            form.find('.form__emoji').off('click').on('click', function () {
                let comentarioInput = form.find(commentInputClass);
                comentarioInput.val(comentarioInput.val() + $(this).text());
            });
        });
    }

    // Método para vista preliminar de imágenes
    changeImagePreview($imageFileInput, $previeImage) {
        let currentImageSrc = $previeImage.attr('src'); // Almacena la imagen actual

        // Evento que se dispara al cambiar el input de archivo
        $imageFileInput.on('change', function (event) {
            const file = event.target.files[0]; // Obtiene el archivo seleccionado

            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    // Actualiza la imagen de vista previa
                    $previeImage.attr('src', e.target.result);
                    $previeImage.show();
                };

                reader.readAsDataURL(file); // Lee el archivo como una URL
            } else {
                // Si no hay archivo, restaura la imagen anterior
                $previeImage.attr('src', currentImageSrc);
            }
        });
    }

    updateImagePreview(previewSelector, inputSelector, labelSelector) {
        // Oculta todas las imágenes de vista previa al inicio
        $(previewSelector).hide();

        // Evento change directamente sobre el input de archivos
        $(inputSelector).on('change', function (event) {
            const file = event.target.files[0]; // Obtiene el archivo seleccionado

            if (file) {
                const reader = new FileReader();
                const input = $(event.target); // El input de archivo que cambió
                const form = input.closest('form'); // El formulario que contiene el input
                const label = input.closest(labelSelector); // El <label> contenedor del input

                reader.onload = function (e) {
                    // Mostrar previsualización de la imagen en ese formulario
                    const previewImg = form.find(previewSelector);
                    previewImg.attr('src', e.target.result);
                    previewImg.show();

                    // Si el botón de eliminar no existe aún, agregarlo
                    if (form.find('.delete-image-btn').length === 0) {
                        // Crea el bloque HTML del botón de "Eliminar"
                        const deleteButton = `
                            <button type="button" class="delete-image-btn">
                                <i class="bi bi-trash"></i> Eliminar
                            </button>
                        `;

                        // Inserta el botón después de la imagen de previsualización
                        previewImg.after(deleteButton);

                        // Evento para el botón de eliminar imagen
                        form.find('.delete-image-btn').on('click', function () {
                            // Elimina la imagen de vista previa
                            previewImg.attr('src', '#').hide(); // Oculta la imagen

                            // Elimina el botón de eliminar
                            $(this).remove();

                            // Restablece el input de archivo (limpia el valor)
                            input.val('');

                            // Restaura el fondo del label al estado original
                            label.css('background', '');
                        });
                    }
                };

                reader.readAsDataURL(file); // Lee el archivo como una URL
            } else {
                // Si no hay archivo, oculta la vista previa
                const form = $(event.target).closest('form');
                const previewImg = form.find(previewSelector);
                previewImg.hide(); // Oculta la imagen de vista previa si no hay archivo
            }
        });
    }



    // Función para manejar la vista previa de las imágenes
    changeImageCardPreview($imageFileInput, $imageWrapper) {
        // Inicializa un contador para generar IDs únicos
        let imageCount = 0;

        // Evento que se dispara cuando el input cambia (el usuario selecciona imágenes)
        $imageFileInput.on('change', function (event) {
            const files = event.target.files; // Obtiene los archivos seleccionados

            if (files.length > 0) {
                // Recorre cada archivo seleccionado
                Array.from(files).forEach((file) => {
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        const fileContent = e.target.result;
                        // Verifica si la imagen ya existe en la vista previa
                        const existingImage = $imageWrapper.find(`img[src="${fileContent}"]`);

                        // Salir si ya existe
                        if (existingImage.length > 0) {
                            return;
                        }

                        // Genera un ID único para la imagen utilizando el contador
                        const newPreviewId = 'preview-create-publication-' + Date.now() + '-' + imageCount++;

                        // Crea el bloque HTML de vista previa para la imagen con los botones de "Editar" y "Eliminar"
                        const newImagePreview = `
                            <div class="modal__image-preview-item" id="image-container-${newPreviewId}">
                                <a href="${fileContent}" class="lightbox-image" data-lightbox="gallery">
                                    <img id="${newPreviewId}" src="${fileContent}" alt="Imagen seleccionada" style="display: block; max-width: 100px; margin-right: 10px;">
                                </a>
                                <div class="modal__image-actions">
                                    <button type="button" class="edit-image-btn" data-target="${newPreviewId}">
                                        <i class="bi bi-book"></i> Editar
                                    </button>
                                    <button type="button" class="delete-image-btn" data-target="${newPreviewId}">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                </div>
                                <input type="file" class="hidden-input-file" id="input-${newPreviewId}" style="display: none;" accept="image/*">
                            </div>
                        `;

                        // Añadir la vista previa de la imagen al contenedor
                        $imageWrapper.append(newImagePreview);

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
                                    const isDuplicate = $imageWrapper.find(`img[src="${newFileContent}"]`).length > 0;
                                    if (isDuplicate) {
                                        return; // Salir si ya existe
                                    }

                                    // Actualiza la imagen de vista previa
                                    $(`#${newPreviewId}`).attr('src', newFileContent);
                                };
                                newReader.readAsDataURL(newFile); // Lee el archivo como una URL
                            }
                        });
                    };

                    // Leer el archivo como una URL para mostrarlo en la vista previa
                    reader.readAsDataURL(file);
                });

                // Muestra el contenedor de vista previa si hay imágenes seleccionadas
                $('.modal__image-preview').show();
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
    startAppClass() {
        // Crear Publicacion
        this.initEmojiPicker('.form-publication__create', '.form__cntn-emojis', '.modal__button--emoji-toggle', '.publication-input');
        // Cambia la vista previa de las imágenes
        this.changeImageCardPreview($('#image-file-create-publication'), $('.modal__image-wrapper'));
        // Comentarios
        this.initEmojiPicker('.form__comments', '.form__cntn-emojis', '.form__emojis-toggle', '.comentario-input');
        // Chat
        this.initEmojiPicker('.chat-container', '.form__cntn-emojis', '.chat__emojis-toggle', '.chat__input');

        // User Perfil
        this.changeImagePreview($('#image-file-perfil-user'), $('#previe-perfil-user'));

        // Visualiza la Imagen Previa los fomularios
        this.updateImagePreview('.previe-img-comments', '.image-commets', '.modal__image-upload');

        // Llama a la función para todos los slider
        this.initSlickSlider();






    }
}

window.initApp = new AppClass();
window.initApp.startAppClass();

