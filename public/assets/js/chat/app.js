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
            let $userReceptor = $('#user-receptor');

            if ($userReceptor.length === 0) {
                console.error("El elemento con ID 'user-receptor' no existe en el DOM.");
                return;
            }

            let messageText = $messageInput.val().trim();
            if (messageText) {
                // Crear el elemento del mensaje en el chat
                let $messageElement = $('<div>', { class: 'chat-container__message chat-container__message--sent' })
                        .append($('<div>', { class: 'chat-container__message-content' })
                        .text(messageText));

                // Insertar el mensaje en la caja de chat
                $('.chat-container__box').append($messageElement);

                $.ajax({
                    url: `${baseUrl}chats/send`,
                    method: 'GET',
                    data: {
                        emisor_id: userLogin,
                        receptor_id: $userReceptor.val(),
                        message: messageText
                    },
                    success: function (response) {
                        console.log('Respuesta del servidor:', response);
                        $('#messageInput').val('');
                        loadMessages();  // Recargar los mensajes si tienes una función para eso
                    },
                    error: function (xhr, status, error) {
                        console.error("Error al enviar el mensaje:", {
                            xhr: xhr,
                            status: status,
                            error: error,
                            responseText: xhr.responseText
                        });
                    }
                });

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

    loadMessages() {
        let $userReceptor = $('#user-receptor');

        if ($userReceptor.length === 0) {
            console.error("El elemento con ID 'user-receptor' no existe en el DOM.");
            return;
        }

        let receptorId = $userReceptor.val();

        $.ajax({
            url: `${baseUrl}chats/${userLogin}/${receptorId}`,
            method: 'GET',
            success: function (response) {
                // Limpiar el contenedor del chat antes de agregar nuevos mensajes
                $('.chat-container__box').empty();

                // Recorrer los mensajes obtenidos
                response.forEach(function (message) {
                    let messageClass = message.emisor_id == userLogin ? 'chat-container__message--sent' : 'chat-container__message--received';
                    let messageHtml = `
                    <div class="chat-container__message ${messageClass}">
                        <div class="chat-container__message-content">
                            ${message.message}
                        </div>                        
                    </div>
                `;
                    $('.chat-container__box').append(messageHtml);
                });
            },
            error: function (err) {
                console.error("Error al cargar los mensajes:", err);
            }
        });
    }

    // Contenedor de Funcionalidades
    startinitChat() {

        // Iniciar la funcionalidad del chat
        this.chat();

        // Cargar mensajes automáticamente cuando se carga la página
        this.loadMessages();
    }
}

// Instanciamos la clase
let initAppChat = new initAppChatClass();

// Iniciamos el proyecto
initAppChat.startinitChat();
