// Cargar lodash en el objeto global
window._ = require('lodash');

// Intentar cargar y configurar las bibliotecas
try {
    // Cargar Popper.js y jQuery
    window.Popper = require('@popperjs/core');
    window.$ = window.jQuery = require('jquery');

    // Importa los JavaScript de Bootstrap
    require('bootstrap');
} catch (e) {
    console.error('Error al cargar una de las dependencias: ', e);
}

/**
 * Cargar la biblioteca axios para realizar solicitudes HTTP
 * al back-end de Laravel. Esta biblioteca maneja automáticamente el envío del
 * token CSRF como un encabezado basado en el valor de la cookie "XSRF".
 */
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo expone una API expresiva para suscribirse a canales y escuchar
 * eventos que son transmitidos por Laravel. Echo y la transmisión de eventos
 * permiten a tu equipo construir fácilmente aplicaciones web en tiempo real robustas.
 */
import Echo from 'laravel-echo';
window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true
});

window.Swal = require('sweetalert2');
require('bootstrap/dist/js/bootstrap.bundle.min.js')
require('./broadcast/userSessionChanged');
require('./broadcast/notification');
require('./broadcast/chat');
require('./broadcast/publication');
require('./broadcast/comments');












