window.Echo.channel('broadcastChat-channel')
    .listen('.broadcastChat-event', (e) => {
        let chat = e.chat;
        let message = chat.message;
        let receptorId = chat.emisor_id;

        // Seleccionar al usuario en el menú de navegación y en la tarjeta de seguidores
        let userFollowersNav = $('.header .nav-item-users .dropdown-menu').find($(`[data-id-followers="${receptorId}"]`));
        let cntnUserFollower = $('.card-fixed').find($(`[data-id-followers="${receptorId}"]`));

        // Actualizar los mensajes no leídos en el menú de navegación
        let newMessagesNavDiv = userFollowersNav.find('.show-contact__new-messages');
        let messageCountNavText = newMessagesNavDiv.find('.show-contact__count-text');

        if (newMessagesNavDiv.length > 0) {
            let currentNavCount = parseInt(messageCountNavText.text());
            messageCountNavText.text(currentNavCount + 1);
        } else {
            userFollowersNav.find('.show-contact__chat').hide();
            const newMessageNavDiv = $(`
                <div class="show-contact__new-messages">                                
                    <div class="show-contact__count-messages">
                        <span class="show-contact__count-text">1</span>    
                        <i class="bi bi-envelope-fill"></i>
                    </div> nuevos
                </div>
            `);
            userFollowersNav.append(newMessageNavDiv);
        }

        // Actualizar los mensajes no leídos en la tarjeta de seguidores
        let newMessagesDiv = cntnUserFollower.find('.show-contact__new-messages');
        let messageCountElement = cntnUserFollower.find('.show-contact__info');

        if (newMessagesDiv.length > 0) {
            let messageCountText = newMessagesDiv.find('.show-contact__count-text');
            let currentCount = parseInt(messageCountText.text());
            messageCountText.text(currentCount + 1);
        } else {
            cntnUserFollower.find('.show-contact__chat').hide();
            const newMessageDiv = $(`
                <div class="show-contact__new-messages">                                
                    <div class="show-contact__count-messages">
                        <span class="show-contact__count-text">1</span>    
                        <i class="bi bi-envelope-fill"></i>
                    </div> nuevos
                </div>
            `);
            if (messageCountElement.length > 0) {
                messageCountElement.append(newMessageDiv);
            }
        }

        // Estilo del mensaje según si es enviado o recibido
        let messageClass = receptorId == userLogin ? 'chat-container__message--sent' : 'chat-container__message--received';

        let messageHtml = `
            <div class="chat-container__message ${messageClass}">
                <div class="chat-container__message-content">
                    ${message}
                </div>                        
            </div>
        `;

        // Añadir el mensaje a la caja de chat
        let chatBox = $('.chat-container__box');
        if (chatBox.length > 0) {
            chatBox.append(messageHtml);
            chatBox.scrollTop(chatBox[0].scrollHeight); // Desplazar hacia el final
        }
    });
