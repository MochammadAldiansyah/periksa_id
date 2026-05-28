document.addEventListener('DOMContentLoaded', function() {
    const orders = document.querySelectorAll('.order-item');
    const maps = {};
    const markers = {};

    function initMap(orderId, savedLat, savedLng) {
        if (maps[orderId]) return; // Already initialized
        
        const mapContainer = document.getElementById('map-' + orderId);
        const mapWrap = document.getElementById('map-container-' + orderId);
        
        if (mapWrap) {
            mapWrap.classList.remove('hidden');
            mapWrap.classList.add('block');
        }

        // Parse saved coordinates, fallback to Jakarta if invalid
        let patientLat = savedLat ? parseFloat(savedLat) : -6.200000;
        let patientLng = savedLng ? parseFloat(savedLng) : 106.816666;

        // Simulate courier starting slightly South & West
        let courierLat = patientLat - 0.015;
        let courierLng = patientLng - 0.015;

        const map = L.map('map-' + orderId).setView([patientLat, patientLng], 13);
        maps[orderId] = map;

        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://carto.com/">Carto</a>'
        }).addTo(map);

        // Patient Marker
        L.marker([patientLat, patientLng], {title: 'Lokasi Pengiriman'}).addTo(map).bindPopup('Tujuan Pengiriman').openPopup();

        // Courier Marker
        const courierIcon = L.icon({
            iconUrl: 'https://cdn-icons-png.flaticon.com/512/2830/2830305.png',
            iconSize: [32, 32],
            iconAnchor: [16, 16],
        });

        markers[orderId] = L.marker([courierLat, courierLng], {icon: courierIcon}).addTo(map);

        // Simulate courier moving towards patient
        setInterval(() => {
            const step = 0.0002;
            if (courierLat < patientLat) courierLat += step;
            if (courierLat > patientLat) courierLat -= step;
            if (courierLng < patientLng) courierLng += step;
            if (courierLng > patientLng) courierLng -= step;
            
            markers[orderId].setLatLng([courierLat, courierLng]);
        }, 2000);
        
        setTimeout(() => {
            map.invalidateSize();
        }, 500);
    }

    // Initialize already 'dikirim' orders
    orders.forEach(el => {
        const id = el.getAttribute('data-id');
        const status = el.getAttribute('data-status');
        const lat = el.getAttribute('data-lat');
        const lng = el.getAttribute('data-lng');
        if (status === 'dikirim') {
            initMap(id, lat, lng);
        }
    });

    // Long-polling for 'pending' orders
    setInterval(() => {
        orders.forEach(el => {
            const id = el.getAttribute('data-id');
            const currentStatus = el.getAttribute('data-status');
            const lat = el.getAttribute('data-lat');
            const lng = el.getAttribute('data-lng');
            
            if (currentStatus === 'pending') {
                fetch('/orders/' + id + '/status')
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'dikirim') {
                            el.setAttribute('data-status', 'dikirim');
                            // Update badge
                            const badgeContainer = el.querySelector('.status-badge');
                            badgeContainer.innerHTML = '<span class="bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-full">Sedang Dikirim</span>';
                            
                            // Init Map
                            initMap(id, lat, lng);
                        }
                    })
                    .catch(err => console.error(err));
            }
        });
    }, 3000); // Check every 3 seconds
});
