require('./bootstrap');

window.Echo.channel('notifications')
    .listen('UserSessionChanged', (e) => {

          // Parsear la cadena JSON de usuarios
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
          
      
      // if(e){
      //   e.usuarios.usuarios.original.forEach((user, index) => {
      //     const devUsuarios = document.getElementById('usuarioStatus' + user.id);
      //     if(devUsuarios){
      //       if (user.conectado == 1) {
      //         devUsuarios.innerText = 'Conectado';
      //         devUsuarios.style.color = 'green';
      //       } else {
      //         devUsuarios.innerText = 'Desconectado';
      //         devUsuarios.style.color = 'red';
      //       }
      //     }
      //   });
      // }
    });

// Importa el archivo CSS de Bootstrap
// import 'bootstrap/dist/css/bootstrap.min.css';

// Importa el archivo JavaScript de Bootstrap (que incluye Popper.js)
// import 'bootstrap/dist/js/bootstrap.bundle.min';


// Echo.channel('notificationss')
//   .listen('UserSessionChanged', (e) => {

//     const usuariosEvent = JSON.parse(e.usuarios);

//     Object.values(usuariosEvent).forEach((userListerner, index) => {
  
  

//     const devUsuarios = document.getElementById('usuarioStatus' + userListerner.id);

//     if (devUsuarios) {
//       if (userListerner.conectado == 1) {
//         devUsuarios.innerText = 'Conectado';
//         devUsuarios.style.color = 'green';
//       } else {
//         devUsuarios.innerText = 'Desconectado';
//         devUsuarios.style.color = 'red';
//       }
//     }

//     });

//   });
  
  
  // try {
  //   ee = JSON.parse(e.usuarios);
  //   ee.arrayListados.forEach((usuario, index) => {
  //     console.log(`El usuario en la posición ${index} es ${usuario.nombre}`);
  //   });
  // } catch (error) {
  //   console.error('Error al parsear la cadena JSON:', error);
  // }
  
// Echo.channel('notifications')
// .listen('UserSessionChanged', (e) => {

//   let dataUser = e.data;

//   dataUser.forEach((follo, index) => {


//     console.log(follo.id);

//   });
//   e.usuarios.usuarios.original.forEach((user, index) => {
//     const devUsuarios = document.getElementById('usuarioStatus' + user.id);
//     if (user.conectado == 1) {
//       devUsuarios.innerText = 'Conectado';
//       devUsuarios.style.color = 'green';
//     } else {
//       devUsuarios.innerText = 'Desconectado';
//       devUsuarios.style.color = 'red';
//     }
//   });
// });

// Echo.channel('agregarAmigos')
//   .listen('AgregarAmigosNotificacion', (e) => {

//     console.log(e);
//     e.usuario.forEach((user, index) => {
//       console.log(user.created_at);
//     });

//     var notificacionesAmistad = document.getElementById('notificacionesAmistad');

//     var li = document.createElement("li");
//     li.className = "notification-item";

//     var imagenNotificacion = document.createElement('i');
//     imagenNotificacion.className = "bi bi-check-circle text-success";
//     li.appendChild(imagenNotificacion);

//     var divNotificaciones = document.createElement("div");

//     var h4Alias = document.createElement("h4");
//     h4Alias.innerText = "This is a AliasA";
//     divNotificaciones.appendChild(h4Alias);

//     var parrafoNotificacion = document.createElement("p");
//     parrafoNotificacion.innerText = "This is a paragraph Creacion";
//     divNotificaciones.appendChild(parrafoNotificacion);

//     var parrrafoMensaje = document.createElement("p");
//     parrrafoMensaje.innerText = "This is a paragraph Mensaje";
//     divNotificaciones.appendChild(parrrafoMensaje);

//     li.appendChild(divNotificaciones);

//     notificacionesAmistad.appendChild(li);

//     var liHr = document.createElement("li");
//     var hr = document.createElement("hr");
//     hr.className = "dropdown-divider";
//     liHr.appendChild(hr);

//     notificacionesAmistad.appendChild(liHr);

//   });



