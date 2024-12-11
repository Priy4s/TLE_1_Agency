import axios from 'axios';
import process from 'process';
window.axios = axios;

// Get the CSRF token from the meta tag
const csrfTokenMetaTag = document.querySelector('meta[name="csrf-token"]');
const csrfToken = csrfTokenMetaTag ? csrfTokenMetaTag.getAttribute('content') : null;

// If CSRF token is empty, you may want to log an error or throw an exception
if (csrfToken) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
} else {
    console.error('CSRF token not found');
}

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// Set Pusher to window object for global access
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY || '1329641be032028eff5c',
    cluster: process.env.MIX_PUSHER_APP_CLUSTER || 'eu',
    forceTLS: true,
    auth: {
        headers: {
            'X-CSRF-TOKEN': csrfToken,  // Add CSRF token here
        }
    }
});

const userMetaTag = document.querySelector('meta[name="user-id"]');
const userId = userMetaTag ? userMetaTag.getAttribute('content') : null;
window.Echo.private('chat.' + userId)
    .listen('MessageSent', (e) => {
        console.log('New message received:', e);

        // Update the DOM with the latest message
        const messageContainer = document.getElementById('messages');
        const messageElement = document.createElement('div');
        messageElement.classList.add('message');
        messageElement.innerHTML = `
            <strong>${e.sender}</strong>: ${e.content} <br>
            <small>${e.timestamp}</small>
        `;
        if (messageContainer) {
            messageContainer.appendChild(messageElement);
        } else {
            console.error('Message container not found');
        }
    });
