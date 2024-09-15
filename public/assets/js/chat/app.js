class initAppChatClass {

    // Método para manejar el chat
    chat() {

        let $messageInput = $('#messageInput');
        let $sendMessageButton = $('#sendMessage');
        let $emojiButton = $('#emojiButton');
        let $emojiPicker = $('#emojiPicker');
        let $videoCallButton = $('#videoCallButton');
        let $videoCallModal = $('#videoCallModal');

        // Función para enviar un mensaje
        const sendMessage = () => {
            let $userReceptor = $('#user-receptor');
            let messageText = $messageInput.val().trim();

            if ($userReceptor.length === 0) {
                console.error("El elemento con ID 'user-receptor' no existe en el DOM.");
                return;
            }

            if (messageText) {
                $.ajax({
                    url: `${baseUrl}chats/send`,
                    method: 'GET',
                    data: {
                        emisor_id: userLogin,
                        receptor_id: $userReceptor.val(),
                        message: messageText
                    },
                    success: (response) => {
                        $('#messageInput').val('');
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
        };

        // Evento para enviar el mensaje al hacer clic en el botón
        $sendMessageButton.on('click', sendMessage);

        // Evento para enviar el mensaje al presionar Enter
        $messageInput.on('keypress', function (event) {
            if (event.key === 'Enter') {
                sendMessage();
                event.preventDefault(); // Evitar el salto de línea
            }
        });

        // Función para insertar emoji
        const insertEmoji = (emoji) => {
            $messageInput.val($messageInput.val() + emoji);
            $emojiPicker.hide(); // Ocultar el selector de emojis
        };

        // Evento para mostrar/ocultar el selector de emojis
        $emojiButton.on('click', () => {
            $emojiPicker.toggle(); // Alternar visibilidad
        });

        // Eventos para insertar emojis
        $emojiPicker.on('click', '.chat-container__emoji', function () {
            insertEmoji($(this).text());
        });

        // Función para mostrar el modal de videollamada
        const openVideoCall = () => {
            $videoCallModal.show();
        };

        // Evento para abrir el modal de videollamada
        $videoCallButton.on('click', openVideoCall);

        // Función para cerrar el modal de videollamada
        $('.chat-container__close').on('click', () => {
            $videoCallModal.hide();
        });

        // Evento para cerrar el modal al hacer clic fuera del contenido
        $('#videoCallModal').on('click', function (event) {
            if ($(event.target).is('#videoCallModal')) {
                $('#videoCallModal').hide();
            }
        });
    }

    // Método para cargar mensajes
    loadMessages() {
        let $userReceptor = $('#user-receptor');
        let receptorId = $userReceptor.val();

        if ($userReceptor.length === 0) {
            console.error("El elemento con ID 'user-receptor' no existe en el DOM.");
            return;
        }

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

    // Método principal para iniciar el chat
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
