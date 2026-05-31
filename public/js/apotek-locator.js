document.addEventListener("DOMContentLoaded", function() {
    // Automatically try to get location if we don't have it yet, 
    // but browsers will block this without user gesture sometimes. 
    // So we wait for the user to click the button or we can try silently.
    
    // We'll leave the map grayed out until requested.
});

let apotekMap = null;
let userMarker = null;
let apotekMarkers = [];

// Calculate distance using Haversine formula
function calculateDistance(lat1, lon1, lat2, lon2) {
    const R = 6371; // Radius of the earth in km
    const dLat = (lat2 - lat1) * Math.PI / 180;
    const dLon = (lon2 - lon1) * Math.PI / 180;
    const a = 
        Math.sin(dLat/2) * Math.sin(dLat/2) +
        Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) * 
        Math.sin(dLon/2) * Math.sin(dLon/2); 
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
    const d = R * c; // Distance in km
    return d.toFixed(1);
}

window.requestGeolocation = function() {
    const statusText = document.getElementById('map-status-text');
    const btnRequest = document.getElementById('btn-request-location');
    
    statusText.innerText = "Meminta izin lokasi...";
    btnRequest.classList.add('hidden');

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const lat = position.coords.latitude;
                const lon = position.coords.longitude;
                
                // Initialize or update map
                initMap(lat, lon);
                
                // Reverse geocode to get address string (optional, using Nominatim)
                fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`)
                    .then(response => response.json())
                    .then(data => {
                        const addr = data.display_name || `${lat.toFixed(4)}, ${lon.toFixed(4)}`;
                        document.getElementById('user-address-text').innerText = addr;
                    })
                    .catch(() => {
                        document.getElementById('user-address-text').innerText = "Lokasi Anda berhasil ditemukan";
                    });

                // Fetch nearby pharmacies
                fetchNearbyPharmacies(lat, lon);
            },
            (error) => {
                console.error(error);
                statusText.innerText = "Akses lokasi ditolak atau gagal.";
                btnRequest.classList.remove('hidden');
                btnRequest.innerText = "Coba Lagi";
                document.getElementById('user-address-text').innerText = "Gagal mendapatkan lokasi.";
            }
        );
    } else {
        statusText.innerText = "Geolocation tidak didukung browser ini.";
    }
}

function initMap(lat, lon) {
    const mapContainer = document.getElementById('apotek-map');
    // Clear waiting text
    mapContainer.innerHTML = '';
    
    if (!apotekMap) {
        apotekMap = L.map('apotek-map').setView([lat, lon], 14);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(apotekMap);
    } else {
        apotekMap.setView([lat, lon], 14);
    }

    if (userMarker) {
        apotekMap.removeLayer(userMarker);
    }
    
    // User marker (Blue circle)
    userMarker = L.circleMarker([lat, lon], {
        radius: 8,
        fillColor: "#0046A0",
        color: "#fff",
        weight: 2,
        opacity: 1,
        fillOpacity: 0.8
    }).addTo(apotekMap).bindPopup("<b>Lokasi Anda</b>").openPopup();
}

function fetchNearbyPharmacies(lat, lon) {
    const radius = 5000; // 5 km radius
    // Overpass API Query
    const query = `
        [out:json];
        (
          node["amenity"="pharmacy"](around:${radius},${lat},${lon});
        );
        out body;
    `;
    
    const listContainer = document.getElementById('apotek-list-container');
    listContainer.innerHTML = `
        <div class="text-center py-4 text-sm text-gray-500 flex flex-col items-center">
            <svg class="animate-spin h-6 w-6 text-[#0046A0] mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
            Mencari apotek di sekitar...
        </div>
    `;

    fetch("https://overpass-api.de/api/interpreter", {
        method: "POST",
        body: query
    })
    .then(res => res.json())
    .then(data => {
        // Clear old markers
        apotekMarkers.forEach(marker => apotekMap.removeLayer(marker));
        apotekMarkers = [];
        listContainer.innerHTML = '';

        if (!data.elements || data.elements.length === 0) {
            listContainer.innerHTML = `<div class="text-sm text-gray-500 p-4 text-center border border-dashed border-gray-200 rounded-xl">Tidak ada apotek ditemukan dalam radius 5km.</div>`;
            return;
        }

        // Process elements and sort by distance
        let pharmacies = data.elements.map(el => {
            const dist = calculateDistance(lat, lon, el.lat, el.lon);
            return {
                id: el.id,
                name: el.tags.name || "Apotek (Tanpa Nama)",
                lat: el.lat,
                lon: el.lon,
                dist: parseFloat(dist)
            };
        }).sort((a, b) => a.dist - b.dist).slice(0, 5); // Limit to top 5 closest

        // Add to map and list
        pharmacies.forEach(pharmacy => {
            // Add marker
            const marker = L.marker([pharmacy.lat, pharmacy.lon]).addTo(apotekMap)
                .bindPopup(`<b>${pharmacy.name}</b><br>${pharmacy.dist} km`);
            apotekMarkers.push(marker);

            // Add to list
            // Simulating rating and status for UI purposes
            const rating = (4.0 + Math.random()).toFixed(1);
            const is24h = Math.random() > 0.5;
            
            const card = document.createElement('div');
            card.className = "bg-white rounded-2xl border border-slate-100 p-4 shadow-sm hover:border-[#0046A0] transition-colors cursor-pointer group";
            card.onclick = () => {
                apotekMap.setView([pharmacy.lat, pharmacy.lon], 16);
                marker.openPopup();
            };
            
            card.innerHTML = `
                <div class="flex gap-4">
                    <div class="w-12 h-12 bg-blue-50 text-[#0046A0] rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-[#0046A0] group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-sm mb-1">${pharmacy.name}</h4>
                        <div class="flex items-center gap-2 text-xs text-gray-500 mb-2">
                            <span class="flex items-center gap-0.5"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg> ${pharmacy.dist} km</span>
                            &bull;
                            <span class="flex items-center gap-0.5 text-yellow-500"><svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg> ${rating}</span>
                        </div>
                        ${is24h ? '<span class="inline-block px-2 py-0.5 bg-blue-50 text-[#0046A0] text-[10px] font-bold rounded">Buka 24 Jam</span>' : '<span class="inline-block px-2 py-0.5 bg-purple-50 text-purple-600 text-[10px] font-bold rounded">Bisa klaim resep</span>'}
                    </div>
                </div>
            `;
            listContainer.appendChild(card);
        });
        
        // Fit map bounds to show all markers
        const group = new L.featureGroup([userMarker, ...apotekMarkers]);
        apotekMap.fitBounds(group.getBounds().pad(0.1));
    })
    .catch(error => {
        console.error(error);
        listContainer.innerHTML = `<div class="text-sm text-red-500 p-4 text-center border border-red-200 rounded-xl bg-red-50">Gagal mengambil data apotek.</div>`;
    });
}

// Request location on load automatically if possible, otherwise user can click the button
setTimeout(() => {
    requestGeolocation();
}, 500);
