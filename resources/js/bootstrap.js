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

import Choices from "choices.js";
window.Choices = Choices;


import Alpine from 'alpinejs'
import persist from '@alpinejs/persist'

Alpine.plugin(persist)

window.Alpine = Alpine

Alpine.start()


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

import {computePosition, shift, offset, flip, arrow, autoUpdate, hide} from "@floating-ui/dom";
window.computePosition = computePosition;
window.shift = shift;
window.offset = offset;
window.flip = flip;
window.arrow = arrow;
window.autoUpdate = autoUpdate;
window.hide = hide;

import Swiper from 'swiper/bundle';
window.Swiper = Swiper;

import * as FilePond from 'filepond';
window.FilePond = FilePond;

import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
window.FilePondPluginImagePreview = FilePondPluginImagePreview;

import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation';
window.FilePondPluginImageExifOrientation = FilePondPluginImageExifOrientation;

import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
window.FilePondPluginFileValidateSize = FilePondPluginFileValidateSize;

import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
window.FilePondPluginFileValidateType = FilePondPluginFileValidateType;

import FilePondPluginImageCrop from 'filepond-plugin-image-crop';
window.FilePondPluginImageCrop = FilePondPluginImageCrop;

import FilePondPluginImageTransform from 'filepond-plugin-image-transform';
window.FilePondPluginImageTransform = FilePondPluginImageTransform;

import FilePondPluginImageResize from 'filepond-plugin-image-resize';
window.FilePondPluginImageResize = FilePondPluginImageResize;

// import StarRating from "../blocks/ui/star-rating/star-rating";
// window.StarRating = StarRating;

import Quill from "quill";
window.Quill = Quill;
