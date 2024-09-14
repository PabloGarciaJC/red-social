class initAppInitializer {

    apiFollowers() {
        window.axios.get(`/api/followers/${userLogin}`)
            .then((response) => {
                let showContacts = $("#showContacts");
                let showFollowers = $("#showFollowers");
                let data = response.data;
                let htmlEmisor = '';
                let htmlReceptor = '';

                // Iterar sobre usersEmisor (usuarios que el usuario sigue)
                data.usersEmisor.forEach((user) => {
                    let status = (user.conectado == 1)
                        ? '<span class="show-contact__online">conectado</span>'
                        : '<span class="show-contact__off-online">desconectado</span>';

                    htmlEmisor += `<a href="${baseUrl}usuario/${user.nombre}?estado=${user.estado}" class="show-contact__link"> 
                                    <img src="${baseUrl}fotoPerfil/${user.fotoPerfil}" alt="${user.nombre}" />
                                    <div class="show-contact__info"> 
                                        <span class="show-contact__user-name">${user.nombre}</span>
                                        ${status}
                                    </div>
                                </a>`;
                });

                // Iterar sobre userReceptor (seguidores del usuario)
                data.userReceptor.forEach((user) => {
                    let status = (user.conectado == 1)
                        ? '<span class="show-contact__online">conectado</span>'
                        : '<span class="show-contact__off-online">desconectado</span>';

                    htmlReceptor += `<a href="${baseUrl}usuario/${user.nombre}?estado=${user.estado}" class="show-contact__link"> 
                                    <img src="${baseUrl}fotoPerfil/${user.fotoPerfil}" alt="${user.nombre}" />
                                    <div class="show-contact__info"> 
                                        <span class="show-contact__user-name">${user.nombre}</span>
                                        ${status}
                                    </div>
                                </a>`;
                });

                // Agregar los usuarios seguidos a su contenedor
                showContacts.html(htmlEmisor);
                showFollowers.html(htmlReceptor);
            })
            .catch((error) => {
                console.error(error);
            });
    }

    chat() {

        let $messageInput = $('#messageInput');
        let $sendMessageButton = $('#sendMessage');
        let $emojiButton = $('#emojiButton');
        let $emojiPicker = $('#emojiPicker');
        let $videoCallButton = $('#videoCallButton');
        let $videoCallModal = $('#videoCallModal');
        let $closeModalButton = $('.chat-container__close');

        // Función para enviar un mensaje
        function sendMessage() {
            let messageText = $messageInput.val().trim();
            if (messageText) {
                let $messageElement = $('<div>', { class: 'chat-container__message chat-container__message--sent' })
                    .append($('<div>', { class: 'chat-container__message-content' })
                        .append($('<p>').text(messageText)));
                $('.chat-container__box').append($messageElement);
                $messageInput.val(''); // Limpiar el campo de entrada
                $('.chat-container__box').scrollTop($('.chat-container__box')[0].scrollHeight); // Desplazar al último mensaje
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
            $videoCallModal.show(); // Mostrar modal
        }

        // Función para cerrar el modal de videollamada
        function closeVideoCall() {
            $videoCallModal.hide(); // Ocultar modal
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

        // Evento para cerrar el modal de videollamada
        $closeModalButton.on('click', closeVideoCall);

    }
    
    // Contendor de Funcionalidades
    startinitApp() {
        this.apiFollowers();
        this.chat();
    }
}

// Instanciamos la clase
let initApp = new initAppInitializer();

// Iniciamos el proyecto
initApp.startinitApp();
