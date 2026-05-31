@extends('dashboard.layouts.app')

@section('content')
<div class="max-w-4xl mx-auto h-[calc(100vh-7rem)] md:h-[80vh] flex flex-col bg-white rounded-2xl md:rounded-3xl border border-slate-100 shadow-sm overflow-hidden relative">
    
    {{-- Header --}}
    @php
        $isDokter = auth()->id() === $janjiTemu->dokter_id;
        $lawanBicara = $isDokter ? $janjiTemu->user : $janjiTemu->dokter;
    @endphp
    <div class="px-4 md:px-6 py-3 md:py-4 border-b border-slate-100 bg-white/80 backdrop-blur-md flex items-center justify-between sticky top-0 z-10 shrink-0">
        <div class="flex items-center gap-3 md:gap-4 overflow-hidden">
            <a href="{{ url()->previous() }}" class="text-gray-400 hover:text-[#0046A0] transition-colors shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </a>
            <div class="relative w-9 h-9 md:w-10 md:h-10 shrink-0 rounded-full bg-blue-50 border border-blue-100 flex items-center justify-center text-[#0046A0] font-bold overflow-hidden">
                @if($lawanBicara->avatar)
                    <img src="{{ asset('storage/' . $lawanBicara->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                @else
                    <span class="text-xs md:text-sm">{{ strtoupper(substr($lawanBicara->name, 0, 2)) }}</span>
                @endif
                <div class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-emerald-400 border-2 border-white rounded-full"></div>
            </div>
            <div class="min-w-0">
                <h2 class="font-bold text-gray-900 text-sm md:text-base leading-tight truncate">{{ $lawanBicara->name }}</h2>
                <p class="text-[10px] md:text-xs text-gray-500 truncate">{{ $isDokter ? 'Pasien' : 'Dokter' }} &bull; Aktif</p>
            </div>
        </div>
        <div class="hidden sm:block text-[10px] md:text-xs font-bold px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full border border-emerald-100 shrink-0 ml-2">
            {{ Carbon\Carbon::parse($janjiTemu->scheduled_date)->format('d M') }} | {{ Carbon\Carbon::parse($janjiTemu->scheduled_time)->format('H:i') }}
        </div>
    </div>

    {{-- Chat Area --}}
    <div id="chat-container" class="flex-grow p-6 overflow-y-auto bg-slate-50/50 space-y-4">
        <div class="text-center pb-4">
            <span class="bg-gray-100 text-gray-500 text-xs px-3 py-1 rounded-full font-medium">Konsultasi dimulai</span>
            @if($janjiTemu->keluhan)
                <div class="mt-4 max-w-md mx-auto bg-yellow-50 border border-yellow-100 text-yellow-800 text-sm p-3 rounded-xl shadow-sm text-left">
                    <strong class="block mb-1 text-yellow-900">Keluhan Awal:</strong>
                    {{ $janjiTemu->keluhan }}
                </div>
            @endif
        </div>
        
        <div id="messages-list" class="space-y-4 flex flex-col">
            <!-- Messages will be injected here via JS -->
            <div class="flex justify-center items-center h-20 text-gray-400 text-sm" id="loading-messages">
                <svg class="animate-spin h-5 w-5 mr-2 text-[#0046A0]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                Memuat pesan...
            </div>
        </div>
    </div>

    {{-- Input Area --}}
    <div class="p-4 bg-white border-t border-slate-100 flex items-center gap-2">
        @if($isDokter && isset($medicines) && $medicines->count() > 0)
        <button type="button" onclick="openMedicineModal()" class="w-11 h-11 shrink-0 bg-blue-50 text-[#0046A0] hover:bg-blue-100 rounded-full flex items-center justify-center transition-colors" title="Rekomendasikan Obat">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
        </button>
        @endif
        
        <form id="chat-form" class="flex items-end gap-3 flex-grow">
            <div class="flex-grow relative">
                <textarea id="chat-input" rows="1" placeholder="Ketik pesan konsultasi Anda di sini..." class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-3 pl-4 pr-12 text-sm focus:ring-[#0046A0] focus:border-[#0046A0] resize-none scrollbar-hide max-h-32 min-h-[44px]" style="height: 44px; overflow-y:hidden;" oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
            </div>
            <button type="submit" id="btn-send" class="w-11 h-11 shrink-0 bg-[#0046A0] hover:bg-blue-800 text-white rounded-full flex items-center justify-center transition-transform hover:scale-105 shadow-sm disabled:opacity-50 disabled:cursor-not-allowed">
                <svg class="w-5 h-5 -ml-1 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
            </button>
        </form>
    </div>
</div>

{{-- MODAL PILIH OBAT (Khusus Dokter) --}}
@if($isDokter && isset($medicines))
<div id="medicine-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/40 backdrop-blur-sm p-4">
    <div class="bg-white rounded-2xl max-w-lg w-full shadow-2xl flex flex-col max-h-[80vh]">
        <div class="p-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-gray-900">Rekomendasikan Obat</h3>
            <button onclick="closeMedicineModal()" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <div class="p-4 overflow-y-auto space-y-3">
            @foreach($medicines as $med)
            <div class="flex items-center justify-between p-3 border border-slate-100 rounded-xl hover:bg-slate-50 transition-colors">
                <div>
                    <h4 class="font-bold text-sm text-gray-900">{{ $med->name }}</h4>
                    <p class="text-xs text-gray-500">Rp {{ number_format($med->price, 0, ',', '.') }} &bull; Stok: {{ $med->stock }}</p>
                </div>
                <button onclick="sendMedicine({{ $med->id }}, '{{ addslashes($med->name) }}')" class="px-3 py-1.5 bg-[#0046A0] text-white text-xs font-bold rounded-lg hover:bg-blue-800" {{ $med->stock <= 0 ? 'disabled' : '' }}>
                    {{ $med->stock <= 0 ? 'Habis' : 'Kirim' }}
                </button>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

{{-- MODAL BELI OBAT (Khusus Pasien) --}}
@if(!$isDokter)
<div id="buy-medicine-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/40 backdrop-blur-sm p-4">
    <div class="bg-white rounded-2xl max-w-md w-full shadow-2xl flex flex-col max-h-[90vh]">
        <div class="p-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-gray-900">Konfirmasi Pembelian</h3>
            <button onclick="closeBuyModal()" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <div class="p-4 overflow-y-auto">
            <form action="{{ route('orders.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="medicine_id" id="buy-medicine-id">
                
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Nama Obat</label>
                    <input type="text" id="buy-medicine-name" readonly class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-sm font-semibold text-gray-900">
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Harga Satuan</label>
                        <input type="text" id="buy-medicine-price-display" readonly class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-sm text-gray-900">
                        <input type="hidden" id="buy-medicine-price">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Jumlah</label>
                        <input type="number" name="quantity" id="buy-quantity" min="1" value="1" required onchange="updateTotal()" class="w-full border border-slate-200 rounded-xl px-3 py-2 text-sm focus:ring-[#0046A0] focus:border-[#0046A0]">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Total Harga</label>
                    <input type="text" id="buy-total-display" readonly class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 font-bold text-[#0046A0]">
                </div>
                
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Alamat Pengiriman</label>
                    <textarea name="address" rows="2" required placeholder="Tuliskan alamat lengkap..." class="w-full border border-slate-200 rounded-xl px-3 py-2 text-sm focus:ring-[#0046A0] focus:border-[#0046A0] resize-none"></textarea>
                </div>
                
                {{-- Mock Coordinates for Demo --}}
                <input type="hidden" name="latitude" value="-6.200000">
                <input type="hidden" name="longitude" value="106.816666">
                
                <button type="submit" class="w-full bg-[#0046A0] text-white font-bold py-3 rounded-xl hover:bg-blue-800 transition-colors shadow-sm mt-4">
                    Pesan Sekarang (COD)
                </button>
            </form>
        </div>
    </div>
</div>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    const janjiTemuId = {{ $janjiTemu->id }};
    const currentUserId = {{ auth()->id() }};
    const messagesList = document.getElementById('messages-list');
    const chatContainer = document.getElementById('chat-container');
    const chatForm = document.getElementById('chat-form');
    const chatInput = document.getElementById('chat-input');
    const btnSend = document.getElementById('btn-send');
    const loadingEl = document.getElementById('loading-messages');
    
    let currentDataString = '';

    // Fetch Messages
    function fetchMessages() {
        fetch(`/konsultasi/${janjiTemuId}/fetch`)
            .then(res => res.json())
            .then(data => {
                if (loadingEl) loadingEl.style.display = 'none';
                
                const newString = JSON.stringify(data);
                if (newString !== currentDataString) {
                    renderMessages(data);
                    currentDataString = newString;
                    scrollToBottom();
                }
            })
            .catch(err => console.error("Error fetching messages:", err));
    }

    // Render Messages
    function renderMessages(messages) {
        messagesList.innerHTML = '';
        messages.forEach(msg => {
            const isMe = msg.sender_id === currentUserId;
            const time = new Date(msg.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            const editedTag = msg.is_edited ? '<span class="italic ml-1">(diedit)</span>' : '';
            
            const msgDiv = document.createElement('div');
            msgDiv.className = `flex flex-col max-w-[75%] group ${isMe ? 'self-end items-end' : 'self-start items-start'}`;
            
            let actionMenu = '';
            if (isMe) {
                actionMenu = `
                <div class="absolute top-1 -left-16 hidden group-hover:flex items-center gap-1 bg-white border border-slate-100 shadow-sm rounded-lg p-1 text-gray-400">
                    <button onclick="window.editMessage(${msg.id}, '${escapeHtml(msg.message).replace(/'/g, "\\'")}')" class="p-1 hover:text-[#0046A0] hover:bg-blue-50 rounded" title="Edit"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg></button>
                    <button onclick="window.deleteMessage(${msg.id})" class="p-1 hover:text-red-500 hover:bg-red-50 rounded" title="Hapus"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                </div>`;
            }

            let medicineContent = '';
            if (msg.medicine) {
                const med = msg.medicine;
                const buyBtn = !isMe ? `
                    <div class="mt-2 pt-2 border-t border-slate-200/50">
                        <button onclick="window.openBuyModal(${med.id}, '${escapeHtml(med.name)}', ${med.price})" class="w-full bg-[#0046A0] hover:bg-blue-800 text-white text-xs font-bold py-1.5 rounded-lg transition-colors">
                            Beli Obat Ini
                        </button>
                    </div>
                ` : '';
                
                medicineContent = `
                    <div class="mt-2 bg-white/90 backdrop-blur-sm rounded-xl p-3 border border-slate-100 shadow-sm text-gray-800 w-64">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center shrink-0 overflow-hidden">
                                ${med.image ? `<img src="/storage/${med.image}" class="w-full h-full object-cover">` : `<svg class="w-5 h-5 text-[#0046A0]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>`}
                            </div>
                            <div>
                                <h5 class="text-xs font-bold text-gray-900 leading-tight">${escapeHtml(med.name)}</h5>
                                <p class="text-[10px] text-gray-500 font-semibold mt-0.5">Rp ${new Intl.NumberFormat('id-ID').format(med.price)}</p>
                            </div>
                        </div>
                        ${buyBtn}
                    </div>
                `;
            }

            msgDiv.innerHTML = `
                <div class="relative px-4 py-2.5 rounded-2xl shadow-sm ${isMe ? 'bg-[#0046A0] text-white rounded-br-none' : 'bg-white border border-slate-100 text-gray-800 rounded-bl-none'}">
                    ${actionMenu}
                    <p class="text-sm whitespace-pre-wrap break-words leading-relaxed">${escapeHtml(msg.message)}</p>
                    ${medicineContent}
                </div>
                <div class="text-[10px] text-gray-400 mt-1 flex items-center gap-1 px-1">
                    ${time} ${editedTag}
                    ${isMe ? (msg.is_read ? '<span class="text-blue-500">✓✓</span>' : '<span>✓</span>') : ''}
                </div>
            `;
            messagesList.appendChild(msgDiv);
        });
    }

    // Send Message
    chatForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const text = chatInput.value.trim();
        if (!text) return;

        chatInput.value = '';
        chatInput.style.height = '44px';
        btnSend.disabled = true;

        fetch(`/konsultasi/${janjiTemuId}/send`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ message: text })
        })
        .then(res => res.json())
        .then(data => {
            btnSend.disabled = false;
            if (data.status === 'success') {
                fetchMessages(); // Refresh immediately
            }
        })
        .catch(err => {
            console.error(err);
            btnSend.disabled = false;
        });
    });

    // Handle Enter key (Shift+Enter for new line)
    chatInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            chatForm.dispatchEvent(new Event('submit'));
        }
    });

    function scrollToBottom() {
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }

    function escapeHtml(unsafe) {
        return unsafe
             .replace(/&/g, "&amp;")
             .replace(/</g, "&lt;")
             .replace(/>/g, "&gt;")
             .replace(/"/g, "&quot;")
             .replace(/'/g, "&#039;");
    }

    // Expose Edit and Delete functions to window scope
    window.editMessage = function(id, currentText) {
        const newText = prompt("Edit pesan Anda:", currentText);
        if (newText && newText.trim() !== '' && newText !== currentText) {
            fetch(`/konsultasi/message/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ message: newText })
            }).then(res => fetchMessages());
        }
    };

    window.deleteMessage = function(id) {
        if (confirm("Apakah Anda yakin ingin menghapus pesan ini?")) {
            fetch(`/konsultasi/message/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(res => fetchMessages());
        }
    };

    // Initial Fetch & Start Polling (every 3 seconds)
    fetchMessages();
    setInterval(fetchMessages, 3000);
});

// Global functions for medicine Modals
window.openMedicineModal = function() {
    const modal = document.getElementById('medicine-modal');
    if (modal) { modal.classList.remove('hidden'); modal.classList.add('flex'); }
};

window.closeMedicineModal = function() {
    const modal = document.getElementById('medicine-modal');
    if (modal) { modal.classList.add('hidden'); modal.classList.remove('flex'); }
};

window.sendMedicine = function(id, name) {
    const text = "Halo, berdasarkan hasil konsultasi kita, saya merekomendasikan obat ini untuk Anda.";
    
    fetch(`/konsultasi/{{ $janjiTemu->id }}/send`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ message: text, medicine_id: id })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            closeMedicineModal();
            // Fetch messages will be caught by the interval, or we could trigger it globally if we exposed it.
            // Since it's outside the DOMContentLoaded scope, let's just let polling catch it or reload.
            window.location.reload(); 
        }
    });
};

window.openBuyModal = function(id, name, price) {
    const modal = document.getElementById('buy-medicine-modal');
    if (modal) { 
        document.getElementById('buy-medicine-id').value = id;
        document.getElementById('buy-medicine-name').value = name;
        document.getElementById('buy-medicine-price').value = price;
        document.getElementById('buy-medicine-price-display').value = 'Rp ' + new Intl.NumberFormat('id-ID').format(price);
        document.getElementById('buy-quantity').value = 1;
        window.updateTotal();
        modal.classList.remove('hidden'); modal.classList.add('flex'); 
    }
};

window.closeBuyModal = function() {
    const modal = document.getElementById('buy-medicine-modal');
    if (modal) { modal.classList.add('hidden'); modal.classList.remove('flex'); }
};

window.updateTotal = function() {
    const price = parseInt(document.getElementById('buy-medicine-price').value) || 0;
    const qty = parseInt(document.getElementById('buy-quantity').value) || 1;
    const total = price * qty;
    document.getElementById('buy-total-display').value = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
};
</script>
@endsection
