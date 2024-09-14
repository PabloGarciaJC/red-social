class initAppChatClass {

    chat() {

        let $messageInput = $('#messageInput');
        let $sendMessageButton = $('#sendMessage');
        let $emojiButton = $('#emojiButton');
        let $emojiPicker = $('#emojiPicker');
        let $videoCallButton = $('#videoCallButton');
        let $videoCallModal = $('#videoCallModal');

        // Función para enviar un mensaje
        function sendMessage() {
            let messageText = $messageInput.val().trim();
            if (messageText) {
                // Crear el elemento del mensaje en el chat
                let $messageElement = $('<div>', { class: 'chat-container__message chat-container__message--sent' })
                    .append($('<div>', { class: 'chat-container__message-content' })
                        .append($('<p>').text(messageText)));

                // Insertar el mensaje en la caja de chat
                $('.chat-container__box').append($messageElement);

                console.log(messageText);
                // Enviar el mensaje al servidor mediante AJAX
                // $.ajax({
                //     url: '/ruta-del-servidor', 
                //     type: 'POST',
                //     data: JSON.stringify({ message: messageText }), 
                //     contentType: 'application/json', 
                //     success: function (response) {
                //         console.log('Mensaje enviado correctamente');
                //     },
                //     error: function (error) {
                //         console.error('Error al enviar el mensaje:', error);
                //     }
                // });

                // Limpiar el campo de entrada
                $messageInput.val('');

                // Desplazar al último mensaje
                $('.chat-container__box').scrollTop($('.chat-container__box')[0].scrollHeight);
            }
        }

        // Función para insertar emoji
        function insertEmoji(emoji) {
            $messageInput.val($messageInput.val() + emoji);
            $emojiPicker.hide(); // Ocultar el selector de emojis
        }

        // Función para mostrar el selector de emojis
        function toggleEmojiPicker() {
            $emojiPicker.toggle(); // Alternar visibilidad
        }

        // Función para mostrar el modal de videollamada
        function openVideoCall() {
            $videoCallModal.show();
        }

        // Evento para enviar el mensaje al hacer clic en el botón
        $sendMessageButton.on('click', sendMessage);

        // Evento para enviar el mensaje al presionar Enter
        $messageInput.on('keypress', function (event) {
            if (event.key === 'Enter') {
                sendMessage();
                event.preventDefault(); // Evitar el salto de línea
            }
        });

        // Evento para mostrar/ocultar el selector de emojis
        $emojiButton.on('click', toggleEmojiPicker);

        // Eventos para insertar emojis
        $emojiPicker.on('click', '.chat-container__emoji', function () {
            insertEmoji($(this).text());
        });

        // Evento para abrir el modal de videollamada
        $videoCallButton.on('click', openVideoCall);


        // Función para cerrar el modal de videollamada
        $('.chat-container__close').on('click', function () {
            $videoCallModal.hide();
        });

        // Evento para cerrar el modal al hacer clic fuera del contenido
        $('#videoCallModal').on('click', function (event) {
            if ($(event.target).is('#videoCallModal')) {
                $('#videoCallModal').hide();
            }
        });
    }

    // Contendor de Funcionalidades
    startinitChat() {

        this.chat();

    }
}

// Instanciamos la clase
let initAppChat = new initAppChatClass();

// Iniciamos el proyecto
initAppChat.startinitChat();
