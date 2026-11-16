@extends('layouts.app')

@section('title', 'Create User')

@section('content')
    <div class="page-head">
        <div>
            <p class="eyebrow">New account</p>
            <h1>Create User</h1>
            <p class="lead">Enter the user’s account details.</p>
        </div>
    </div>

    <div class="table-wrap" style="padding: 24px;">
        <form method="POST" action="{{ route('users.store') }}">
            @csrf

            <label for="username">Username</label>
            <input id="username" name="username" type="text"
                   value="{{ old('username') }}" maxlength="50" required
                   style="display:block; box-sizing:border-box; width:100%; padding:12px; margin:6px 0 14px;">
            @error('username') <p>{{ $message }}</p> @enderror

            <label for="full_name">Full name</label>
            <input id="full_name" name="full_name" type="text"
                   value="{{ old('full_name') }}" maxlength="100" required
                   style="display:block; box-sizing:border-box; width:100%; padding:12px; margin:6px 0 14px;">
            @error('full_name') <p>{{ $message }}</p> @enderror

            <button type="submit">Save User</button>
            <a href="{{ route('users.index') }}">Cancel</a>
        </form>
    </div>
@endsection