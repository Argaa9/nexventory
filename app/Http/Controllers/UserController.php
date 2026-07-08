<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        return view(
            'users',
            compact('users')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'role'     => 'required',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => $request->role,
            'password' => Hash::make(
                $request->password
            )
        ]);

        return redirect()
            ->back()
            ->with(
                'success',
                'User berhasil ditambahkan'
            );
    }

    public function update(
        Request $request,
        User $user
    )
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email'
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role
        ]);

        return redirect()
            ->back()
            ->with(
                'success',
                'User berhasil diperbarui'
            );
    }

    public function destroy(User $user)
    {
        if($user->id == auth()->id())
        {
            return back()->with(
                'error',
                'Tidak bisa menghapus akun sendiri'
            );
        }

        $user->delete();

        return redirect()
            ->back()
            ->with(
                'success',
                'User berhasil dihapus'
            );
    }
}