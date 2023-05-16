/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
//     wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });

import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.start()

import Choices from "choices.js";
window.Choices = Choices;

import EditorJS from '@editorjs/editorjs';
window.EditorJS = EditorJS;

import { Fancybox } from "@fancyapps/ui";
window.Fancybox = Fancybox;

import {TabulatorFull as Tabulator} from 'tabulator-tables';
window.Tabulator = Tabulator;

import {HtmlTableImportModule} from 'tabulator-tables';
window.HtmlTableImportModule = HtmlTableImportModule;

import {ResponsiveLayoutModule} from 'tabulator-tables';
window.ResponsiveLayoutModule = ResponsiveLayoutModule;

import {computePosition, shift, offset, flip, arrow} from "@floating-ui/dom";
window.computePosition = computePosition;
window.shift = shift;
window.offset = offset;
window.flip = flip;
window.arrow = arrow;
