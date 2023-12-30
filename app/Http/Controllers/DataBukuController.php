<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Databuku;
use App\Models\Kategoribuku;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Excel;
use App\Exports\DatabukuExport;

class DataBukuController extends Controller
{
    /**
     * Display the data buku's table.
     */
    public function index(Request $request): View
    {
        $user = Auth::user();
        $categories = Kategoribuku::all();
    
        if ($user->role === 'admin') {
            $booksQuery = Databuku::query();
        } else {
            $booksQuery = Databuku::where('user_id', $user->id);
        }
    
        if ($request->has('kategori') && $request->kategori !== 'all') {
            $booksQuery->where('kategori', $request->kategori);
        }
    
        $books = $booksQuery->paginate(5);
    
        return view('databuku.index', compact('books', 'categories'));
    }

    /**
     * Show the form for creating a new buku.
     */
    public function add(): View
    {
        $categories = Kategoribuku::all();
        return view('databuku.partials.add-buku-form', compact('categories'));
    }

    /**
     * Store the buku to data buku's table.
     */
    public function store(Request $request)
    {

        $request->validate([
            'judul' => 'required|string',
            'kategori' => 'required|string',
            'deskripsi' => 'required|string',
            'jumlah' => 'required|integer',
            'file_buku' => 'required|mimes:pdf',
            'cover_buku' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fileBuku = $request->file('file_buku');
        $fileBukuPath = $fileBuku->storeAs('public/assets/buku/files', time() . '.' . $fileBuku->getClientOriginalExtension());
        
        $coverBuku = $request->file('cover_buku');
        $coverBukuPath = $coverBuku->storeAs('public/assets/buku/cover', time() . '.' . $coverBuku->getClientOriginalExtension());
        
        $dataBuku = [
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'jumlah' => $request->jumlah,
            'file' => $fileBukuPath,
            'cover' => $coverBukuPath,
        ];

        if (Databuku::create($dataBuku)) {
            return redirect()->route('databuku')->with('status', 'Buku berhasil disimpan.');
        }

        return redirect()->route('databuku.partials.add-buku-form')->with('status', 'Buku gagal disimpan');
    }
     
    /**
     * Request edit buku from the data buku's table.
     */
    public function edit(Request $request): View
    {
        $id = $request->id;
        $book = Databuku::find($id);
        $categories = Kategoribuku::all();
        return view('databuku.partials.edit-buku-form', compact('book', 'categories'));
    }

    /**
     * Update the data buku's edit form.
     */
    public function update(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'kategori' => 'required|string',
            'deskripsi' => 'required|string',
            'jumlah' => 'required|integer',
        ]);

        $dataBuku = Databuku::findOrFail($request->id);

        if ($request->hasFile('file_buku')) {
            Storage::delete($dataBuku->file);
    
            $fileBuku = $request->file('file_buku');
            $fileBukuPath = $fileBuku->storeAs('public/assets/buku/files', time() . '.' . $fileBuku->getClientOriginalExtension());
    
            $dataBuku->file = $fileBukuPath;
        }
    
        if ($request->hasFile('cover_buku')) {
            Storage::delete($dataBuku->cover);
        
            $coverBuku = $request->file('cover_buku');
            $coverBukuPath = $coverBuku->storeAs('public/assets/buku/cover', time() . '.' . $coverBuku->getClientOriginalExtension());
        
            $dataBuku->cover = $coverBukuPath;
        }
        
        $dataBuku->judul = $request->judul;
        $dataBuku->kategori = $request->kategori;
        $dataBuku->deskripsi = $request->deskripsi;
        $dataBuku->jumlah = $request->jumlah;
        
        if($dataBuku->save()){
            return redirect()->route('databuku')->with('status', 'Data buku berhasil diperbarui.');
        }

        return redirect()->route('databuku')->with('status', 'Data buku gagal diperbarui.');
    }

    /**
     * Delete the buku from data buku's.
     */
    public function delete(Request $request)
    {
        $id = $request->id;
        $buku = Databuku::findOrFail($id);
        
        if($buku->delete()){
            return redirect()->route('databuku')->with('status', 'Data buku berhasil dihapus.');
        }

        return redirect()->route('databuku')->with('status', 'Data buku gagal dihapus.');
    }

    public function excel(){
        $nama_file = 'daftar_data_buku'.date('Y-m-d_H-i-s').'.xlsx';
        return Excel::download(new DatabukuExport, $nama_file);
    }

    public function pdf(){
        $nama_file = 'daftar_data_buku'.date('Y-m-d_H-i-s').'.pdf';
        return Excel::download(new DatabukuExport, $nama_file);
    }
}
