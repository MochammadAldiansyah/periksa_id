@extends('dashboard.layouts.app')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    
    {{-- Title Page --}}
    <div class="mb-4">
        <h1 class="text-2xl font-bold text-gray-900">Forum Management</h1>
        <p class="text-sm text-gray-500">Manage all community threads, view details, and perform moderation.</p>
    </div>

    {{-- Alert Success Flash Message --}}
    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-sm flex items-center shadow-sm">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Filter, Search, and Table Wrapper --}}
    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">

        <form method="GET" action="{{ route('forum.index') }}"
            class="p-5 border-b border-slate-50 bg-slate-50/30 flex flex-col md:flex-row md:items-center justify-between gap-4">

            <div class="flex justify-end mb-4 md:mb-0">
                <a href="{{ route('forum.create') }}"
                    class="bg-[#0046A0] hover:bg-blue-800 text-white font-bold text-xs px-4 py-2.5 rounded-xl transition-all">
                    + New Thread
                </a>
            </div>
            
            <div class="relative w-full md:w-80">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search threads..."
                    class="w-full bg-white border border-slate-200 rounded-xl pl-10 pr-4 py-2.5 text-xs text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#0046A0] focus:ring-1 focus:ring-[#0046A0] transition-all">
            </div>

            <div class="flex items-center gap-3 self-end md:self-auto w-full md:w-auto">
                <select name="category" onchange="this.form.submit()"
                    class="bg-white border border-slate-200 rounded-xl px-3 py-2.5 text-xs text-gray-700 cursor-pointer w-full md:w-40">
                    <option value="">All Categories</option>
                    <option value="announcement" {{ request('category') == 'announcement' ? 'selected' : '' }}>Announcement</option>
                    <option value="general" {{ request('category') == 'general' ? 'selected' : '' }}>General Chat</option>
                    <option value="help" {{ request('category') == 'help' ? 'selected' : '' }}>Q & A / Help</option>
                </select>

                <select name="sort" onchange="this.form.submit()"
                    class="bg-white border border-slate-200 rounded-xl px-3 py-2.5 text-xs text-gray-700 cursor-pointer w-full md:w-36">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                    <option value="reported" {{ request('sort') == 'reported' ? 'selected' : '' }}>Reported First</option>
                </select>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/70 border-b border-slate-100 text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                        <th class="py-4 px-6">Thread Info</th>
                        <th class="py-4 px-4">Category</th>
                        <th class="py-4 px-4 text-center">Engagement</th>
                        <th class="py-4 px-4">Status</th>
                        <th class="py-4 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 text-xs">
                    @forelse($threads as $thread)
                        <tr class="hover:bg-slate-50/40 transition-all {{ $thread->reports_count > 0 ? 'bg-red-50/10' : '' }}">
                            <td class="py-4 px-6">
                                <div class="font-bold text-gray-900">{{ $thread->title }}</div>
                                <div class="text-gray-400">By {{ $thread->user->name ?? 'Anonymous' }} • {{ $thread->created_at->diffForHumans() }}</div>
                            </td>
                            <td class="py-4 px-4">{{ ucfirst($thread->category) }}</td>
                            <td class="py-4 px-4 text-center">{{ $thread->views_count ?? $thread->views ?? 0 }} views</td>
                            <td class="py-4 px-4">
                                <span class="px-2 py-1 rounded text-[10px] uppercase {{ $thread->status == 'active' ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700' }}">
                                    {{ $thread->status }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right flex items-center justify-end gap-3 mt-2">
                                <button type="button"
                                    onclick="openThreadModal('{{ addslashes($thread->title) }}', '{{ addslashes($thread->content) }}', '{{ $thread->user->name ?? 'Anonymous' }}', '{{ $thread->created_at->format('d M Y, H:i') }}', '{{ ucfirst($thread->status) }}')"
                                    class="text-[#0046A0] font-bold hover:underline">
                                    View
                                </button>

                                @hasrole('admin')
                                {{-- Form Delete ditaruh langsung di sini agar mengunci Route Laravel dengan aman --}}
                                <form action="{{ route('admin.forum.destroy', $thread->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus thread ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 font-bold hover:underline">
                                        Delete
                                    </button>
                                </form>
                                @endhasrole
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 text-center text-gray-400">No threads found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-5 border-t border-slate-50">
            {{ $threads->links() }}
        </div>
    </div>
</div>

{{-- MODAL COMPONENT (Murni Menampilkan Detail Data) --}}
<div id="threadModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/60 p-4">
    <div class="bg-white rounded-2xl w-full max-w-lg p-6 shadow-2xl animate-in fade-in zoom-in duration-200">
        <div class="flex justify-between items-start mb-4">
            <h2 id="mTitle" class="text-xl font-bold text-gray-900 leading-tight"></h2>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 text-2xl leading-none">&times;</button>
        </div>
        
        <div class="space-y-4 text-sm text-gray-600">
            <p id="mContent" class="leading-relaxed bg-slate-50 p-4 rounded-xl break-words whitespace-normal max-h-64 overflow-y-auto"></p>
            
            <div class="grid grid-cols-2 gap-4 border-t pt-4">
                <div>
                    <span class="block text-[10px] uppercase font-bold text-gray-400">Author</span>
                    <span id="mAuthor" class="font-medium text-gray-900"></span>
                </div>
                <div>
                    <span class="block text-[10px] uppercase font-bold text-gray-400">Created At</span>
                    <span id="mDate" class="font-medium text-gray-900"></span>
                </div>
            </div>

            <div class="pt-2">
                <span class="block text-[10px] uppercase font-bold text-gray-400 mb-1">Status</span>
                <span id="mStatus" class="inline-block px-2 py-1 rounded text-[10px] font-bold"></span>
            </div>
        </div>
    </div>
</div>


@endsection