
window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap-sass');
    //require('bootstrap-rtl');
} catch (e) {}

window.default_values = {
    logos: {
        telegram: '/images/logos/telegram.png',
        instageam: '/images/logos/instagram.png'
    },
    defaults: {
        dp: '/images/defaults/dp.jpg',
        cover_photo: '/images/defaults/cover_photo.png'
    },
    routes: {
        base_url: window.location.origin,
        users: '/admin/users',
        staff_group: '/staff/group',

        resource: {
            index: function (base_route_name) {
                return this.appendBaseUrl(sprintf("%s", default_values.routes[base_route_name]));
            },
            show: function (base_route_name, id) {
                return this.appendBaseUrl(sprintf("%s/%s", default_values.routes[base_route_name], id));
            },
            create: function (base_route_name) {
                return this.appendBaseUrl(sprintf("%s/create", default_values.routes[base_route_name]));
            },
            store: function (base_route_name) {
                return this.appendBaseUrl(sprintf("%s", default_values.routes[base_route_name]));
            },
            edit: function (base_route_name, id) {
                return this.appendBaseUrl(sprintf("%s/%s/edit", default_values.routes[base_route_name], id));
            },
            update: function (base_route_name, id) {
                return this.appendBaseUrl(sprintf("%s/%s", default_values.routes[base_route_name], id));
            },
            destroy: function (base_route_name, id) {
                return this.appendBaseUrl(sprintf("%s/%s", default_values.routes[base_route_name], id));
            },
            appendBaseUrl: function(url){
                return sprintf("%s%s", default_values.routes.base_url, url);
            }
        }
    }
};

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['Accept'] = 'application/json';
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

var sprintf = require('sprintf-js').sprintf,
    vsprintf = require('sprintf-js').vsprintf;

window.removeNulls = function (obj) {
    var isArray = obj instanceof Array;
    for (var k in obj) {
        if (obj[k] === null) isArray ? obj.splice(k, 1) : delete obj[k];
        else if (typeof obj[k] == "object") removeNulls(obj[k]);
        if (isArray && obj.length == k) removeNulls(obj);
    }
    return obj;
}


/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });
