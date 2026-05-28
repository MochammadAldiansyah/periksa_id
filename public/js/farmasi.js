let currentPrice = 0;
let pickerMap = null;
let pickerMarker = null;

function initPickerMap() {
    if (pickerMap) {
        setTimeout(() => pickerMap.invalidateSize(), 200);
        return;
    }

    // Default to Jakarta
    const defaultLat = -6.200000;
    const defaultLng = 106.816666;

    pickerMap = L.map('picker-map').setView([defaultLat, defaultLng], 13);
    L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; Carto'
    }).addTo(pickerMap);

    pickerMarker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(pickerMap);
    updateLocationData(defaultLat, defaultLng);

    // On Map Click
    pickerMap.on('click', function(e) {
        pickerMarker.setLatLng(e.latlng);
        updateLocationData(e.latlng.lat, e.latlng.lng);
    });

    // On Marker Drag End
    pickerMarker.on('dragend', function(e) {
        const position = pickerMarker.getLatLng();
        updateLocationData(position.lat, position.lng);
    });
}

function updateLocationData(lat, lng) {
    document.getElementById('modalLat').value = lat;
    document.getElementById('modalLng').value = lng;
    
    // Reverse Geocoding
    document.getElementById('modalAddress').value = "Mencari alamat...";
    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
        .then(res => res.json())
        .then(data => {
            if (data && data.display_name) {
                document.getElementById('modalAddress').value = data.display_name;
            } else {
                document.getElementById('modalAddress').value = "Alamat tidak ditemukan (Gunakan koordinat ini)";
            }
        })
        .catch(err => {
            console.error(err);
            document.getElementById('modalAddress').value = "Gagal mengambil nama jalan, titik lokasi tersimpan.";
        });
}

function openBuyModal(id, name, price, stock) {
    if (stock <= 0) {
        document.getElementById('warningMedName').innerText = name;
        document.getElementById('outOfStockModal').classList.remove('hidden');
        document.getElementById('outOfStockModal').classList.add('flex');
        return;
    }

    document.getElementById('modalMedId').value = id;
    document.getElementById('modalMedName').innerText = name;
    document.getElementById('modalQuantity').value = 1;
    document.getElementById('modalQuantity').max = stock;
    currentPrice = price;
    updateTotal();
    
    document.getElementById('buyModal').classList.remove('hidden');
    document.getElementById('buyModal').classList.add('flex');

    // Init Map when modal is visible
    setTimeout(() => {
        initPickerMap();
    }, 300);
}

function closeOutOfStockModal() {
    document.getElementById('outOfStockModal').classList.add('hidden');
    document.getElementById('outOfStockModal').classList.remove('flex');
}

function closeBuyModal() {
    document.getElementById('buyModal').classList.add('hidden');
    document.getElementById('buyModal').classList.remove('flex');
}

function updateTotal() {
    let qty = document.getElementById('modalQuantity').value || 1;
    let total = qty * currentPrice;
    document.getElementById('modalTotalLabel').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
}
