// AOS (Animate On Scroll) Initialization
document.addEventListener('DOMContentLoaded', function () {
    if (typeof AOS !== 'undefined') {
        AOS.init({
            once: true,
            duration: 800,
            offset: 100,
        });
    }
});
