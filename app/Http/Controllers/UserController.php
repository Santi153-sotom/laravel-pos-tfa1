<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Intervention\Image\Laravel\Facades\Image;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    public function create(): View
    {
        return view('users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'username' => 'required|string|max:50|unique:users,username',
            'full_name' => 'required|string|max:100',
        ]);

        $user = new User();
        $user->username = $validated['username'];
        $user->full_name = $validated['full_name'];
        $user->save();

        return redirect()->route('users.index')
            ->with('success', 'User account created successfully.');
    }

    public function edit(int $id): View
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'username' => 'required|string|max:50|unique:users,username,' . $user->id,
            'full_name' => 'required|string|max:100',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user->username = $validated['username'];
        $user->full_name = $validated['full_name'];

        if ($request->hasFile('avatar')) {
            $image = Image::read($request->file('avatar'))
                ->cover(300, 300)
                ->toWebp(85);

            $avatarPath = 'avatars/' . Str::uuid() . '.webp';

            Storage::disk('public')->put($avatarPath, (string) $image);

            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $user->avatar = $avatarPath;
        }

        $user->save();

        return redirect()->route('users.index')
            ->with('success', 'User account updated successfully.');
    }
}