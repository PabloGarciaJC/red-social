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
  
        // Evitar que el emisor vea su propia notificación
        if (userLogin == e.userEmisor.id) {
            return;
        }

        // Actualizar número de notificaciones
        let notificationCount = $('#notification-count');
        let totalNotifications = $('#total-notifications');

        // Incrementar el conteo
        let currentCount = parseInt(notificationCount.text());
        notificationCount.text(currentCount + 1);
        totalNotifications.text(currentCount + 1);

        // Crear nueva notificación
        let newNotification = `<a href="${baseUrl}usuario/${e.userEmisor.alias}?estado=${e.estado}">
                                    <span class="notification-item nt-item__group">
                                        <img src="${baseUrl}fotoPerfil/${e.userEmisor.fotoPerfil}" class="nt-item__img" />
                                        <div class="nt-item__description">
                                            <span>${e.userEmisor.alias}</span>
                                            <span>${e.messajeNotification}</span>
                                        </div>
                                    </span>
                                </a>
                                <li><hr class="dropdown-divider"></li>`;

        // Insertar nueva notificación al principio de la lista
        $('#notifications-list').prepend(newNotification);
    });


