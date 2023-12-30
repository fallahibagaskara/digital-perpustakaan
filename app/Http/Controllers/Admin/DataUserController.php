<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;


class DataUserController extends Controller
{
    /**
     * Display the data user's table.
     */
    public function index(Request $request): View
    {
        $users = User::paginate(5);
        return view('datauser.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new user.
     */
    public function add(): View
    {
        return view('datauser.partials.add-user-form');
    }

    /**
     * Store the user to data user's table.
     */
    public function store(Request $request)
    {

        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
        ]);

        $user = [
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ];

        if (User::create($user)) {
            return redirect()->route('datauser')->with('status', 'Data user berhasil disimpan.');
        }

        return redirect()->route('datauser.partials.add-user-form')->with('status', 'Data user gagal disimpan.');
    }
     
    /**
     * Request edit user from the data user's table.
     */
    public function edit(Request $request): View
    {
        $id = $request->id;
        $user = User::find($id);
        return view('datauser.partials.edit-user-form', compact('user'));
    }

    /**
     * Update the data user's edit form.
     */
    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|string',
            'role' => 'required|string',
        ]);

        $dataUser = User::findOrFail($request->id);
        if($request->filled('password')){
            $dataUser->password = Hash::make($request->password);
        }

        $dataUser->name = $request->nama;
        $dataUser->email = $request->email;
        $dataUser->role = $request->role;

        if($dataUser->save()){
            return redirect()->route('datauser')->with('status', 'Data user berhasil diperbarui.');
        }

        return redirect()->route('datauser')->with('status', 'Data user buku gagal diperbarui.');
    }

    /**
     * Delete the user from data user's.
     */
    public function delete(Request $request)
    {
        $id = $request->id;
        $user = User::findOrFail($id);
        
        if($user->delete()){
            return redirect()->route('datauser')->with('status', 'Data user berhasil dihapus.');
        }

        return redirect()->route('datauser')->with('status', 'Data user gagal dihapus.');
    }
}
