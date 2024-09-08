require('./bootstrap');

window.Echo.channel('notifications')
    .listen('UserSessionChanged', (e) => {
        let userAlias = e.user[0].alias;
        let isOnline = e.user[0].conectado === 1;
        let statusClass = isOnline ? 'show-contact__online' : 'show-contact__off-online';
        let statusText = isOnline ? 'Conectado' : 'Desconectado';
        $('#showContacts .show-contact__user-name').each(function () {
            if ($(this).text() === userAlias) {
                $(this).closest('.show-contact__link')
                    .find('.show-contact__online, .show-contact__off-online')
                    .removeClass('show-contact__online show-contact__off-online')
                    .addClass(statusClass)
                    .text(statusText);
            }
        });
    });

window.Echo.channel('broadcastNotification-channel')
    .listen('.broadcastNotification-event', (e) => {

        // console.log(e);

        // let userRecibir = '112';
        // if (userRecibir != e.objetoUserLoginEnviar.id) {

        //     $('.badge.bg-primary.badge-number').html('1');
        //     $('.count-notification').html('1');
        //     console.log('pintalo');

        // } else {
        //     console.log('no lo pintes');
        // }



        // $('.badge.bg-primary.badge-number').html('1');
        // $('.count-notification').html('1');

        // // Construir el nuevo elemento de notificación // Falta  idFollower y idNotificacion
        // let newNotification = `                                                                                                
        //         <a href="http://localhost:8081/usuario/${e.objetoUserLoginEnviar.alias}/solicitudAmistad=0&idFollower=${e.objetoUserLoginEnviar.id}">
        //             <li class="notification-item">
        //                 <img src="${baseUrl}fotoPerfil/${e.objetoUserLoginEnviar.fotoPerfil}" 
        //                      width="60"
        //                      style="border-radius: 10px; padding: 0px; margin-right: 10px; margin-top: -10px"
        //                      alt="">
        //                 <div>
        //                     <h4>${e.objetoUserLoginEnviar.alias}</h4>
        //                     <p>${e.massaje}</p>
        //                 </div>
        //             </li>
        //         </a>
        //         <li><hr class="dropdown-divider"></li>
        //     `;

        // // Agregar la nueva notificación al inicio de la lista
        // $('#notificacionesAmistad').prepend(newNotification);

    });


