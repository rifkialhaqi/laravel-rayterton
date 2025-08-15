<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    // Tampilkan daftar PO
    public function index()
    {
        $purchaseOrders = PurchaseOrder::with('items')->get();
        return view('PO.index', compact('purchaseOrders'));
    }

    // Tampilkan form tambah PO
    public function create()
    {
        $products = Product::all();
        return view('PO.create', compact('products'));
    }

    // Simpan PO baru beserta item
    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|unique:purchase_orders',
            'date' => 'required|date',
            'supplier' => 'required|string',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        $po = PurchaseOrder::create([
            'number' => $request->number,
            'date' => $request->date,
            'supplier' => $request->supplier,
        ]);

        foreach ($request->items as $item) {
            PurchaseOrderItem::create([
                'purchase_order_id' => $po->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        return redirect()->route('PO.index')->with('success', 'Purchase Order berhasil disimpan.');
    }

    // Tampilkan detail PO
    public function show($id)
    {
        $po = PurchaseOrder::with('items.product')->findOrFail($id);
        return view('PO', compact('po'));
    }

    // Tampilkan form edit PO
    public function edit($id)
    {
        $po = PurchaseOrder::with('items')->findOrFail($id);
        $products = Product::all();
        return view('PO.edit', compact('po', 'products'));
    }

    // Update PO dan item
    public function update(Request $request, $id)
    {
        $po = PurchaseOrder::findOrFail($id);

        $request->validate([
            'number' => 'required|unique:purchase_orders,number,' . $po->id,
            'date' => 'required|date',
            'supplier' => 'required|string',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        $po->update([
            'number' => $request->number,
            'date' => $request->date,
            'supplier' => $request->supplier,
        ]);

        // Hapus semua item lama, lalu simpan ulang
        // $po->items()->delete();
        // foreach ($request->items as $item) {
        //     PurchaseOrderItem::create([
        //         'purchase_order_id' => $po->id,
        //         'product_id' => $item['product_id'],
        //         'quantity' => $item['quantity'],
        //         'price' => $item['price'],
        //     ]);
        // }

        return redirect()->route('PO.index')->with('success', 'Purchase Order berhasil diupdate.');
    }

    // Hapus PO
    public function destroy($id)
    {
        $po = PurchaseOrder::findOrFail($id);
        $po->delete();
        return redirect()->route('PO.index')->with('success', 'Purchase Order berhasil dihapus.');
    }
}