<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Databuku;
use App\Models\Kategoribuku;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    /**
     * Display the data buku's table.
     */
    // public function index(Request $request): View
    // {
    //     $user = Auth::user();

    //     if ($user->role === 'admin') {
    //         $books = Databuku::paginate(2);
    //     } else {
    //         $books = Databuku::where('user_id', $user->id)->paginate(2);
    //     }

    //     return view('dashboard', compact('books'));
    // }

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
    
        return view('dashboard', compact('books', 'categories'));
    }
}
