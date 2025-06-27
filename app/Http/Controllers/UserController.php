<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    public function index(Request $request)
    {
        $query = User::query();

        // Filtro por rol
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Búsqueda por nombre o email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Paginamos y conservamos parámetros
        $users = $query->paginate(10)->appends($request->only('role','search'));

        return view('users.index', [
            'users'  => $users,
            'roles'  => ['administrador','cajero','cliente'],
            'filter' => $request->only('role','search'),
        ]);
    }

    public function create()
    {
        return view('users.create', [
            'roles' => ['administrador','cajero','cliente'],
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:5',
            'role'     => 'required|in:administrador,cajero,cliente',
        ]);

        $data['password'] = Hash::make($data['password']);
        User::create($data);

        return redirect()
            ->route('users.index')
            ->with('success','Usuario creado correctamente');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', [
            'user'  => $user,
            'roles' => ['administrador','cajero','cliente'],
        ]);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|min:5',
            'role'     => 'required|in:administrador,cajero,cliente',
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()
            ->route('users.index')
            ->with('success','Usuario actualizado correctamente');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success','Usuario eliminado correctamente');
    }
}
