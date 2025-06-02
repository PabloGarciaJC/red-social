class ChatClass {
    constructor() {
        this.userReceptor = $('.user-receptor');
        this.baseUrl = baseUrl;
        this.userLogin = userLogin;
    }

    protectionLayer() {
        const protectionLayerValue = $('#protection-layer').text().trim();
        if (protectionLayerValue === '1') {
            Swal.fire({
                icon: 'warning',
                title: 'Acceso Restringido',
                html: `
                <p style="margin-bottom: 10px;">
                Para utilizar los módulos de esta red social, te invito a contactarme mediante cualquiera de mis redes sociales.
                </p>
                <div style="display: flex; gap: 10px; justify-content: center;">
                    <a href="https://www.youtube.com/channel/UC5I4oY7BeNwT4gBu1ZKsEhw" target="_blank" title="YouTube"><i class="emoji-1"></i></a>
                    <a href="https://www.facebook.com/PabloGarciaJC" target="_blank" title="Facebook"><i class="emoji-1"></i></a>
                    <a href="https://twitter.com/PabloGarciaJC?t=lct1gxvE8DkqAr8dgxrHIw&s=09" target="_blank" title="Twitter"><i class="emoji-1"></i></a>
                    <a href="https://www.instagram.com/pablogarciajc/?utm_source=qr&igsh=djR6NDhpMzFmMHd4" target="_blank" title="Instagram"><i class="emoji-1"></i></a>
                    <a href="https://pablogarciajc.com/contactarme/" target="_blank" title="Web"><i class="emoji-1"></i></a>
                </div>`,
                confirmButtonText: 'Cerrar',
            });
            return false;
        }
        return true;
    }

    modalChat() {
        let modalChat = `
        <div class="modal modal-chat">
            <div class="modal__content">
                <div class="modal__header">
                    <h5>Chat</h5>
                    <button class="modal__close modal__close--icon">×</button>
                </div>
                <div class="modal__body">
                    <div class="chat-container">
                        <div class="chat-container__box">
                            <div class="chat-container__message chat-container__message--received">
                                <div class="chat-container__message-content"></div>
                            </div>
                            <div class="chat-container__message chat-container__message--sent">
                                <div class="chat-container__message-content"></div>
                            </div>
                        </div>
                        <div class="chat-container__input">
                            <input type="text" class="button chat__input" placeholder="Escribe el mensaje">
                            <button type="button" id="emojiButton" class="button btn-secondary chat__emojis-toggle"><i class="modal__icon emoji-31"></i></button>
                            <button type="button" class="button sendMessage"><i class="form__send-icon emoji-34"></i></button>
                            <input type="hidden" class="user-receptor-chat"> 
                        </div>
                        <div class="modal__cntn-emojis emojis-wrapper-grid-large"></div>
                    </div>
                </div>
            </div>
        </div>`;

        // Inyectar el modal en el DOM si no existe ya
        if (!$('.modal-chat').length) {
            $('body').append(modalChat);
        }

        // Cerrar el modal
        $('.modal__close--icon, .button--modal-close').on('click', function () {
            $('.modal-chat').removeClass('modal--active').fadeOut();
        });

        $('.modal-chat').on('click', function (event) {
            if (event.target === this) {
                $('.modal-chat').removeClass('modal--active').fadeOut();
            }
        });
    }

    chatNavMovil() {
        $('.header .nav-item-users').off("click").on('click', function (e) {
            let messageNew = $(this).find('.show-contact__new-messages');
            let goToChat = $(this).find('.show-contact__chat');
            alert('hola');
            function loadMessagesChatModal(element) {

                // Mostrar el modal Chat
                let dataIdFollowers = element.closest('.show-contact__link').data('id-followers');

                // Asignar Id al Modal
                $('.modal-chat').find('.user-receptor-chat').val(dataIdFollowers);

                // Mmarcar todos los mensajes como leídos
                $.ajax({
                    url: `${baseUrl}chats/${dataIdFollowers}`,
                    method: 'GET',
                    success: (response) => {
                        // Reiniciar Contactos NAV
                        let userFollowersNav = $('.show-contacts').find($(`[data-id-followers="${dataIdFollowers}"]`));
                        let newMessagesNavDiv = userFollowersNav.find('.show-contact__new-messages');
                        let showContactChat = userFollowersNav.find('.show-contact__chat');
                        newMessagesNavDiv.remove();
                        showContactChat.show();
                    }
                });

                // Mostrar Mensajes en el Chat
                $.ajax({
                    url: `${baseUrl}chats/${userLogin}/${dataIdFollowers}`,
                    method: 'GET',
                    success: (response) => {
                        $('.chat-container__box').empty();
                        response.forEach((message) => {
                            let messageClass = message.emisor_id == userLogin ? 'chat-container__message--sent' : 'chat-container__message--received';
                            let profileImageUrl = `${baseUrl}fotoPerfil/${message.fotoPerfil}`;
                            let messageHtml = ` 
                            <div class="chat-container__message ${messageClass}">
                                <a href="${baseUrl}usuario/${message.user}?estado=confirmado">
                                    <img src="${profileImageUrl}" alt="Foto de ${message.user}" class="chat-container__message-avatar">
                                </a>
                                <div class="chat-container__message-content">
                                    <span class="chat-user-bold">${message.user}</span> 
                                    <span class="chat-text">${message.message}</span> 
                                </div>
                            </div> `;
                            $('.chat-container__box').append(messageHtml);
                        });
                        $('.chat-container__box').scrollTop($('.chat-container__box')[0].scrollHeight);
                    }
                });
            }

            // Enviar Ajax Texto Chat desde el Modal
            $('.modal-chat').find('.sendMessage').off("click").on("click", (e) => {
                let parentContainer = $(e.currentTarget).closest('.chat-container__input')
                let userReceptor = parentContainer.find('.user-receptor-chat');
                let messageText = parentContainer.find('.chat__input').val().trim()
                // Chat de Nav
                if (userReceptor === 0) return;
                if (messageText) {
                    $.ajax({
                        url: `${baseUrl}chats/send`,
                        method: 'GET',
                        data: {
                            emisor_id: userLogin,
                            receptor_id: userReceptor.val(),
                            message: messageText
                        },
                        success: () => {
                            $('.chat__input').val('');
                        }
                    });
                }
            })

            // Enviar Ajax Texto Chat con Enter
            $('.modal-chat').find('.chat__input').off("keypress").on('keypress', (e) => {
                if (e.key === 'Enter') {
                    let parentContainer = $(e.currentTarget).closest('.chat-container__input')
                    let userReceptor = parentContainer.find('.user-receptor-chat');
                    let messageText = parentContainer.find('.chat__input').val().trim()
                    if (userReceptor === 0) return;
                    if (messageText) {
                        $.ajax({
                            url: `${baseUrl}chats/send`,
                            method: 'GET',
                            data: {
                                emisor_id: userLogin,
                                receptor_id: userReceptor.val(),
                                message: messageText
                            },
                            success: () => {
                                $('.chat__input').val('');
                            }
                        });
                    }
                }
            });

            // Cuando existe click en el INPUT
            $('.modal-chat').find('.chat__input').off("click").on("click", (e) => {
                let parentContainer = $(e.currentTarget).closest('.chat-container__input')
                let userReceptor = parentContainer.find('.user-receptor-chat');
                // Mmarcar todos los mensajes como leídos
                $.ajax({
                    url: `${baseUrl}chats/${userReceptor.val()}`,
                    method: 'GET',
                    success: (response) => {
                        // Reiniciar Contactos Sidebar
                        let userFollowersNav = $('.show-contacts').find($(`[data-id-followers="${userReceptor.val()}"]`));
                        let newMessagesNavDiv = userFollowersNav.find('.show-contact__new-messages');
                        let showContactChat = userFollowersNav.find('.show-contact__chat');
                        newMessagesNavDiv.remove();
                        showContactChat.show();
                    }
                });
            });

            // Adjuntar evento al botón "Nuevos Mensajes - Mostrar Mensajes"
            if (messageNew.length) {
                messageNew.off("click").on('click', function (e) {
                    e.preventDefault();
                    // Despliega Modal del Chat
                    $('.modal-chat').addClass('modal--active').fadeIn();
                    // Enviar Datas
                    loadMessagesChatModal($(this));
                });
            }

            // Adjuntar evento al botón "Ir al Chat - Mostrar Mensajes"
            if (goToChat.length) {
                goToChat.off("click").on('click', function (e) {
                    e.preventDefault();
                    // Despliega Modal del chat
                    $('.modal-chat').addClass('modal--active').fadeIn();
                    // Enviar Dotos
                    loadMessagesChatModal($(this));
                });
            }
        });
    }

    // Método para marcar todos los mensajes como leídos
    markAllAsRead() {
        if (this.userReceptor.length === 0) return;
        $.ajax({
            url: `${this.baseUrl}chats/${this.userReceptor.val()}`,
            method: 'GET',
            success: (response) => {
                // Reiniciar Contactos NAV
                let userFollowersNav = $('.show-contacts').find($(`[data-id-followers="${this.userReceptor.val()}"]`));
                let newMessagesNavDiv = userFollowersNav.find('.show-contact__new-messages');
                let showContactChat = userFollowersNav.find('.show-contact__chat');
                newMessagesNavDiv.remove();
                showContactChat.show();
            }
        });
    }

    chatUserPerfil() {
        // Mostrar Mensajes en el Chat
        if (this.userReceptor.length === 0) return;
        $.ajax({
            url: `${this.baseUrl}chats/${this.userLogin}/${this.userReceptor.val()}`,
            method: 'GET',
            success: (response) => {
                $('.chat-container__box').empty();
                response.forEach((message) => {
                    let messageClass = message.emisor_id == this.userLogin ? 'chat-container__message--sent' : 'chat-container__message--received';
                    let profileImageUrl = `${baseUrl}fotoPerfil/${message.fotoPerfil}`;
                    let messageHtml = `
                        <div class="chat-container__message ${messageClass}">
                            <a href="${baseUrl}usuario/${message.user}?estado=confirmado">
                                <img src="${profileImageUrl}" alt="Foto de ${message.user}" class="chat-container__message-avatar">
                            </a>
                            <div class="chat-container__message-content">
                                <span class="chat-user-bold">${message.user}</span> 
                                <span class="chat-text">${message.message}</span> 
                            </div>
                        </div>
                    `;
                    $('.chat-container__box').append(messageHtml);
                });
                $('.chat-container__box').scrollTop($('.chat-container__box')[0].scrollHeight);
                this.markAllAsRead();
            }
        });

        // Marcar todos los mensajes como leídos
        $('.chat-container').off("click").on("click", (e) => {
            e.preventDefault();
            this.markAllAsRead();
        });

        const sendMessage = () => {
            const self = this;
            if (!self.protectionLayer()) {
                return; 
            }
            let messageText = $('.chat__input').val().trim();
            if (this.userReceptor.length === 0) return;
            if (messageText) {
                $.ajax({
                    url: `${this.baseUrl}chats/send`,
                    method: 'GET',
                    data: {
                        emisor_id: this.userLogin,
                        receptor_id: this.userReceptor.val(),
                        message: messageText
                    },
                    success: () => {
                        $('.chat__input').val('');
                        $('.chat-container__box').scrollTop($('.chat-container__box')[0].scrollHeight);
                    }
                });
            }
        };

        // Enviar mensajes chat por Btn
        $('.sendMessage').off("click").on("click", sendMessage);

        // Enviar mensajes chat por Tecla Enter
        $('.chat__input').on('keypress', (event) => {
            if (event.key === 'Enter') {
                sendMessage();
                event.preventDefault();
            }
        });
    }

    startChatClass() {
        this.modalChat();
        this.chatUserPerfil();
        this.chatNavMovil();
    }
}

// Instanciamos la clase
let initChat = new ChatClass();
initChat.startChatClass();
