
window._ = require('lodash');
//window.Popper = require('popper.js').default;

/**
 * Cargaremos jQuery y el complemento Bootstrap jQuery, que brinda soporte para
 * funciones de Bootstrap basadas en JavaScript, como modales y pestañas.
 * Este código puede ser modificado para ajustarse a las necesidades específicas
 * de su aplicación.
 */

try {
    window.$ = window.jQuery = require('jquery');
    Windows.Popper = require('popper.js');
    require('bootstrap');
} catch (e) {}

/**
 * Cargaremos la biblioteca HTTP de axios que nos permite emitir fácilmente
 * solicitudes a nuestro back-end de Laravel. Esta biblioteca maneja automáticamente
 * el envío del token CSRF como un encabezado basado en el valor de la cookie
 * token "XSRF".
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * A continuación, registraremos el token CSRF como un encabezado común con Axios para
 * que todas las solicitudes HTTP salientes lo tengan adjunto automáticamente. Esto es
 * solo una simple conveniencia, así que no tenemos que adjuntar cada token manualmente.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Echo expone una API expresiva para suscribirse a canales y escuchar eventos transmitidos
 * por Laravel. La transmisión de eventos y eco permite a su equipo construir fácilmente
 * aplicaciones web robustas en tiempo real.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });
