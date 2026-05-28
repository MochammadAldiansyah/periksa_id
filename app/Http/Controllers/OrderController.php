<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'medicine_id' => 'required|exists:medicines,id',
            'quantity' => 'required|integer|min:1',
            'address' => 'required|string|max:1000',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $medicine = Medicine::findOrFail($request->medicine_id);
        
        if ($medicine->stock < $request->quantity) {
            return back()->with('error', 'Stok obat tidak mencukupi.');
        }

        // Create order
        Order::create([
            'user_id' => auth()->id(),
            'medicine_id' => $medicine->id,
            'quantity' => $request->quantity,
            'total_price' => $medicine->price * $request->quantity,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'payment_method' => 'COD',
            'status' => 'pending',
        ]);

        // Reduce stock
        $medicine->decrement('stock', $request->quantity);

        return redirect()->route('dashboard')->with('success', 'Pesanan berhasil dibuat!');
    }

    // Endpoint for JS long-polling
    public function checkStatus(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json([
            'status' => $order->status
        ]);
    }
}
