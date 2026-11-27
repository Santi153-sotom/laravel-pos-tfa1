<?php

namespace App\Http\Controllers;

use App\Sale;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Intervention\Image\Laravel\Facades\Image;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::orderBy('full_name')->get();

        return view('users.index', compact('users'));
    }

    public function create(): View
    {
        return view('users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:50', 'unique:users,username'],
            'full_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $user = new User();
        $user->username = $validated['username'];
        $user->full_name = $validated['full_name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);

        if ($request->hasFile('avatar')) {
            $user->avatar = $this->storeAvatar($request->file('avatar'));
        }

        $user->save();

        return redirect()->route('users.index')
            ->with('success', 'Staff account created successfully.');
    }

    public function edit(User $user): View
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:50', 'unique:users,username,' . $user->id],
            'full_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $user->username = $validated['username'];
        $user->full_name = $validated['full_name'];
        $user->email = $validated['email'];

        if (! empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        if ($request->hasFile('avatar')) {
            $oldAvatar = $user->avatar;
            $user->avatar = $this->storeAvatar($request->file('avatar'));

            if ($oldAvatar) {
                Storage::disk('public')->delete($oldAvatar);
            }
        }

        $user->save();

        return redirect()->route('users.index')
            ->with('success', 'Staff account updated successfully.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ((int) auth()->id() === (int) $user->id) {
            return redirect()->route('users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        if (Sale::where('sold_by', $user->id)->exists()) {
            return redirect()->route('users.index')
                ->with('error', 'This staff member has sales history and cannot be deleted.');
        }

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Staff account deleted successfully.');
    }

    private function storeAvatar(UploadedFile $file): string
    {
        $path = 'avatars/' . Str::uuid() . '.webp';

        $image = Image::read($file->getRealPath())
            ->cover(300, 300)
            ->toWebp(85);

        Storage::disk('public')->put($path, (string) $image);

        return $path;
    }
}