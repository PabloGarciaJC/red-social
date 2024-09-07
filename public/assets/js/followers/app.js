class initAppInitializer {

    apiFollowers() {
        window.axios.get(`/api/followers/${userLogin}`)
        .then((response) => {
            let showContacts = $("#showContacts");
            let users = response.data;
            let html = '';
            // Crear un nuevo enlace para cada usuario
            users.forEach((user) => {
                let status = (user.conectado == 1) 
                    ? '<span class="show-contact__online">conectado</span>' 
                    : '<span class="show-contact__off-online">desconectado</span>';
    
                html += `<a href="${baseUrl}usuario/${user.nombre}?estado=${user.estado}" class="show-contact__link"> 
                            <img src="${baseUrl}fotoPerfil/${user.fotoPerfil}" alt="${user.nombre}" />
                            <div class="show-contact__info"> 
                                <span class="show-contact__user-name">${user.nombre}</span>
                                ${status}
                            </div>
                        </a>`;
            });
    
            // Agregar el HTML completo al contenedor una sola vez
            showContacts.html(html);
        });

    }

    startinitApp() {
        this.apiFollowers();
    }
}

// Instanciamos la clase
const initApp = new initAppInitializer();

// Iniciamos el proyecto
initApp.startinitApp();
