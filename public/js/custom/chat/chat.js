class ChatClass {
    constructor() {
        this.videoCallButton = $('#videoCallButton');
        this.videoCallModal = $('#videoCallModal');
        this.userReceptor = $('.user-receptor');
        this.baseUrl = baseUrl;
        this.userLogin = userLogin;
    }

    modalChat() {
        let modalPublicacionEdit = `
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
                            <input type="hidden" class="user-receptor-chat" value="">
                            <button type="button" id="emojiButton" class="btn btn-secondary chat__emojis-toggle">😄 Emojis</button>
                            <input type="text" class="chat__input" placeholder="Escribe el mensaje">
                            <button type="button" class="sendMessage">Send</button>
                        </div>
                        <div class="emojis-wrapper"></div>
                    </div>
                </div>
            </div>
        </div>`;

        // Inyectar el modal en el DOM si no existe ya
        if (!$('.modal-chat').length) {
            $('body').append(modalPublicacionEdit);
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

    chat() {
        const sendMessage = () => {
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
                        this.scrollToBottom();
                    }
                });
            }
        };

        $('.sendMessage').off("click").on("click", sendMessage);
        $('.chat__input').on('keypress', (event) => {
            if (event.key === 'Enter') {
                sendMessage();
                event.preventDefault();
            }
        });

        this.videoCallButton.on('click', () => this.videoCallModal.show());
        $('.chat-container__close').on('click', () => this.videoCallModal.hide());
        this.videoCallModal.on('click', (event) => {
            if ($(event.target).is('#videoCallModal')) this.videoCallModal.hide();
        });
    }

    scrollToBottom() {
        $('.chat-container__box').scrollTop($('.chat-container__box')[0].scrollHeight);
    }

    loadMessages() {
        if (this.userReceptor.length === 0) return;
        $.ajax({
            url: `${this.baseUrl}chats/${this.userLogin}/${this.userReceptor.val()}`,
            method: 'GET',
            success: (response) => {
                $('.chat-container__box').empty();
                response.forEach((message) => {
                    let messageClass = message.emisor_id == this.userLogin ? 'chat-container__message--sent' : 'chat-container__message--received';
                    let messageHtml = `
                        <div class="chat-container__message ${messageClass}">
                            <div class="chat-container__message-content">${message.message}</div>                        
                        </div>
                    `;
                    $('.chat-container__box').append(messageHtml);
                });
                this.scrollToBottom();
                // Llamar al método para marcar todos los mensajes como leídos
                this.markAllAsRead();
            }
        });
    }

    marcarComoLeidoChat() {
        $('.chat-container').off("click").on("click", (e) => {
            e.preventDefault();
            // Llamar al método para marcar todos los mensajes como leídos
            this.markAllAsRead();
        });
    }

    deployModalNavChat() {
        $('.header .nav-item-users').off("click").on('click', function (e) {
            let messageNew = $(this).find('.show-contact__new-messages');
            let goToChat = $(this).find('.show-contact__chat');

            function sendChatModal(element) {
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
                // Send Enviar chat
                $.ajax({
                    url: `${baseUrl}chats/${userLogin}/${dataIdFollowers}`,
                    method: 'GET',
                    success: (response) => {
                        $('.chat-container__box').empty();
                        response.forEach((message) => {
                            let messageClass = message.emisor_id == userLogin ? 'chat-container__message--sent' : 'chat-container__message--received';
                            let messageHtml = `<div class="chat-container__message ${messageClass}">
                                                    <div class="chat-container__message-content">${message.message}</div>                        
                                                </div> `;
                            $('.chat-container__box').append(messageHtml);
                        });
                        $('.chat-container__box').scrollTop($('.chat-container__box')[0].scrollHeight);
                    }
                });
            }

            // Enviar Ajax Texto Chat 
            $('.modal-chat').find('.sendMessage').off("click").on("click", (e) => {
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

            if (messageNew.length) {
                // Adjuntar evento al botón "Nuevos Mensajes - Mostrar Mensajes"
                messageNew.off("click").on('click', function (e) {
                    e.preventDefault();
                    // Despliega Modal del Chat
                    $('.modal-chat').addClass('modal--active').fadeIn();
                    // Enviar Datas
                    sendChatModal($(this));
                });
            }
            if (goToChat.length) {
                // Adjuntar evento al botón "Ir al Chat - Mostrar Mensajes"
                goToChat.off("click").on('click', function (e) {
                    e.preventDefault();
                    // Despliega Modal del chat
                    $('.modal-chat').addClass('modal--active').fadeIn();
                    // Enviar Dotos
                    sendChatModal($(this));
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

    startChatClass() {
        this.chat();
        this.deployModalNavChat();
        this.loadMessages();
        this.marcarComoLeidoChat();
        this.modalChat();
    }
}

// Instanciamos la clase
let initChat = new ChatClass();
initChat.startChatClass();
