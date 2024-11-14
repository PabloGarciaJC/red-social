window.Echo.channel('broadcastChat-channel')
    .listen('.broadcastChat-event', (e) => {
        // Debug: Verifica los datos recibidos
        console.log('Recibido desde Pusher:', e);

        let chat = e.chat;  // El objeto chat completo
        let message = chat.data.message;  // El mensaje real
        let emisor = chat.emisor;  // Datos del emisor
        let receptorId = chat.data.emisor_id;  // ID del emisor (ya que es quien está enviando el mensaje)

        // Asegúrate de que el emisor tenga nombre y foto de perfil
        let emisorNombre = emisor.nombre;
        let emisorFoto = emisor.fotoPerfil;

        // Seleccionar al usuario en el menú de navegación y en la tarjeta de seguidores
        let userFollowersNav = $('.header .nav-item-users .dropdown-menu').find($(`[data-id-followers="${receptorId}"]`));
        let cntnUserFollower = $('.card-fixed').find($(`[data-id-followers="${receptorId}"]`));

        // Actualizar los mensajes no leídos en el menú de Navegación
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
            userFollowersNav.find('.show-contact__info').append(newMessageNavDiv);
        }

        // Actualizar los mensajes no leídos en la Card de seguidores en el Home
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

        // Definir la clase del mensaje según el receptor
        let messageClass = receptorId == userLogin ? 'chat-container__message--sent' : 'chat-container__message--received';

        // Crear el HTML del mensaje con el nombre y la foto de perfil del emisor
        let messageHtml = `
            <div class="chat-container__message ${messageClass}">
                <a href="${baseUrl}usuario/${receptorId}?estado=confirmado">
                    <img src="${baseUrl}fotoPerfil/${emisorFoto}" alt="Foto de ${emisorNombre}" class="chat-container__message-avatar">
                </a>
                <div class="chat-container__message-content">                 
                    <span class="chat-user-bold">${emisorNombre}</span> 
                    <span class="chat-text">${message}</span>      
                </div>
            </div>
        `;

        // Añadir el mensaje a la caja de chat
        let chatBox = $('.chat-container__box');
        if (chatBox.length > 0) {
            chatBox.append(messageHtml);
            chatBox.scrollTop(chatBox[0].scrollHeight); // Desplazar hacia el final
        }

        // Llamada a los métodos desde la clase
        initFollower.sendDataFollowers();
    });
