class InitAppChatClass {
    constructor() {
        this.messageInput = $('#messageInput');
        this.sendMessageButton = $('#sendMessage');
        this.emojiButton = $('#emojiButton');
        this.emojiPicker = $('#emojiPicker');
        this.videoCallButton = $('#videoCallButton');
        this.videoCallModal = $('#videoCallModal');
        this.userReceptor = $('#user-receptor');
        this.baseUrl = baseUrl;
        this.userLogin = userLogin;
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
                    },
                    error: (xhr, status, error) => {
                        console.error("Error al enviar el mensaje:", { xhr, status, error, responseText: xhr.responseText });
                    }
                });
            }
        };

        this.sendMessageButton.on('click', sendMessage);
        this.messageInput.on('keypress', (event) => {
            if (event.key === 'Enter') {
                sendMessage();
                event.preventDefault();
            }
        });

        const insertEmoji = (emoji) => {
            this.messageInput.val(this.messageInput.val() + emoji);
            this.emojiPicker.hide();
        };

        this.emojiButton.on('click', () => this.emojiPicker.toggle());
        this.emojiPicker.on('click', '.chat-container__emoji', function () {
            insertEmoji($(this).text());
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
            },
            error: (err) => console.error("Error al cargar los mensajes:", err)
        });
    }

    startInitChat() {
        this.chat();
        this.loadMessages();
    }
}

// Instanciamos la clase
let initAppChat = new InitAppChatClass();
initAppChat.startInitChat();
