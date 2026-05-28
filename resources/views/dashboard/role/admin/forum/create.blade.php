@extends('dashboard.layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Create New Thread</h1>
    <form action="{{ route('forum.store') }}" method="POST" class="bg-white p-6 rounded-2xl border shadow-sm">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2">Title</label>
            <input type="text" name="title" class="w-full border rounded-xl p-2" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2">Category</label>
            <select name="category" class="w-full border rounded-xl p-2">
                <option value="announcement">Announcement</option>
                <option value="general">General Chat</option>
                <option value="help">Q & A / Help</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2">Content</label>
            <textarea name="content" rows="5" class="w-full border rounded-xl p-2" required></textarea>
        </div>
        <button type="submit" class="bg-[#0046A0] text-white px-6 py-2 rounded-xl">Post Thread</button>
    </form>
</div>
@endsection