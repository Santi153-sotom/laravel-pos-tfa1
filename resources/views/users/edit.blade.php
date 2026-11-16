@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
    <div class="page-head">
        <div>
            <p class="eyebrow">Update account</p>
            <h1>Edit User</h1>
            <p class="lead">Update this user’s details and profile picture.</p>
        </div>
    </div>

    <div class="table-wrap" style="padding: 24px;">
        <form method="POST"
              action="{{ route('users.update', $user->id) }}"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label for="username">Username</label>
            <input id="username" name="username" type="text"
                   value="{{ old('username', $user->username) }}" maxlength="50" required
                   style="display:block; box-sizing:border-box; width:100%; padding:12px; margin:6px 0 14px;">
            @error('username') <p>{{ $message }}</p> @enderror

            <label for="full_name">Full name</label>
            <input id="full_name" name="full_name" type="text"
                   value="{{ old('full_name', $user->full_name) }}" maxlength="100" required
                   style="display:block; box-sizing:border-box; width:100%; padding:12px; margin:6px 0 14px;">
            @error('full_name') <p>{{ $message }}</p> @enderror

            <label for="avatar">Profile picture (optional, max 2MB)</label>
            <input id="avatar" name="avatar" type="file" accept="image/*"
                   style="display:block; margin:6px 0 14px;">
            @error('avatar') <p>{{ $message }}</p> @enderror

            <button type="submit">Update User</button>
            <a href="{{ route('users.index') }}">Cancel</a>
        </form>
    </div>
@endsection