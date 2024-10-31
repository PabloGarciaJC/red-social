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

    desplegarSidebar() {
        /*  Sidebar toggle */
        if ($('.toggle-sidebar-btn').length) {
            // Escucha el evento click
            $(document).on('click', '.toggle-sidebar-btn', function (e) {
                // Alterna la clase en el body
                $('body').toggleClass('toggle-sidebar');
            });
        }

        // Verifica si el botón de la barra de búsqueda existe
        if ($('.search-bar-toggle').length) {
            // Añade un evento click al botón
            $(document).on('click', '.search-bar-toggle', function (e) {
                // Alterna la clase para mostrar/ocultar la barra de búsqueda
                $('.search-bar').toggleClass('search-bar-show');
            });
        }
    }

    // Funcionalidades Generales
    startAppClass() {
        this.initEmojiPicker('.form-publication__create', '.form__cntn-emojis', '.modal__button--emoji-toggle', '.publication-input');
        this.initEmojiPicker('.form__comments', '.form__cntn-emojis', '.form__emojis-toggle', '.comentario-input');
        this.initEmojiPicker('.chat-container', '.form__cntn-emojis', '.chat__emojis-toggle', '.chat__input');
        this.initEmojiPicker('.form-publication__edit', '.form__cntn-emojis', '.modal__button--emoji-toggle', '.publication-input');
        this.initEmojiPicker('.form-comentario__edit', '.form__cntn-emojis', '.modal__button--emoji-toggle', '.comentario-input');
        this.desplegarSidebar();
    }
}

window.initApp = new AppClass();
window.initApp.startAppClass();

