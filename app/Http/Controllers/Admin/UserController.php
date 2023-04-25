<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::select('id', 'name', 'email', 'avatar', 'is_admin', 'created_at')->orderBy('id', 'desc')->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.form', ['user' => new User()]);
    }

    public function edit(User $user)
    {
        abort_if($user->is_admin, 403);
        return view('admin.users.form', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        abort_if($user->is_admin, 403);
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed'
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } elseif (array_key_exists('password', $data)) {
            unset($data['password']);
        }
        $user->update($data);
        return redirect()->back()->with('success', 'Successfully updated!');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        return redirect()->route('admin.users.edit', $user->id)
            ->with('success', 'User successfully created!');
    }
}
