class ChatClass {
    constructor() {
        this.messageInput = $('.chat__input');
        this.sendMessageButton = $('#sendMessage');
        this.videoCallButton = $('#videoCallButton');
        this.videoCallModal = $('#videoCallModal');
        this.userReceptor = $('#user-receptor');
        this.baseUrl = baseUrl;
        this.userLogin = userLogin;
    }

    modalChat() {
        let modalPublicacionEdit = `
        <div class="modal modal-chat">
            <div class="modal__content">
                <div class="modal__header">
                    <h5>Editar Publicación</h5>
                    <button class="modal__close modal__close--icon">×</button>
                </div>
                <div class="modal__body">
                    <h5 class="card-title">Chat</h5>
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
                            <button type="button" id="emojiButton" class="btn btn-secondary chat__emojis-toggle">😄 Emojis</button>
                            <input type="text" class="chat__input" placeholder="Type a message...">
                            <button type="button" id="sendMessage">Send</button>
                        </div>
                        <div class="form__cntn-emojis"></div>
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
            let messageText = this.messageInput.val().trim();
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
                        this.messageInput.val('');
                        this.scrollToBottom();
                    }
                });
            }
        };

        this.sendMessageButton.off("click").on("click", sendMessage);
        this.messageInput.on('keypress', (event) => {
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

    deployModalChat() {

        $('.header .nav-item-users').off("click").on('click', function (e) {
            
            let navNewMessage = $(this).find('.show-contact__new-messages');
            let navChat = $(this).find('.show-contact__chat');

            if (navNewMessage.length) {
                // Evento click para el nuevo mensaje
                navNewMessage.off("click").on('click', function (e) {
                    e.preventDefault();

                    // Mostrar el modal de edición
                    $('.modal-chat').addClass('modal--active').fadeIn();

                    // Reemplaza 'closed' por 'hide' si lo que quieres es ocultar el elemento
                    // let dataFollower = $(this).closest('.show-contact__info').parent('.show-contact__link');

                    // let dataIdFollower = dataFollower.data('id-followers');
                    // $.ajax({
                    //     url: `${window.baseUrl}chats/${dataIdFollower}`,
                    //     method: 'GET',
                    //     success: (response) => {
                    //         console.log(response);
                    //         // Nota: Queda Pendiente, poder levantar el popup en "ir a chat y count mensajes" - para Nav y para contactos.
                    //         // Queda Pendiente crear Chat Popup
                    //         // $('card-body pt-3')
                    //         // console.log("Todos los mensajes han sido marcados como leídos.");
                    //     }
                    // });

                });
            }

            if (navChat.length) {
                // Evento click para el nuevo mensaje
                navChat.off("click").on('click', function (e) {
                    e.preventDefault();
                    // Mostrar el modal de edición
                    $('.modal-chat').addClass('modal--active').fadeIn();
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

                console.log(response);

                // $('card-body pt-3')
                // console.log("Todos los mensajes han sido marcados como leídos.");
            }
        });
    }

    startChatClass() {
        this.chat();
        this.loadMessages();
        this.marcarComoLeidoChat();
        this.modalChat();

        this.deployModalChat();

    


    }
}

// Instanciamos la clase
let initChat = new ChatClass();
initChat.startChatClass();
