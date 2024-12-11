// resources/js/window.d.ts

import axios from 'axios';
import Pusher from 'pusher-js';
import Echo from 'laravel-echo';

// Extend the Window interface to include 'axios'
declare global {
    interface Window {
        axios: typeof axios;
        Pusher: typeof Pusher;
        Echo: Echo; //

    }
}

// If you're using `tsconfig.json` or `vite.config.js`, make sure the `include` field references this type file.
