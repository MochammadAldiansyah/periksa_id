document.addEventListener("DOMContentLoaded", function () {

    // 1. KODE TOGGLE MOBILE MENU (LANDING PAGE)
    const menuBtn = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');
    const hamburgerIcon = document.getElementById('hamburger-icon');
    const closeIcon = document.getElementById('close-icon');

    function toggleMobileMenu() {
        if (menu && hamburgerIcon && closeIcon) {
            menu.classList.toggle('hidden');
            hamburgerIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        }
    }

    if (menuBtn) {
        menuBtn.addEventListener('click', toggleMobileMenu);
    }

    // 2. KODE ACTIVE STATES NAVIGATION
    window.setActive = function (element, view) {
        if (view === 'desktop') {
            document.querySelectorAll('.nav-item-desktop').forEach(item => {
                item.classList.remove('text-[#0046A0]', 'font-semibold', 'border-[#0046A0]');
                item.classList.add('text-gray-500', 'border-transparent');
            });
            element.classList.remove('text-gray-500', 'border-transparent');
            element.classList.add('text-[#0046A0]', 'font-semibold', 'border-[#0046A0]');
        } else {
            document.querySelectorAll('.nav-item-mobile').forEach(item => {
                item.classList.remove('text-[#0046A0]', 'font-semibold', 'bg-blue-50');
                item.classList.add('text-gray-600');
            });
            element.classList.remove('text-gray-600');
            element.classList.add('text-[#0046A0]', 'font-semibold', 'bg-blue-50');
            toggleMobileMenu();
        }
    }

    // 3. KODE TOGGLE VISIBILITY PASSWORD
    window.toggleVisibility = function (inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if (!input || !icon) return;

        if (input.type === 'password') {
            input.type = 'text';
            icon.innerHTML = `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" /></svg>`;
        } else {
            input.type = 'password';
            icon.innerHTML = `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>`;
        }
    }

    window.togglePasswordVisibility = function () {
        window.toggleVisibility('password', 'eye-icon');
    }

    // 4. KODE TOGGLE SIDEBAR
    const sidebar = document.getElementById("mainSidebar");
    const overlay = document.getElementById("sidebarOverlay");
    const btnOpen = document.getElementById("btnOpenSidebar");
    const btnClose = document.getElementById("btnCloseSidebar");

    function openSidebar() {
        if (sidebar && overlay) {
            sidebar.classList.remove("-translate-x-full");
            sidebar.classList.add("translate-x-0");
            overlay.classList.remove("hidden");
            setTimeout(() => { overlay.classList.remove("opacity-0"); overlay.classList.add("opacity-100"); }, 10);
        }
    }

    function closeSidebar() {
        if (sidebar && overlay) {
            sidebar.classList.remove("translate-x-0");
            sidebar.classList.add("-translate-x-full");
            overlay.classList.remove("opacity-100");
            overlay.classList.add("opacity-0");
            setTimeout(() => { overlay.classList.add("hidden"); }, 300);
        }
    }

    if (btnOpen) btnOpen.addEventListener("click", openSidebar);
    if (btnClose) btnClose.addEventListener("click", closeSidebar);
    if (overlay) overlay.addEventListener("click", closeSidebar);

    // 5. KODE MODAL DELETE USER
    const confirmBtn = document.getElementById('confirmDeleteBtn');
    if (confirmBtn) {
        confirmBtn.addEventListener('click', function() {
            if (window.currentActiveFormId) {
                const targetForm = document.getElementById(window.currentActiveFormId);
                if (targetForm) targetForm.submit();
            }
        });
    }
});

// MODAL LOGIC (Global scope)
window.currentActiveFormId = null;

function openDeleteModal(userId, userName) {
    window.currentActiveFormId = 'delete-form-' + userId;
    const modalName = document.getElementById('modalUserName');
    if(modalName) modalName.innerText = userName;
    const modal = document.getElementById('deleteModal');
    if (modal) { modal.classList.remove('hidden'); modal.classList.add('flex'); }
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    if (modal) { modal.classList.remove('flex'); modal.classList.add('hidden'); }
    window.currentActiveFormId = null;
}

// MODAL ALAMAT
function openAddressModal() {
    const modal = document.getElementById('addressModal');
    const box = document.getElementById('modalBox');
    modal.classList.remove('hidden');
    setTimeout(() => { box.classList.remove('scale-95', 'opacity-0'); box.classList.add('scale-100', 'opacity-100'); }, 20);
}

function closeAddressModal() {
    const modal = document.getElementById('addressModal');
    const box = document.getElementById('modalBox');
    box.classList.remove('scale-100', 'opacity-100');
    box.classList.add('scale-95', 'opacity-0');
    setTimeout(() => { modal.classList.add('hidden'); }, 200);
}

// MODAL THREAD
function openThreadModal(title, content, author, date, status) {
    document.getElementById('mTitle').innerText = title;
    document.getElementById('mContent').innerText = content;
    document.getElementById('mAuthor').innerText = author;
    document.getElementById('mDate').innerText = date;
    const statusEl = document.getElementById('mStatus');
    statusEl.innerText = status;
    statusEl.className = status.toLowerCase() === 'active' 
        ? 'bg-emerald-50 text-emerald-700 px-2 py-1 rounded text-[10px] font-bold uppercase' 
        : 'bg-red-50 text-red-700 px-2 py-1 rounded text-[10px] font-bold uppercase';
    document.getElementById('threadModal').classList.remove('hidden');
}

function closeModal() { document.getElementById('threadModal').classList.add('hidden'); }

// MODAL DOKTER (CARI DOKTER)
window.bukaModalDetail = function(id, nama, spesialis) {
    document.getElementById('modal-dokter-id').value = id;
    document.getElementById('modal-nama').innerText = nama;
    document.getElementById('modal-spesialis').innerText = spesialis;
    const container = document.getElementById('modal-container');
    container.classList.remove('hidden');
    container.classList.add('flex');
};

window.tutupModalDetail = function() {
    const container = document.getElementById('modal-container');
    container.classList.add('hidden');
    container.classList.remove('flex');
};

// Cek Login
window.cekDetail = function(id, nama, spesialis, isLogin) {
    if (isLogin) {
        window.bukaModalDetail(id, nama, spesialis);
    } else {
        document.getElementById('login-warning-modal').classList.remove('hidden');
        document.getElementById('login-warning-modal').classList.add('flex');
    }
};

// Tutup Peringatan
window.closeWarningModal = function() {
    document.getElementById('login-warning-modal').classList.add('hidden');
    document.getElementById('login-warning-modal').classList.remove('flex');
};