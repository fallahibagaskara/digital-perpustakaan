<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Kategoribuku;


class KategoriBukuController extends Controller
{
    /**
     * Display the kategori buku's table.
     */
    public function index(Request $request): View
    {
        $categories = Kategoribuku::paginate(5);
        return view('kategoribuku.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new kategori.
     */
    public function add(): View
    {
        return view('kategoribuku.partials.add-kategori-form');
    }

        /**
     * Store the buku to kategori buku's table.
     */
    public function store(Request $request)
    {

        $request->validate([
            'kategori' => 'required|string',
        ]);
        
        $dataKategori = [
            'kategori' => $request->kategori,
        ];

        if (Kategoribuku::create($dataKategori)) {
            return redirect()->route('kategoribuku')->with('status', 'Kategori buku berhasil disimpan.');
        }

        return redirect()->route('kategoribuku.partials.add-kategori-form')->with('status', 'TKategori buku gagal disimpan.');
    }
 
    /**
     * Request edit buku from the data buku's table.
     */
    public function edit(Request $request): View
    {
        $id = $request->id;
        $category = Kategoribuku::find($id);
        return view('kategoribuku.partials.edit-kategori-form', compact('category'));
    }

    /**
     * Update the data buku's edit form.
     */
    public function update(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string',
        ]);

        $kategoriBuku = Kategoribuku::findOrFail($request->id);

        $kategoriBuku->kategori = $request->kategori;
        if($kategoriBuku->save()){
            return redirect()->route('kategoribuku')->with('status', 'Kategori buku berhasil diperbarui.');
        }

        return redirect()->route('kategoribuku')->with('status', 'Kategori buku gagal diperbarui.');
    }

    /**
     * Delete the buku from data buku's.
     */
    public function delete(Request $request)
    {
        $id = $request->id;
        $category = Kategoribuku::findOrFail($id);
        
        if($category->delete()){
            return redirect()->route('kategoribuku')->with('status', 'Kategori buku berhasil dihapus.');
        }

        return redirect()->route('kategoribuku')->with('status', 'Kategori buku gagal dihapus.');
    }
}
