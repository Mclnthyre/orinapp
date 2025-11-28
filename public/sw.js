// Versão do cache
const ORIN_CACHE = 'orin-cache-v1';

// Arquivos a serem pré-cacheados
const ASSETS = [
    '/',
    '/manifest.json',
    '/css/app.css',
    '/js/app.js',
];

// Install — adiciona arquivos ao cache
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(ORIN_CACHE).then(cache => {
            return cache.addAll(ASSETS);
        })
    );
});

// Activate — remove caches antigos
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(keys => {
            return Promise.all(
                keys.filter(key => key !== ORIN_CACHE)
                    .map(key => caches.delete(key))
            );
        })
    );
});

// Fetch — serve arquivos do cache quando offline
self.addEventListener('fetch', event => {
    event.respondWith(
        caches.match(event.request).then(cached => {
            return cached || fetch(event.request);
        })
    );
});
