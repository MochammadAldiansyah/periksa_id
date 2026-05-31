document.addEventListener('DOMContentLoaded', function() {
    let map = null;
    let userMarker = null;
    let hospitalMarkers = L.layerGroup();
    let allHospitals = [];

    const overlay = document.getElementById('permission-overlay');
    const btnGrant = document.getElementById('btn-grant-location');
    const statusText = document.getElementById('location-status');
    const listContainer = document.getElementById('hospitals-list');
    const skeletonLoader = document.getElementById('skeleton-loader');
    const searchInput = document.getElementById('hospital-search');

    // Initialize Map with default view (Indonesia)
    function initMap() {
        if (!map) {
            map = L.map('hospital-map').setView([-2.5489, 118.0149], 5);
            L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                attribution: '&copy; <a href="https://carto.com/">Carto</a>'
            }).addTo(map);
            hospitalMarkers.addTo(map);
        }
    }

    initMap();

    // Ask for location
    btnGrant.addEventListener('click', function() {
        if (!navigator.geolocation) {
            alert("Browser Anda tidak mendukung fitur Geolocation.");
            return;
        }

        btnGrant.innerHTML = '<span class="animate-pulse">Mencari...</span>';
        btnGrant.disabled = true;

        navigator.geolocation.getCurrentPosition(
            position => {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;

                // Hide overlay
                overlay.style.opacity = '0';
                setTimeout(() => { overlay.classList.add('hidden'); }, 300);

                // Update Map
                map.setView([lat, lng], 14);

                // Add user marker
                const userIcon = L.icon({
                    iconUrl: 'https://cdn-icons-png.flaticon.com/512/149/149059.png', // Default user marker
                    iconSize: [36, 36],
                    iconAnchor: [18, 36]
                });

                if (userMarker) {
                    userMarker.setLatLng([lat, lng]);
                } else {
                    userMarker = L.marker([lat, lng], {icon: userIcon, zIndexOffset: 1000})
                                 .addTo(map)
                                 .bindPopup('<b>Lokasi Anda Saat Ini</b>')
                                 .openPopup();
                }

                statusText.innerText = "Mencari fasilitas kesehatan di sekitar...";
                fetchHospitals(lat, lng);
            },
            error => {
                alert("Gagal mendapatkan lokasi. Pastikan GPS aktif dan Anda memberikan izin.");
                btnGrant.innerHTML = 'Izinkan Akses Lokasi';
                btnGrant.disabled = false;
            },
            {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            }
        );
    });

    // Fetch from Overpass API
    function fetchHospitals(lat, lng) {
        // Radius in meters (e.g., 5000 = 5km)
        const radius = 5000;

        // Overpass QL to get hospitals and clinics
        const query = `
            [out:json][timeout:25];
            (
              node["amenity"="hospital"](around:${radius},${lat},${lng});
              way["amenity"="hospital"](around:${radius},${lat},${lng});
              node["amenity"="clinic"](around:${radius},${lat},${lng});
              way["amenity"="clinic"](around:${radius},${lat},${lng});
            );
            out center;
        `;

        const url = `https://overpass-api.de/api/interpreter?data=${encodeURIComponent(query)}`;

        fetch(url)
        .then(res => res.json())
        .then(data => {
            skeletonLoader.classList.add('hidden');

            if (!data.elements || data.elements.length === 0) {
                statusText.innerText = `Tidak ada rumah sakit ditemukan dalam radius ${radius/1000}km.`;
                listContainer.innerHTML += `<div class="text-center p-6 text-gray-500">Gagal menemukan fasilitas terdekat. Coba geser peta atau perbesar area.</div>`;
                return;
            }

            statusText.innerText = `Ditemukan ${data.elements.length} fasilitas kesehatan di sekitar Anda.`;

            // Process data
            allHospitals = data.elements.map(el => {
                const elLat = el.lat || el.center.lat;
                const elLon = el.lon || el.center.lon;
                const name = el.tags.name || (el.tags.amenity === 'clinic' ? 'Klinik Tanpa Nama' : 'Rumah Sakit Tanpa Nama');
                const distance = calculateDistance(lat, lng, elLat, elLon);

                return {
                    id: el.id,
                    name: name,
                    type: el.tags.amenity === 'clinic' ? 'Klinik' : 'Rumah Sakit',
                    address: el.tags['addr:street'] || 'Alamat tidak tersedia',
                    lat: elLat,
                    lng: elLon,
                    distance: distance
                };
            });

            // Sort by distance
            allHospitals.sort((a, b) => a.distance - b.distance);

            renderMarkers(allHospitals);
            renderList(allHospitals);
        })
        .catch(err => {
            console.error(err);
            skeletonLoader.classList.add('hidden');
            statusText.innerText = "Terjadi kesalahan saat memuat data dari server peta.";
        });
    }

    function renderMarkers(hospitals) {
        hospitalMarkers.clearLayers();

        const hospitalIcon = L.icon({
            iconUrl: 'https://cdn-icons-png.flaticon.com/512/2830/2830310.png', // Medical icon
            iconSize: [32, 32],
            iconAnchor: [16, 32]
        });

        hospitals.forEach(h => {
            const marker = L.marker([h.lat, h.lng], {icon: hospitalIcon});
            marker.bindPopup(`
                <div class="text-sm">
                    <b class="text-[#0046A0] text-base">${h.name}</b><br>
                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-0.5 rounded-full mt-1 inline-block">${h.type}</span><br>
                    <div class="mt-2 text-gray-600">${h.address}</div>
                    <div class="mt-1 font-bold text-gray-900">${h.distance.toFixed(1)} km dari Anda</div>
                </div>
            `);
            hospitalMarkers.addLayer(marker);
        });
    }

    function renderList(hospitals) {
        // Remove existing items
        const existingItems = listContainer.querySelectorAll('.hospital-item');
        existingItems.forEach(item => item.remove());

        if (hospitals.length === 0) {
            listContainer.innerHTML += `<div class="hospital-item text-center p-6 text-gray-500">Tidak ada hasil yang cocok.</div>`;
            return;
        }

        hospitals.forEach(h => {
            const div = document.createElement('div');
            div.className = 'hospital-item p-3 border border-slate-100 rounded-xl hover:bg-slate-50 cursor-pointer transition-colors flex gap-3 items-start';
            div.innerHTML = `
                <div class="w-10 h-10  text-[#0046A0] rounded-lg shrink-0 flex items-center justify-center font-bold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="font-bold text-gray-900 text-sm truncate">${h.name}</h4>
                    <p class="text-xs text-gray-500 truncate mt-0.5">${h.type} &bull; ${h.address}</p>
                    <div class="text-xs font-bold text-[#0046A0] mt-1">${h.distance.toFixed(1)} km</div>
                </div>
            `;

            div.addEventListener('click', () => {
                map.setView([h.lat, h.lng], 16);
                // Find marker and open popup
                hospitalMarkers.eachLayer(marker => {
                    if (marker.getLatLng().lat === h.lat && marker.getLatLng().lng === h.lng) {
                        marker.openPopup();
                    }
                });
            });

            listContainer.appendChild(div);
        });
    }

    // Search functionality
    searchInput.addEventListener('input', function(e) {
        const val = e.target.value.toLowerCase();
        const filtered = allHospitals.filter(h => h.name.toLowerCase().includes(val));
        renderList(filtered);
    });

    // Haversine formula to calculate distance in km
    function calculateDistance(lat1, lon1, lat2, lon2) {
        const R = 6371; // Radius of the earth in km
        const dLat = deg2rad(lat2 - lat1);
        const dLon = deg2rad(lon2 - lon1);
        const a =
            Math.sin(dLat/2) * Math.sin(dLat/2) +
            Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
            Math.sin(dLon/2) * Math.sin(dLon/2)
            ;
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
        const d = R * c;
        return d;
    }

    function deg2rad(deg) {
        return deg * (Math.PI/180);
    }
});
