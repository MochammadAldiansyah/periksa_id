@extends('dashboard.layouts.app')

@section('content')
<div class="flex-1 p-4 md:p-8 overflow-y-auto">
    <div class="max-w-4xl mx-auto h-[calc(100vh-7rem)] md:h-[80vh] flex flex-col bg-white rounded-2xl md:rounded-3xl border border-slate-100 shadow-sm overflow-hidden relative">
        
        {{-- Header --}}
        <div class="px-4 md:px-6 py-3 md:py-4 border-b border-slate-100 bg-white/80 backdrop-blur-md flex items-center gap-3 md:gap-4 sticky top-0 z-10 shrink-0">
            <a href="{{ url()->previous() }}" class="text-gray-400 hover:text-[#0046A0] transition-colors shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </a>
            <div class="w-9 h-9 md:w-10 md:h-10 shrink-0 rounded-full bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 font-bold overflow-hidden">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
            <div>
                <h2 class="font-bold text-gray-900 text-sm md:text-base leading-tight">Asisten Kesehatan AI</h2>
                <p class="text-[10px] md:text-xs text-gray-500">Cek Gejala Otomatis</p>
            </div>
        </div>

        {{-- Chat Area --}}
        <div id="chat-container" class="flex-grow p-6 overflow-y-auto bg-slate-50/50 space-y-4">
            <div class="text-center pb-4">
                <span class="bg-gray-100 text-gray-500 text-xs px-3 py-1 rounded-full font-medium">Chat Dimulai</span>
            </div>
            
            <div id="messages-list" class="space-y-4 flex flex-col">
                {{-- Welcome Message --}}
                <div class="flex flex-col max-w-[75%] self-start items-start">
                    <div class="px-4 py-2.5 rounded-2xl shadow-sm bg-white border border-slate-100 text-gray-800 rounded-bl-none">
                        <p class="text-sm leading-relaxed">Halo! Saya adalah Asisten Kesehatan AI. Silakan tuliskan keluhan atau gejala penyakit yang Anda rasakan, dan saya akan mencoba membantu memberikan panduan awal.</p>
                    </div>
                </div>
            </div>
            
            <div id="typing-indicator" class="hidden flex-col max-w-[75%] self-start items-start">
                <div class="px-4 py-3 rounded-2xl shadow-sm bg-white border border-slate-100 text-gray-500 rounded-bl-none flex gap-1">
                    <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce [animation-delay:0ms]"></span>
                    <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce [animation-delay:150ms]"></span>
                    <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce [animation-delay:300ms]"></span>
                </div>
            </div>
        </div>

        {{-- Input Area --}}
        <div class="p-4 bg-white border-t border-slate-100">
            <form id="chat-form" class="flex items-end gap-3">
                <div class="flex-grow relative">
                    <textarea id="chat-input" rows="1" placeholder="Ceritakan keluhan Anda..." required class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-3 pl-4 pr-4 text-sm focus:ring-indigo-500 focus:border-indigo-500 resize-none scrollbar-hide max-h-32 min-h-[44px] h-[44px] overflow-y-hidden" oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                </div>
                <button type="submit" id="btn-send" class="w-11 h-11 shrink-0 bg-indigo-600 hover:bg-indigo-800 text-white rounded-full flex items-center justify-center transition-transform hover:scale-105 shadow-sm disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg class="w-5 h-5 -ml-1 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatForm = document.getElementById('chat-form');
    const chatInput = document.getElementById('chat-input');
    const btnSend = document.getElementById('btn-send');
    const messagesList = document.getElementById('messages-list');
    const chatContainer = document.getElementById('chat-container');
    const typingIndicator = document.getElementById('typing-indicator');

    function scrollToBottom() {
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }

    function appendMessage(text, isMe) {
        const msgDiv = document.createElement('div');
        msgDiv.className = `flex flex-col max-w-[75%] ${isMe ? 'self-end items-end' : 'self-start items-start'}`;
        
        msgDiv.innerHTML = `
            <div class="px-4 py-2.5 rounded-2xl shadow-sm ${isMe ? 'bg-indigo-600 text-white rounded-br-none' : 'bg-white border border-slate-100 text-gray-800 rounded-bl-none'}">
                <p class="text-sm whitespace-pre-wrap break-words leading-relaxed">${text.replace(/</g, "&lt;").replace(/>/g, "&gt;")}</p>
            </div>
        `;
        messagesList.appendChild(msgDiv);
        scrollToBottom();
    }

    chatForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const text = chatInput.value.trim();
        if (!text) return;

        // Add user message
        appendMessage(text, true);
        
        chatInput.value = '';
        chatInput.style.height = '44px';
        btnSend.disabled = true;
        
        // Show typing indicator
        typingIndicator.classList.remove('hidden');
        typingIndicator.classList.add('flex');
        scrollToBottom();

        fetch(`{{ route('pasien.ai.chat') }}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ message: text })
        })
        .then(res => res.json())
        .then(data => {
            typingIndicator.classList.add('hidden');
            typingIndicator.classList.remove('flex');
            btnSend.disabled = false;
            
            if (data.reply) {
                appendMessage(data.reply, false);
            }
        })
        .catch(err => {
            console.error(err);
            typingIndicator.classList.add('hidden');
            typingIndicator.classList.remove('flex');
            btnSend.disabled = false;
        });
    });

    chatInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            chatForm.dispatchEvent(new Event('submit'));
        }
    });
});
</script>
@endsection
