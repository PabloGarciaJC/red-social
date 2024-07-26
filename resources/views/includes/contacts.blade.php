<div class="col-lg-4">
    <!-- contactos -->
    <div class="card">
        <div class="filter">
            <a class="icon" href="{{ route('home') }}" id="contactos" style="color: green; font-size: 25px"><strong><i
                        class="bi bi-arrow-counterclockwise"></strong></i></a>
        </div>
        <div class="card-body pb-0">
            <h5 class="card-title">Contactos</h5>
            <div class="news" id="divContactos">
                {{-- Aqui van los Usuarios desde la Api --}}
            </div>
        </div>
    </div>
    <!-- contactos -->
</div>


{{-- Script de Listar Amigos --}}
@push('scripts')
    <script>
        // A travez de Windows Axios y la Api Dibujo los Followers
        let userLogin = document.getElementById('userLogin').value;

        /* Obtener Usuarios Seguidos - Conectados */
        // window.axios.get('/api/followers/' + userLogin)
        window.axios.get(`/api/followers/${userLogin}`)
            .then((response) => {

                const divContactos = document.getElementById("divContactos");
                
                let users = response.data;

                users.forEach((user, index) => {

                    let divUsuarios = document.createElement("div");
                    divUsuarios.className = "post-item clearfix";
                    divContactos.appendChild(divUsuarios);

                    let mostrarImagen = document.createElement('img');

                    if (user.fotoPerfil != null) {
                        mostrarImagen.src = baseUrl + 'fotoPerfil/' + user.fotoPerfil
                    } else {
                        mostrarImagen.src = baseUrl + 'assets/img/profile-img.jpg'
                    }

                    divUsuarios.appendChild(mostrarImagen);

                    let a = document.createElement('a');
                    a.innerHTML = "<h4>" + user.alias + "</h4>"

                    var url = baseUrl + "usuario/" + 'temp/' + '0';

                    url = url.replace('temp', user.alias);
                    a.href = url;

                    divUsuarios.appendChild(a);

                    let parrafo = document.createElement("p");
                    parrafo.innerHTML = "<h4>" + user.conectado + "</h4>"

                    parrafo.setAttribute('id', 'usuarioStatus' + user.id);

                    if (user.conectado == 1) {
                        parrafo.innerText = 'Conectado';
                        parrafo.style.color = 'green';
                    } else {
                        parrafo.innerText = 'Desconectado';
                        parrafo.style.color = 'red';
                    }

                    divUsuarios.appendChild(parrafo);

                });
            });
    </script>
@endpush
