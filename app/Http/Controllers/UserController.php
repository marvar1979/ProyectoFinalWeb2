<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'can:isAdmin']); // sólo admins
    }

    public function index()
    {
        return view('users.index', ['users' => User::all()]);
    }

    public function create() { return view('users.create'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'role'  => 'required|in:usuario,cajero,administrador',
            'password' => 'required|min:8'
        ]);

        $data['password'] = Hash::make($data['password']);
        User::create($data);

        return redirect()->route('users.index')->with('ok','Usuario creado');
    }

    public function edit(User $user)  { return view('users.edit', compact('user')); }
    public function update(Request $r, User $user)
    {
        $data = $r->validate([
            'name'=>'required','email'=>'required|email|unique:users,email,'.$user->id,
            'role'=>'required|in:usuario,cajero,administrador'
        ]);
        $user->update($data);
        return back()->with('ok','Actualizado');
    }
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('ok','Eliminado');
    }
}
