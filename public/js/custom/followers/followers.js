class FollowerClass {

    protectionLayer() {
        const protectionLayerValue = $('#protection-layer').text().trim();
        if (protectionLayerValue === '1') {
            Swal.fire({
                icon: 'warning',
                title: 'Acceso Restringido',
                html: `
                <p class="contact-message">Para autorizar el acceso a los módulos de esta red social, no dudes en contactarme a través de cualquiera de mis redes sociales.</p>
                <div class="social-links">
                <a href="https://www.facebook.com/PabloGarciaJC" target="_blank" title="Facebook"><i class="emoji-48"></i></a>
                <a href="https://www.instagram.com/pablogarciajc" target="_blank" title="Instagram"><i class="emoji-49"></i></a>
                <a href="https://www.linkedin.com/in/pablogarciajc" target="_blank" title="LinkedIn"><i class="emoji-50"></i></a>
                <a href="https://www.youtube.com/channel/UC5I4oY7BeNwT4gBu1ZKsEhw" target="_blank" title="YouTube"><i class="emoji-52"></i></a>
                </div>
                `,
                confirmButtonText: 'Cerrar',
            });
            return false;
        }
        return true;
    }

    sendDataFollowers() {

        function loadMessagesChat(element) {

            // Mostrar el modal Chat
            let dataIdFollowers = element.closest('.show-contact__link').data('id-followers');

            // Asignar Id al Modal
            $('.modal-chat').find('.user-receptor-chat').val(dataIdFollowers);

            // Marcar como leidos al hacer click en el Mensajes
            $.ajax({
                url: `${baseUrl}chats/${dataIdFollowers}`,
                method: 'GET',
                success: (response) => {
                    let userFollowersNav = $('.show-contacts').find($(`[data-id-followers="${dataIdFollowers}"]`));
                    let newMessagesNavDiv = userFollowersNav.find('.show-contact__new-messages');
                    newMessagesNavDiv.find('.show-contact__count-text').text(0);
                }
            });

            // Marcar como leidos Cuando existe click en el INPUT
            $('.modal-chat').find('.chat__input').off("click").on("click", (e) => {
                let parentContainer = $(e.currentTarget).closest('.chat-container__input')
                let userReceptor = parentContainer.find('.user-receptor-chat');

                $.ajax({
                    url: `${baseUrl}chats/${userReceptor.val()}`,
                    method: 'GET',
                    success: (response) => {
                        let userFollowersNav = $('.show-contacts').find($(`[data-id-followers="${userReceptor.val()}"]`));
                        let newMessagesNavDiv = userFollowersNav.find('.show-contact__new-messages');
                        newMessagesNavDiv.find('.show-contact__count-text').text(0);
                    }
                });
            });

            // Mostrar Mensajes en el Chat
            $.ajax({
                url: `${baseUrl}chats/${userLogin}/${dataIdFollowers}`,
                method: 'GET',
                success: (response) => {
                    $('.chat-container__box').empty();
                    response.forEach((message) => {
                        let messageClass = message.emisor_id == userLogin ? 'chat-container__message--sent' : 'chat-container__message--received';
                        let profileImageUrl = `${baseUrl}fotoPerfil/${message.fotoPerfil}`;
                        let messageHtml = ` 
                            <div class="chat-container__message ${messageClass}">
                                <a href="${baseUrl}usuario/${message.user}?estado=confirmado">
                                    <img src="${profileImageUrl}" alt="Foto de ${message.user}" class="chat-container__message-avatar">
                                </a>
                                <div class="chat-container__message-content">
                                    <span class="chat-user-bold">${message.user}</span> 
                                    <span class="chat-text">${message.message}</span> 
                                </div>
                            </div> `;
                        $('.chat-container__box').append(messageHtml);
                    });
                    $('.chat-container__box').scrollTop($('.chat-container__box')[0].scrollHeight);
                }
            });
        }

        const self = this;

        // Enviar Ajax Texto Chat 
        $('.modal-chat').find('.sendMessage').off("click").on("click", (e) => {


            let parentContainer = $(e.currentTarget).closest('.chat-container__input')
            let userReceptor = parentContainer.find('.user-receptor-chat');
            let messageText = parentContainer.find('.chat__input').val().trim();
            if (userReceptor === 0) return;

            if (!self.protectionLayer()) {
                return;
            }

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

                if (!self.protectionLayer()) {
                    return;
                }

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

                    let status = (user.conectado == 1) ? 'show-contact__online' : 'show-contact__off-online';

                    // Generar HTML para cada usuario seguido
                    htmlEmisor += `<div class="show-contact__link" data-id-followers="${user.id}"> 
                                        <a href="${baseUrl}usuario/${user.nombre}?estado=${user.estado}" class="${status}">
                                            <img src="${baseUrl}fotoPerfil/${user.fotoPerfil}" alt="${user.nombre}" />
                                        </a>
                                        <div class="show-contact__info"> 
                                            <a href="${baseUrl}usuario/${user.nombre}?estado=${user.estado}">
                                                <span class="show-contact__user-name">${user.nombre}</span>
                                            </a>
                                
                                            <div class="show-contact__new-messages">                                
                                                <div class="show-contact__count-messages">
                                                    <span class="show-contact__count-text">${user.unread_messages}</span>    
                                                    <i class="bi bi-envelope-fill"></i>
                                                </div> nuevos
                                            </div>

                                            <div class="show-contact__chat">Ir al Chat</div>

                                        </div>
                                    </div>`;
                });

                // Iterar sobre userReceptor (seguidores del usuario)
                data.userReceptor.forEach((user) => {

                    let status = (user.conectado == 1) ? 'show-contact__online' : 'show-contact__off-online';

                    // Generar HTML para cada seguidor del usuario
                    htmlReceptor += `<div class="show-contact__link" data-id-followers="${user.id}"> 
                                        <a href="${baseUrl}usuario/${user.nombre}?estado=${user.estado}" class="${status}">
                                            <img src="${baseUrl}fotoPerfil/${user.fotoPerfil}" alt="${user.nombre}" />
                                        </a>
                                        <div class="show-contact__info"> 
                                            <a href="${baseUrl}usuario/${user.nombre}?estado=${user.estado}">
                                                <span class="show-contact__user-name">${user.nombre}</span>
                                            </a>
                                           
                                            <div class="show-contact__new-messages">                                
                                                <div class="show-contact__count-messages">
                                                    <span class="show-contact__count-text">${user.unread_messages}</span>    
                                                    <i class="bi bi-envelope-fill"></i>
                                                </div> nuevos
                                            </div>

                                            <div class="show-contact__chat">Ir al Chat</div>

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


