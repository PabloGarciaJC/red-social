window.Echo.channel('broadcastChat-channel')
    .listen('.broadcastChat-event', (e) => {
        let chat = e.chat;
        let message = chat.message;
        let emisorId = chat.emisor_id;

        let messageClass = emisorId == userLogin ? 'chat-container__message--sent' : 'chat-container__message--received';

        let messageHtml = `
                    <div class="chat-container__message ${messageClass}">
                        <div class="chat-container__message-content">
                            ${message}
                        </div>                        
                    </div>
                `;

        let chatBox = $('.chat-container__box');
        if (chatBox.length > 0) {
            chatBox.append(messageHtml);
            chatBox.scrollTop(chatBox[0].scrollHeight);
        }
    });
;
