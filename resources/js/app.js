require('./bootstrap');

window.Echo.channel('broadcastUserSessionChanged-channel')
    .listen('UserSessionChanged', (e) => {

        // Parsear el JSON contenido en e.user
        let user = JSON.parse(e.user);

        // Función para actualizar el estado de un usuario
        function actualizarEstadoConexion(alias, conectado, selector) {
            const estadoClase = conectado === 1 ? 'show-contact__online' : 'show-contact__off-online';
            const estadoTexto = conectado === 1 ? 'Conectado' : 'desconectado';

            $(selector + ' .show-contact__user-name').each(function () {
                if ($(this).text() === alias) {
                    $(this).closest('.show-contact__link')
                        .find('.show-contact__off-online, .show-contact__online')
                        .removeClass()
                        .addClass(estadoClase)
                        .text(estadoTexto);
                }
            });
        }

        // Actualizar estado de userReceptor si existe
        if (user && user.userReceptor) {
            actualizarEstadoConexion(user.userReceptor.alias, user.userReceptor.conectado, '#showFollowers');
        }

        // Actualizar estado de userEmisor si existe
        if (user && user.userEmisor) {
            actualizarEstadoConexion(user.userEmisor.alias, user.userEmisor.conectado, '#showContacts');
        }
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


