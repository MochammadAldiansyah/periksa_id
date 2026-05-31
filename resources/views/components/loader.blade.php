{{-- Global Loading Screen --}}
<div id="global-loader" class="fixed inset-0 w-full h-full z-[9999] bg-white flex flex-col items-center justify-center transition-opacity duration-500 ease-out overflow-hidden">
    <div class="flex flex-col items-center justify-center">
        <h1 class="text-[clamp(1.75rem,5vw,3rem)] font-extrabold text-[#0046A0] tracking-tight m-0">
            Periksa<span class="text-[#3b82f6]">.id</span>
        </h1>
        <div class="mt-4 flex gap-1.5">
            <div class="w-2.5 h-2.5 bg-[#0046A0] rounded-full animate-loader-bounce"></div>
            <div class="w-2.5 h-2.5 bg-[#3b82f6] rounded-full animate-loader-bounce delay-150ms"></div>
            <div class="w-2.5 h-2.5 bg-[#0046A0] rounded-full animate-loader-bounce delay-300ms"></div>
        </div>
    </div>
</div>
