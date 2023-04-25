<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'avatar' => 'nullable|image|max:1024',
            'password' => 'nullable|string|min:6|confirmed'
        ]);

        if (!empty($data['avatar'])) {
            $data['avatar'] = ImageHelper::save(
                $request->file('avatar'),
                'assets/img/avatars',
                auth()->id() . '-' . Str::slug(auth()->user()->name)
            );
        } elseif (array_key_exists('avatar', $data)) {
            unset($data['avatar']);
        }

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } elseif (array_key_exists('password', $data)) {
            unset($data['password']);
        }

        auth()->user()->update($data);

        return redirect()->back()->with('success', 'Profile successfully updated!');
    }
}
