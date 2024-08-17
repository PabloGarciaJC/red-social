// Importar lodash y asignar al objeto global
import _ from 'lodash';
window._ = _;

// Intentar cargar y configurar las bibliotecas
try {
    // Importar Popper.js y jQuery
    import('@popperjs/core').then(PopperModule => {
        window.Popper = PopperModule.default;
        
        import('jquery').then($Module => {
            window.$ = window.jQuery = $Module.default;

            // Importar Bootstrap después de jQuery
            import('bootstrap').catch(e => console.error('Error al cargar Bootstrap: ', e));
        }).catch(e => console.error('Error al cargar jQuery: ', e));
    }).catch(e => console.error('Error al cargar Popper.js: ', e));
} catch (e) {
    console.error('Error al cargar una de las dependencias: ', e);
}

/**
 * Cargar la biblioteca axios para realizar solicitudes HTTP
 */
import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo expone una API expresiva para suscribirse a canales y escuchar
 * eventos que son transmitidos por Laravel.
 */
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true // Asegúrate de que 'encrypted' esté escrito correctamente
});

// Escuchar el canal 'notifications' para el evento 'UserSessionChanged'
window.Echo.channel('notifications')
    .listen('UserSessionChanged', (e) => {
        console.log(e.type);
        console.log(e.usuarios);
        console.log(e.messaje);
    });
