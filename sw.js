self.addEventListener('install', event => {
    console.log('Service Worker instalado');
    self.skipWaiting();
});

self.addEventListener('activate', event => {
    console.log('Service Worker ativado');
    clients.claim();
});

self.addEventListener('fetch', event => {
    event.respondWith(fetch(event.request));
});
