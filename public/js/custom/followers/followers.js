class FollowerClass {

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

    // Contendor de Funcionalidades
    startFollowerClass() {
        this.apiFollowers();
    }
}

// Instanciamos la clase
let initFollower = new FollowerClass();

// Iniciamos el proyecto
initFollower.startFollowerClass();
