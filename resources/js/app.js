require('./bootstrap');

window.Echo.channel('notifications')
    .listen('UserSessionChanged', (e) => {
        let usuarios = JSON.parse(e.usuarios);
        if (usuarios) {
            Object.keys(usuarios).forEach(key => {
                const user = usuarios[key];
                const devUsuarios = document.getElementById('usuarioStatus' + user.id);
                if (devUsuarios) {
                    if (user.conectado == 1) {
                        devUsuarios.innerText = 'Conectado';
                        devUsuarios.style.color = 'green';
                    } else {
                        devUsuarios.innerText = 'Desconectado';
                        devUsuarios.style.color = 'red';
                    }
                }
            });
        }
    });


Echo.channel('agregarAmigos')
    .listen('AgregarAmigosNotificacion', (e) => {
        console.log(e);
        // Maneja la notificación
    });


// Echo.channel('agregarAmigos')
//   .listen('AgregarAmigosNotificacion', (e) => {

//     console.log(e);

// e.usuario.forEach((user, index) => {
//   console.log(user.created_at);
// });

// var notificacionesAmistad = document.getElementById('notificacionesAmistad');

// var li = document.createElement("li");
// li.className = "notification-item";

// var imagenNotificacion = document.createElement('i');
// imagenNotificacion.className = "bi bi-check-circle text-success";
// li.appendChild(imagenNotificacion);

// var divNotificaciones = document.createElement("div");

// var h4Alias = document.createElement("h4");
// h4Alias.innerText = "This is a AliasA";
// divNotificaciones.appendChild(h4Alias);

// var parrafoNotificacion = document.createElement("p");
// parrafoNotificacion.innerText = "This is a paragraph Creacion";
// divNotificaciones.appendChild(parrafoNotificacion);

// var parrrafoMensaje = document.createElement("p");
// parrrafoMensaje.innerText = "This is a paragraph Mensaje";
// divNotificaciones.appendChild(parrrafoMensaje);

// li.appendChild(divNotificaciones);

// notificacionesAmistad.appendChild(li);

// var liHr = document.createElement("li");
// var hr = document.createElement("hr");
// hr.className = "dropdown-divider";
// liHr.appendChild(hr);

// notificacionesAmistad.appendChild(liHr);

//   });



