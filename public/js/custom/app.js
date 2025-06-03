class AppClass {

    // Método para crear el HTML de la lista de emojis
    createEmojiPicker() {
        return `
                <div class="form__emoji-picker" style="display: none">
                    <span class="form__emoji" data-emoji="😊"><i class="emoji-1"></i></span>
                    <span class="form__emoji" data-emoji="😋"><i class="emoji-2"></i></span>
                    <span class="form__emoji" data-emoji="😍"><i class="emoji-4"></i></span>
                    <span class="form__emoji" data-emoji="😎"><i class="emoji-5"></i></span>
                    <span class="form__emoji" data-emoji="😊"><i class="emoji-7"></i></span>
                    <span class="form__emoji" data-emoji="😜"><i class="emoji-8"></i></span>
                    <span class="form__emoji" data-emoji="😝"><i class="emoji-9"></i></span>
                    <span class="form__emoji" data-emoji="😌"><i class="emoji-10"></i></span>
                    <span class="form__emoji" data-emoji="😟"><i class="emoji-11"></i></span>
                    <span class="form__emoji" data-emoji="😢"><i class="emoji-12"></i></span>
                    <span class="form__emoji" data-emoji="😣"><i class="emoji-13"></i></span>
                    <span class="form__emoji" data-emoji="😁"><i class="emoji-14"></i></span>
                    <span class="form__emoji" data-emoji="😱"><i class="emoji-16"></i></span>
                    <span class="form__emoji" data-emoji="😴"><i class="emoji-17"></i></span>
                    <span class="form__emoji" data-emoji="🤫"><i class="emoji-18"></i></span>
                    <span class="form__emoji" data-emoji="🤬"><i class="emoji-19"></i></span>
                    <span class="form__emoji" data-emoji="🤮"><i class="emoji-20"></i></span>
                    <span class="form__emoji" data-emoji="😂"><i class="emoji-21"></i></span>
                    <span class="form__emoji" data-emoji="😈"><i class="emoji-22"></i></span>
                    <span class="form__emoji" data-emoji="😉"><i class="emoji-23"></i></span>
                    <span class="form__emoji" data-emoji="😥"><i class="emoji-24"></i></span>
                    <span class="form__emoji" data-emoji="😨"><i class="emoji-25"></i></span>
                    <span class="form__emoji" data-emoji="🤑"><i class="emoji-26"></i></span>
                    <span class="form__emoji" data-emoji="🤩"><i class="emoji-27"></i></span>
                    <span class="form__emoji" data-emoji="🥰"><i class="emoji-28"></i></span>
                    <span class="form__emoji" data-emoji="😅"><i class="emoji-29"></i></span>
                    <span class="form__emoji" data-emoji="🥶"><i class="emoji-30"></i></span>
                </div>`;
    }

    initEmojiPicker(formClass, emojiContainerClass, toggleButtonClass, commentInputClass) {
        $(formClass).each((index, formElement) => {
            const form = $(formElement);

            if (form.find('.form__emoji-picker').length === 0) {
                const emojiPicker = this.createEmojiPicker();
                form.find(emojiContainerClass).append(emojiPicker);
            }

            form.find(toggleButtonClass).off('click').on('click', function () {
                form.find('.form__emoji-picker').slideToggle();
            });

            form.find('.form__emoji-picker').off('click').on('click', '.form__emoji', function () {
                const emojiSymbol = $(this).data('emoji'); // Obtiene el símbolo del emoji
                const commentInput = form.find(commentInputClass)[0];

                commentInput.focus();
                document.execCommand('insertText', false, emojiSymbol); // Inserta el símbolo del emoji en el cursor
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

    initScrollNav() {
        let initScrollTop = 0;
        let header = $(".card-publication");
        $(window).on("scroll", function () {
            let scroll = $(this).scrollTop();
            if (scroll === 0) {
                // Al llegar a la parte superior
                header.removeClass('card-animation');
            } else if (scroll > initScrollTop) {
                // Si el usuario hace scroll hacia abajo
                header.removeClass('card-animation');
            } else {
                // Si el usuario hace scroll hacia arriba
                header.addClass('card-animation');
            }
            initScrollTop = scroll;
        });
    }

    // Funcionalidades Generales
    startAppClass() {
        this.initEmojiPicker('.modal__form-publication-create', '.emojis-wrapper', '.modal__button--emoji-toggle', '.modal__publication-textarea');
        this.initEmojiPicker('.modal__form-publication-edit', '.emojis-wrapper', '.modal__button--emoji-toggle', '.modal__publication-textarea');
        this.initEmojiPicker('.form__comments', '.emojis-wrapper', '.form__emojis-toggle', '.form__comentario-input');
        this.initEmojiPicker('.modal__form-comments-edit', '.emojis-wrapper', '.modal__button--emoji-toggle', '.form__comentario-input');
        this.initEmojiPicker('.chat-container', '.emojis-wrapper', '.chat__emojis-toggle', '.chat__input');
        this.initEmojiPicker('.modal-chat', '.emojis-wrapper-grid-large', '.chat__emojis-toggle', '.chat__input');
        this.desplegarSidebar();
        this.initScrollNav();
    }
}

window.initApp = new AppClass();
window.initApp.startAppClass();

