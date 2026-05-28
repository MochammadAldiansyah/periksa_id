document.addEventListener("DOMContentLoaded", function () {

    // KODE TOGGLE MOBILE MENU (LANDING PAGE)
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

    // KODE ACTIVE STATES NAVIGATION (DESKTOP & MOBILE)
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

    // KODE TOGGLE VISIBILITY PASSWORD (REGISTER, LOGIN, & PROFILE)
    window.toggleVisibility = function (inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);

        if (!input || !icon) return; // Fail-safe jika ID salah ketik

        if (input.type === 'password') {
            input.type = 'text';
            icon.innerHTML = `
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                </svg>
            `;
        } else {
            input.type = 'password';
            icon.innerHTML = `
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
            `;
        }
    }

    // FIX: Sambungkan fungsi panggilah halaman login biar gak error
    window.togglePasswordVisibility = function () {
        // Halaman login lu pake ID input 'password' dan ID tombol mata 'eye-icon'
        window.toggleVisibility('password', 'eye-icon');
    }

    // 4. KODE TOGGLE SIDEBAR (DASHBOARD)
    const sidebar = document.getElementById("mainSidebar");
    const overlay = document.getElementById("sidebarOverlay");
    const btnOpen = document.getElementById("btnOpenSidebar");
    const btnClose = document.getElementById("btnCloseSidebar");

    function openSidebar() {
        if (sidebar && overlay) {
            sidebar.classList.remove("-translate-x-full");
            sidebar.classList.add("translate-x-0");
            overlay.classList.remove("hidden");
            setTimeout(() => {
                overlay.classList.remove("opacity-0");
                overlay.classList.add("opacity-100");
            }, 10);
        }
    }

    function closeSidebar() {
        if (sidebar && overlay) {
            sidebar.classList.remove("translate-x-0");
            sidebar.classList.add("-translate-x-full");
            overlay.classList.remove("opacity-100");
            overlay.classList.add("opacity-0");
            setTimeout(() => {
                overlay.classList.add("hidden");
            }, 300);
        }
    }

    if (btnOpen) btnOpen.addEventListener("click", openSidebar);
    if (btnClose) btnClose.addEventListener("click", closeSidebar);
    if (overlay) overlay.addEventListener("click", closeSidebar);

});

//KODE MODAL DELETE USER (HALAMAN MANAJEMEN USER ADMIN)
let currentActiveFormId = null;

function openDeleteModal(userId, userName) {
    currentActiveFormId = 'delete-form-' + userId;
    const modalName = document.getElementById('modalUserName');
    if(modalName) modalName.innerText = userName;

    const modal = document.getElementById('deleteModal');
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    if (modal) {
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }
    currentActiveFormId = null;
}

// Cek apakah tombol confirm ada di halaman aktif, baru pasang listener
const confirmBtn = document.getElementById('confirmDeleteBtn');
if (confirmBtn) {
    confirmBtn.addEventListener('click', function() {
        if (currentActiveFormId) {
            const targetForm = document.getElementById(currentActiveFormId);
            if (targetForm) targetForm.submit();
        }
    });
}

document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeDeleteModal();
    }
});
