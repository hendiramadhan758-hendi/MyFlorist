<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_item' => 'required',
            'kategori' => 'required',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable'
        ]);

        Item::create($request->all());

        return redirect('/items/create')
            ->with('success', 'Item berhasil ditambahkan!');
    }
}