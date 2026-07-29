<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends AdminBaseController
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($search = trim($request->input('search', ''))) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%");
            });
        }

        $sort = $request->input('sort', 'name');
        $direction = $request->input('dir', 'asc');

        match ($sort) {
            'email' => $query->orderBy('email', $direction),
            'status' => $query->orderBy('status', $direction),
            'created_at' => $query->orderBy('created_at', $direction),
            default => $query->orderBy('name', $direction),
        };

        $users = $request->boolean('show_all')
            ? $query->get()
            : $query->paginate(10)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.form', [
            'user' => new User(),
            'mode' => 'create',
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'username' => ['required', 'string', 'max:150', 'unique:users,username'],
            'email' => ['required', 'email', 'max:180', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'status' => ['required', 'in:active,inactive,blocked'],
        ]);

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna baru berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('admin.users.form', [
            'user' => $user,
            'mode' => 'edit',
        ]);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'username' => ['required', 'string', 'max:150', 'unique:users,username,' . $user->id],
            'email' => ['required', 'email', 'max:180', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
            'status' => ['required', 'in:active,inactive,blocked'],
        ]);

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }
}
