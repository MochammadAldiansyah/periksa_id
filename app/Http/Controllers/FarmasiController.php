<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FarmasiController extends Controller
{
    // === Admin Methods ===
    public function adminIndex()
    {
        $medicines = Medicine::latest()->paginate(10);
        return view('dashboard.role.admin.farmasi.index', compact('medicines'));
    }

    public function create()
    {
        return view('dashboard.role.admin.farmasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('medicines', 'public');
            $validated['image'] = $path;
        }

        Medicine::create($validated);

        return redirect()->route('admin.farmasi.index')->with('success', 'Obat berhasil ditambahkan!');
    }

    public function edit(Medicine $medicine)
    {
        return view('dashboard.role.admin.farmasi.edit', compact('medicine'));
    }

    public function update(Request $request, Medicine $medicine)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($medicine->image) {
                Storage::disk('public')->delete($medicine->image);
            }
            $path = $request->file('image')->store('medicines', 'public');
            $validated['image'] = $path;
        }

        $medicine->update($validated);

        return redirect()->route('admin.farmasi.index')->with('success', 'Obat berhasil diperbarui!');
    }

    public function destroy(Medicine $medicine)
    {
        if ($medicine->image) {
            Storage::disk('public')->delete($medicine->image);
        }
        $medicine->delete();
        return redirect()->route('admin.farmasi.index')->with('success', 'Obat berhasil dihapus!');
    }

    // === Pasien & Dokter Catalog Method ===
    public function index()
    {
        $medicines = Medicine::latest()->get();
        return view('dashboard.farmasi.index', compact('medicines'));
    }
}
