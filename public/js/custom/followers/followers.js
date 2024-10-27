class FollowerClass {

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


