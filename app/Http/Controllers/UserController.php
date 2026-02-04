<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')->get();
        return view('admin.users.index', compact('users'));
    }

    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:waiting,user_optima,admin',
        ]);

        $user = User::findOrFail($id);

        // ❌ Admin tidak boleh downgrade dirinya sendiri
        if (
            Auth::id() === $user->id &&
            Auth::user()->role === 'admin' &&
            $request->role !== 'admin'
        ) {
            return back()->with('error', 'Anda tidak dapat mengubah role akun sendiri.');
        }

        $user->update([
            'role' => $request->role,
        ]);

        return back()->with('success', 'Role berhasil diubah');
    }
}
