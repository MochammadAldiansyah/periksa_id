<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $users = User::withoutRole('admin')->latest()->get();
        $totalUsers = User::withoutRole('admin')->count();

        return view('dashboard.role.admin.dashboard', compact('users', 'totalUsers'));
    }

    // Menampilkan Halaman Edit User
    public function edit(User $user)
    {
        return view('dashboard.role.admin.manajemen_user.edit-user', compact('user'));
    }

    // 2. Memproses Perubahan Data User
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max|255',
            'email' => 'required|string|email|max|255|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Data user berhasil diperbarui!');
    }

    // 3. Menghapus User dari Database
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'User berhasil dihapus!');
    }

  public function usersList(Request $request)
{
    //Ambil keyword dari input form filter & search
    $search = $request->input('search');
    $roleFilter = $request->input('role');
    $statusFilter = $request->input('status');

    // Query dasar Kunci mati agar admin tidak akan pernah ikut terbawa
    $query = User::withoutRole('admin')->with('roles');

    //  Logika Fitur Pencarian (Nama / Email)
    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('name', 'LIKE', "%{$search}%")
              ->orWhere('email', 'LIKE', "%{$search}%");
        });
    }

    //Logika Filter Berdasarkan Role
    if ($roleFilter) {
        if ($roleFilter === 'admin') {
            $query->whereRaw('1 = 0');
        } else {
            $query->role($roleFilter);
        }
    }

    //Logika Filter Berdasarkan Status
    if ($statusFilter) {
        $query->where('status', $statusFilter);
    }

    //Ambil data dengan Pagination
    $users = $query->latest()->paginate(10)->withQueryString();

    return view('dashboard.role.admin.manajemen_user.manajemen_user', compact('users'));
}
}
