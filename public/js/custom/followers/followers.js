class FollowerClass {

    sendDataFollowers() {

        function loadMessagesChat(element) {

            // Mostrar el modal Chat
            let dataIdFollowers = element.closest('.show-contact__link').data('id-followers');
            // Asignar Id al Modal
            $('.modal-chat').find('.user-receptor-chat').val(dataIdFollowers);

            // Mmarcar todos los mensajes como leídos
            $.ajax({
                url: `${baseUrl}chats/${dataIdFollowers}`,
                method: 'GET',
                success: (response) => {
                    // Reiniciar Contactos Sidebar
                    let userFollowersNav = $('.show-contacts').find($(`[data-id-followers="${dataIdFollowers}"]`));
                    let newMessagesNavDiv = userFollowersNav.find('.show-contact__new-messages');
                    let showContactChat = userFollowersNav.find('.show-contact__chat');
                    newMessagesNavDiv.remove();
                    showContactChat.show();
                }
            });

            // Mostrar Mensajes en el Chat
            $.ajax({
                url: `${baseUrl}chats/${userLogin}/${dataIdFollowers}`,
                method: 'GET',
                success: (response) => {
                    $('.chat-container__box').empty();
                    response.forEach((message) => {
                        let messageClass = message.emisor_id == userLogin ? 'chat-container__message--sent' : 'chat-container__message--received';
                        let messageHtml = `<div class="chat-container__message ${messageClass}">
                                                <div class="chat-container__message-content">${message.message}</div>                        
                                            </div> `;
                        $('.chat-container__box').append(messageHtml);
                    });
                    $('.chat-container__box').scrollTop($('.chat-container__box')[0].scrollHeight);
                }
            });
        }

        // Enviar Ajax Texto Chat 
        $('.modal-chat').find('.sendMessage').off("click").on("click", (e) => {
            let parentContainer = $(e.currentTarget).closest('.chat-container__input')
            let userReceptor = parentContainer.find('.user-receptor-chat');
            let messageText = parentContainer.find('.chat__input').val().trim();
            if (userReceptor === 0) return;
            if (messageText) {
                $.ajax({
                    url: `${baseUrl}chats/send`,
                    method: 'GET',
                    data: {
                        emisor_id: userLogin,
                        receptor_id: userReceptor.val(),
                        message: messageText
                    },
                    success: () => {
                        $('.chat__input').val('');
                    }
                });
            }
        })

        // Enviar Ajax Texto Chat con Enter
        $('.modal-chat').find('.chat__input').off("keypress").on('keypress', (e) => {
            if (e.key === 'Enter') {
                let parentContainer = $(e.currentTarget).closest('.chat-container__input')
                let userReceptor = parentContainer.find('.user-receptor-chat');
                let messageText = parentContainer.find('.chat__input').val().trim()
                if (userReceptor === 0) return;
                if (messageText) {
                    $.ajax({
                        url: `${baseUrl}chats/send`,
                        method: 'GET',
                        data: {
                            emisor_id: userLogin,
                            receptor_id: userReceptor.val(),
                            message: messageText
                        },
                        success: () => {
                            $('.chat__input').val('');
                        }
                    });
                }
            }
        });

        // Cuando existe click en el INPUT
        $('.modal-chat').find('.chat__input').off("click").on("click", (e) => {
            let parentContainer = $(e.currentTarget).closest('.chat-container__input')
            let userReceptor = parentContainer.find('.user-receptor-chat');
            // Mmarcar todos los mensajes como leídos
            $.ajax({
                url: `${baseUrl}chats/${userReceptor.val()}`,
                method: 'GET',
                success: (response) => {
                    // Reiniciar Contactos Sidebar
                    let userFollowersNav = $('.show-contacts').find($(`[data-id-followers="${userReceptor.val()}"]`));
                    let newMessagesNavDiv = userFollowersNav.find('.show-contact__new-messages');
                    let showContactChat = userFollowersNav.find('.show-contact__chat');
                    newMessagesNavDiv.remove();
                    showContactChat.show();
                }
            });
        });

        // Adjuntar evento al botón "Ir al Chat - Mostrar Mensajes"
        $(".show-contact__chat").off("click").on("click", function (e) {
            e.preventDefault();
            $('.modal-chat').addClass('modal--active').fadeIn();
            loadMessagesChat($(this));
        });

        // Adjuntar evento al botón "Nuevos Mensajes - Mostrar Mensajes"
        $(".show-contact__new-messages").off("click").on("click", function (e) {
            e.preventDefault();
            $('.modal-chat').addClass('modal--active').fadeIn();
            loadMessagesChat($(this));
        });
    }

    apiFollowers() {
        window.axios.get(`/api/followers/${userLogin}`)
            .then((response) => {
                let showContacts = $(".show-emisor");
                let showFollowers = $(".show-follower");
                let data = response.data;
                let htmlEmisor = '';
                let htmlReceptor = '';

                // Iterar sobre usersEmisor (usuarios que el usuario sigue)
                data.usersEmisor.forEach((user) => {
                    // console.log(user);
                    let status = (user.conectado == 1)
                        ? '<span class="show-contact__online">Conectado</span>'
                        : '<span class="show-contact__off-online">Desconectado</span>';

                    // Verificar si tiene mensajes no leídos
                    let unreadMessages = user.unread_messages > 0
                        ? `<div class="show-contact__new-messages">                                
                                <div class="show-contact__count-messages">
                                    <span class="show-contact__count-text">${user.unread_messages}</span>    
                                    <i class="bi bi-envelope-fill"></i>
                                </div> nuevos
                            </div>`
                        : '<div class="show-contact__chat">Ir al Chat</div>'; // Si no hay mensajes no leídos, no mostrar nada

                    // Generar HTML para cada usuario seguido
                    htmlEmisor += `<div class="show-contact__link" data-id-followers="${user.id}"> 
                                        <a href="${baseUrl}usuario/${user.nombre}?estado=${user.estado}">
                                            <img src="${baseUrl}fotoPerfil/${user.fotoPerfil}" alt="${user.nombre}" />
                                        </a>
                                        <div class="show-contact__info"> 
                                            <a href="${baseUrl}usuario/${user.nombre}?estado=${user.estado}">
                                                <span class="show-contact__user-name">${user.nombre}</span>
                                            </a>
                                             <a href="${baseUrl}usuario/${user.nombre}?estado=${user.estado}">
                                                 ${status}
                                            </a>
                                            ${unreadMessages}
                                        </div>
                                    </div>`;
                });

                // Iterar sobre userReceptor (seguidores del usuario)
                data.userReceptor.forEach((user) => {
                    let status = (user.conectado == 1)
                        ? '<span class="show-contact__online">Conectado</span>'
                        : '<span class="show-contact__off-online">Desconectado</span>';

                    // Verificar si tiene mensajes no leídos
                    let unreadMessages = user.unread_messages > 0
                        ? `<div class="show-contact__new-messages">                                
                                <span class="show-contact__count-messages">${user.unread_messages}<i class="bi bi-envelope-fill"></i></span> nuevos
                            </div>`
                        : '<div class="show-contact__chat">Ir al Chat</div>'; // Si no hay mensajes no leídos, no mostrar nada

                    // Generar HTML para cada seguidor del usuario
                    htmlReceptor += `<div class="show-contact__link" data-id-followers="${user.id}"> 
                                        <a href="${baseUrl}usuario/${user.nombre}?estado=${user.estado}">
                                            <img src="${baseUrl}fotoPerfil/${user.fotoPerfil}" alt="${user.nombre}" />
                                        </a>
                                        <div class="show-contact__info"> 
                                            <a href="${baseUrl}usuario/${user.nombre}?estado=${user.estado}">
                                                <span class="show-contact__user-name">${user.nombre}</span>
                                            </a>
                                             <a href="${baseUrl}usuario/${user.nombre}?estado=${user.estado}">
                                                 ${status}
                                            </a>
                                            ${unreadMessages}
                                        </div>
                                    </div>`;
                });

                // Agregar los usuarios seguidos a su contenedor
                showContacts.append(htmlEmisor);
                showFollowers.append(htmlReceptor);

                // llama la funcion para enviar Data del chat
                this.sendDataFollowers();

            })
            .catch((error) => {
                console.error(error);
            });
    }

    // Contenedor de Funcionalidades
    startFollowerClass() {
        this.apiFollowers();
    }
}

// Instanciar la clase
let initFollower = new FollowerClass();
initFollower.startFollowerClass();


