const CACHE_NAME = 'carnet-pwa-v17';

const STATIC_ASSETS = [
    '/',
    '/mi-carnet',
    '/manifest.json',
    '/Logo/Siris.png',
    'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css'
];

// INSTALACIÓN: toma el control inmediatamente sin esperar pestañas abiertas
self.addEventListener('install', event => {
    self.skipWaiting();

    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => cache.addAll(STATIC_ASSETS))
            .catch(error => {
                console.error('Error cacheando archivos estáticos:', error);
            })
    );
});

// ACTIVACIÓN: elimina cachés antiguos y reclama clientes activos
self.addEventListener('activate', event => {
    event.waitUntil(
        Promise.all([
            caches.keys().then(cacheNames => {
                return Promise.all(
                    cacheNames
                        .filter(cache => cache !== CACHE_NAME)
                        .map(cache => caches.delete(cache))
                );
            }),
            clients.claim()
        ])
    );
});

// FETCH: estrategia diferenciada por tipo de recurso
self.addEventListener('fetch', event => {

    if (event.request.method !== 'GET') {
        return;
    }

    const request = event.request;

    // HTML, JS y CSS -> Stale-While-Revalidate (Primera consulta local, luego sincroniza en segundo plano)
    if (
        request.destination === 'document' ||
        request.destination === 'script' ||
        request.destination === 'style'
    ) {
        event.respondWith(
            caches.match(request).then(cachedResponse => {
                const fetchPromise = fetch(request).then(networkResponse => {
                    if (networkResponse && networkResponse.status === 200) {
                        const clone = networkResponse.clone();
                        caches.open(CACHE_NAME).then(cache => cache.put(request, clone));
                    }
                    return networkResponse;
                }).catch(() => {
                    // Ignorar error de red si estamos offline
                });

                // Si hay en caché, lo devuelve inmediatamente. Mientras, el fetch ocurre en segundo plano.
                // Si no hay en caché, retorna el fetch directamente.
                return cachedResponse || fetchPromise;
            })
        );
        return;
    }

    // Imágenes -> Cache First (rendimiento óptimo, carga offline)
    if (
        request.destination === 'image' ||
        /\.(jpg|jpeg|png|gif|svg|webp|ico)$/i.test(request.url)
    ) {
        event.respondWith(
            caches.match(request, { ignoreSearch: true })
                .then(cached => {
                    if (cached) {
                        return cached;
                    }

                    return fetch(request)
                        .then(response => {
                            // Corrección: paréntesis explícitos para evitar error de precedencia
                            if (
                                response &&
                                response.status === 200 &&
                                (
                                    response.type === 'basic' ||
                                    response.type === 'cors'
                                )
                            ) {
                                const clone = response.clone();
                                caches.open(CACHE_NAME)
                                    .then(cache => cache.put(request, clone));
                            }
                            return response;
                        });
                })
                .catch(() => {
                    return new Response('', {
                        status: 404,
                        statusText: 'Offline'
                    });
                })
        );
        return;
    }

    // Otros recursos -> Network First con fallback a caché
    event.respondWith(
        fetch(request)
            .catch(() => caches.match(request))
    );
});
