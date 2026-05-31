{{-- Global Loading Screen --}}
<div id="global-loader" style="position:fixed;top:0;left:0;width:100%;height:100%;z-index:9999;background:#fff;display:flex;flex-direction:column;align-items:center;justify-content:center;transition:opacity 0.5s ease;overflow:hidden;">
    <div style="display:flex;flex-direction:column;align-items:center;justify-content:center;">
        <h1 style="font-size:clamp(1.75rem, 5vw, 3rem);font-weight:800;color:#0046A0;letter-spacing:-0.025em;margin:0;">
            Periksa<span style="color:#3b82f6;">.id</span>
        </h1>
        <div style="margin-top:1rem;display:flex;gap:0.375rem;">
            <div style="width:0.625rem;height:0.625rem;background:#0046A0;border-radius:9999px;animation:bounce 1s infinite;" class="animate-bounce"></div>
            <div style="width:0.625rem;height:0.625rem;background:#3b82f6;border-radius:9999px;animation:bounce 1s infinite;animation-delay:0.15s;" class="animate-bounce"></div>
            <div style="width:0.625rem;height:0.625rem;background:#0046A0;border-radius:9999px;animation:bounce 1s infinite;animation-delay:0.3s;" class="animate-bounce"></div>
        </div>
    </div>
</div>
<style>
    @keyframes bounce{0%,100%{transform:translateY(0)}50%{transform:translateY(-6px)}}
    body.loading{overflow:hidden!important;height:100vh!important}
</style>
