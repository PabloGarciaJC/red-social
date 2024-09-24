window.Echo.channel('broadcastChat-channel')
    .listen('.broadcastChat-event', (e) => {

        // Acceder a las propiedades del chat recibido
        let chat = e.chat;
        let message = chat.message;
        let emisorId = chat.emisor_id;

        // Determinar la clase del mensaje basado en el emisor
        let messageClass = emisorId == userLogin ? 'chat-container__message--sent' : 'chat-container__message--received';

        // Crear un nuevo elemento HTML para el mensaje
        let messageHtml = `
            <div class="chat-container__message ${messageClass}">
                <div class="chat-container__message-content">
                    ${message}
                </div>                        
            </div>
        `;

        // Agregar el mensaje a la caja del chat
        $('.chat-container__box').append(messageHtml);

        // Desplazar al último mensaje
        $('.chat-container__box').scrollTop($('.chat-container__box')[0].scrollHeight);
    });