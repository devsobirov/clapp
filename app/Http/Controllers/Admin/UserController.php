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
        $users = User::select('id', 'name', 'email', 'avatar', 'is_admin', 'is_super_admin', 'created_at')
        ->orderBy('id', 'desc')->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.form', ['user' => new User()]);
    }

    public function edit(User $user)
    {
        $this->checkAccess($user);
        return view('admin.users.form', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->checkAccess($user);
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } elseif (array_key_exists('password', $data)) {
            unset($data['password']);
        }
        $data['is_admin'] = boolval($request->post('is_admin'));
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
        if (auth()->user()->isSuperAdmin()) {
            $data['is_admin'] = boolval($request->post('is_admin'));
        }
        $user = User::create($data);

        return redirect()->route('admin.users.edit', $user->id)
            ->with('success', 'User successfully created!');
    }

    public function destroy(User $user)
    {
        abort_if(!auth()->user()->isSuperAdmin(), 403);
        $user->delete();
        return redirect()->back()->with('success', 'User successfully deleted!');
    }

    private function checkAccess(User $user): void
    {
        abort_if($user->isSuperAdmin(), 403);
        abort_if($user->isAdmin() && !auth()->user()->isSuperAdmin(), 403);
    }
}
