<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Thread;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        $query = Thread::query()->with('user'); // Mengambil data user untuk menampilkan nama author

        // Search
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter Category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Sorting
        if ($request->filled('sort')) {
            $sort = $request->sort;
            if ($sort == 'latest') $query->latest();
           if ($sort == 'popular') $query->orderBy('views_count', 'desc');
        }

        $threads = $query->paginate(10);

        return view('dashboard.role.admin.forum.index', compact('threads'));
    }

    public function destroy(Thread $thread)
    {
        $thread->delete();
        return back()->with('success', 'Thread berhasil dihapus.');
    }

    public function togglePin(Thread $thread)
    {
        $thread->update(['is_pinned' => !$thread->is_pinned]);
        return back();
    }
    // Tambahkan di dalam ForumController.php
public function create()
{
    return view('dashboard.role.admin.forum.create');
}

public function store(Request $request)
{
    $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
        'category' => 'required',
    ]);

    Thread::create([
        'title' => $request->title,
        'content' => $request->content,
        'category' => $request->category,
        'user_id' => auth()->id(), // Admin sebagai pembuat
        'status' => 'active',
    ]);

    return redirect()->route('admin.forum.index')->with('success', 'Thread berhasil ditambahkan!');
}
}
