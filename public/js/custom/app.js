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

            // Crear el emoji picker y añadirlo dentro del contenedor de emojis
            const emojiPicker = this.createEmojiPicker();
            form.find(emojiContainerClass).append(emojiPicker);

            // Mostrar/ocultar emojis solo dentro del formulario actual
            form.find(toggleButtonClass).on('click', function () {
                form.find('.form__emoji-picker').toggle();
            });

            // Añadir emojis al input de comentario del formulario actual
            form.find('.form__emoji').on('click', function () {
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

    // Funcionalidades
    startAppClass() {
        // Crear Publicacion
        this.initEmojiPicker('.form-publication__create', '.form__cntn-emojis', '.modal__button--emoji-toggle', '.publication-input');
        this.changeImagePreview($('#image-file-create-publication'), $('#previe-create-publication'));
        // Comentarios
        this.initEmojiPicker('.form__comments', '.form__cntn-emojis', '.form__emojis-toggle', '.comentario-input');
        // Chat
        this.initEmojiPicker('.chat-container', '.form__cntn-emojis', '.chat__emojis-toggle', '.chat__input');
        // User Perfil
        this.changeImagePreview($('#image-file-perfil-user'), $('#previe-perfil-user'));
    }
}

window.initApp = new AppClass();
window.initApp.startAppClass();

