{{-- Global Loading Screen --}}
<div id="global-loader" class="fixed inset-0 z-[9999] bg-white flex flex-col items-center justify-center transition-opacity duration-500">
    <div class="relative flex flex-col items-center justify-center">
        {{-- Logo Text --}}
        <h1 class="relative z-10 text-4xl md:text-5xl font-extrabold text-[#0046A0] tracking-tight">
            Periksa<span class="text-blue-500">.id</span>
        </h1>
        <div class="mt-4 flex gap-1.5 z-10">
            <div class="w-2.5 h-2.5 bg-[#0046A0] rounded-full animate-bounce" style="animation-delay: 0s;"></div>
            <div class="w-2.5 h-2.5 bg-blue-500 rounded-full animate-bounce" style="animation-delay: 0.15s;"></div>
            <div class="w-2.5 h-2.5 bg-[#0046A0] rounded-full animate-bounce" style="animation-delay: 0.3s;"></div>
        </div>
    </div>
</div>
<script>
    // Hide immediately before page finishes loading if already shown
    if (sessionStorage.getItem('loaderShown')) {
        document.getElementById('global-loader').style.display = 'none';
    }
</script>
