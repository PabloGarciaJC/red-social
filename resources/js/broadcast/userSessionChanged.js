
window.Echo.channel('BroadcastUserSessionChanged-channel')
    .listen('BroadcastUserSessionChanged', (e) => {

        // Parsear el JSON contenido en e.user
        let user = JSON.parse(e.user);

        // Función para actualizar el estado de un usuario
        function actualizarEstadoConexion(alias, conectado, selector) {
            let estadoClase = conectado === 1 ? 'show-contact__online' : 'show-contact__off-online';
            $(selector + ' .show-contact__user-name').each(function () {
                if ($(this).text() === alias) {
                    $(this).closest('.show-contact__link')
                        .find('.show-contact__off-online, .show-contact__online')
                        .removeClass()
                        .addClass(estadoClase);
                }
            });
        }

        // Actualizar estado de userReceptor si existe
        if (user && user.userReceptor) {
            actualizarEstadoConexion(user.userReceptor.alias, user.userReceptor.conectado, '.show-follower');
        }

        // Actualizar estado de userEmisor si existe
        if (user && user.userEmisor) {
            actualizarEstadoConexion(user.userEmisor.alias, user.userEmisor.conectado, '.show-emisor');
        }
    });