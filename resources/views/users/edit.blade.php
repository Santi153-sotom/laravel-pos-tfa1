@extends('layouts.app')

@section('title', 'Edit Staff Account')

@section('content')
    <div class="page-head">
        <div>
            <p class="eyebrow">Update staff account</p>
            <h1>Edit Staff Account</h1>
            <p class="lead">Update this staff member’s details, password, or avatar.</p>
        </div>
    </div>

    <div class="table-wrap" style="padding:24px;">
        @if ($errors->any())
            <div style="margin-bottom:18px; color:#a12622;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('users.update', $user) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label for="username">Username</label>
            <input id="username" name="username" type="text"
                   value="{{ old('username', $user->username) }}" maxlength="50" required
                   style="display:block; box-sizing:border-box; width:100%; padding:12px; margin:6px 0 14px;">
            @error('username') <p style="color:#a12622;">{{ $message }}</p> @enderror

            <label for="full_name">Full name</label>
            <input id="full_name" name="full_name" type="text"
                   value="{{ old('full_name', $user->full_name) }}" maxlength="100" required
                   style="display:block; box-sizing:border-box; width:100%; padding:12px; margin:6px 0 14px;">
            @error('full_name') <p style="color:#a12622;">{{ $message }}</p> @enderror

            <label for="email">Email address</label>
            <input id="email" name="email" type="email"
                   value="{{ old('email', $user->email) }}" maxlength="255" required
                   style="display:block; box-sizing:border-box; width:100%; padding:12px; margin:6px 0 14px;">
            @error('email') <p style="color:#a12622;">{{ $message }}</p> @enderror

            <label for="password">New password (leave blank to keep the current password)</label>
            <input id="password" name="password" type="password" minlength="8"
                   autocomplete="new-password"
                   style="display:block; box-sizing:border-box; width:100%; padding:12px; margin:6px 0 14px;">
            @error('password') <p style="color:#a12622;">{{ $message }}</p> @enderror

            <label for="password_confirmation">Confirm new password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" minlength="8"
                   autocomplete="new-password"
                   style="display:block; box-sizing:border-box; width:100%; padding:12px; margin:6px 0 14px;">

            @if ($user->avatar)
                <p>Current avatar:</p>
                <img src="{{ asset('storage/'.$user->avatar) }}" alt="{{ $user->full_name }} avatar"
                     style="width:100px; height:100px; object-fit:cover; border-radius:50%; margin-bottom:14px;">
            @endif

            <label for="avatar">New avatar (optional, JPG/PNG/WebP, max 2 MB)</label>
            <input id="avatar" name="avatar" type="file" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                   style="display:block; margin:8px 0 18px;">
            @error('avatar') <p style="color:#a12622;">{{ $message }}</p> @enderror

            <button type="submit">Update Staff Account</button>
            <a href="{{ route('users.index') }}">Cancel</a>
        </form>
    </div>
@endsection