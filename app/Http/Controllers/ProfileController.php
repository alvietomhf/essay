<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $data = auth()->user();

        return view('profile.index', compact('data'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $input = $request->validate([
            'name' => 'required|string|min:2|max:50',
            'username' => 'required|alpha_dash|min:2|max:50|unique:users,username,' . $user->id,
            'email' => 'required|string|email|unique:users,email,' . $user->id,
            'phone' => 'required|string|min:8|max:15|unique:users,phone,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'nullable|string|min:6|confirmed',
        ]);
        // dd($request->all());
        $oldAvatar = $user->avatar;
        if ($request->hasFile('avatar')) {
            if (Storage::exists('public/images/' . $oldAvatar)) {
                Storage::delete('public/images/' . $oldAvatar);
            }
            $avatar = rand() . '.' . $request->avatar->getClientOriginalExtension();
            Storage::putFileAs('public/images', $request->file('avatar'), $avatar);
        } else {
            $avatar = $oldAvatar;
        }

        $password = $request->password ? Hash::make($request->password) : $user->password;

        $user->update(array_merge(
            $input,
            [
                'avatar' => $avatar,
                'password' => $password,
            ]
        ));

        flash('Berhasil mengedit profile')->success();

        return redirect()->route('profile.index');
    }
}
