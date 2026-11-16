@extends('layouts.app')

@section('title', 'User Accounts')

@section('content')
    <div class="page-head">
        <div>
            <p class="eyebrow">Team access</p>
            <h1>User Accounts</h1>
            <p class="lead">Usernames and full names for people who work with the POS system.</p>
        </div>
        <div>
            <span class="count-pill">{{ count($users) }} users</span>
            <a href="{{ route('users.create') }}"
               style="display:inline-block; margin-left:10px; padding:10px 14px; background:#0b514e; color:white; border-radius:8px; text-decoration:none;">
                + Create User
            </a>
        </div>
    </div>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Avatar</th>
                    <th scope="col">Username</th>
                    <th scope="col">Full name</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td class="number">{{ $user->id }}</td>
                        <td>
                            <img
                                src="{{ $user->avatar ? \Illuminate\Support\Facades\Storage::disk('public')->url($user->avatar) : asset('images/avatar-placeholder.svg') }}"
                                alt="{{ $user->full_name }} avatar"
                                width="48"
                                height="48"
                                style="object-fit:cover; border-radius:50%;"
                            >
                        </td>
                        <td><code>{{ $user->username }}</code></td>
                        <td class="person">{{ $user->full_name }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection