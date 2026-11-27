@extends('layouts.app')

@section('title', 'Staff Accounts')

@section('content')
    <div class="page-head">
        <div>
            <p class="eyebrow">Team access</p>
            <h1>Staff Accounts</h1>
            <p class="lead">Manage staff usernames, login emails, and avatars.</p>
        </div>
        <div>
            <span class="count-pill">{{ $users->count() }} staff</span>
            <a class="button" href="{{ route('users.create') }}">+ Create Staff Account</a>
        </div>
    </div>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p style="color:#a12622;">{{ session('error') }}</p>
    @endif

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Avatar</th>
                    <th>Username</th>
                    <th>Full name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td class="number">{{ $loop->iteration }}</td>
                        <td>
                            @if ($user->avatar)
                                <img src="{{ asset('storage/'.$user->avatar) }}"
                                     alt="{{ $user->full_name }} avatar"
                                     style="width:52px;height:52px;object-fit:cover;border-radius:50%;">
                            @else
                                <span style="display:inline-grid;width:52px;height:52px;place-items:center;border-radius:50%;background:#e6f4ef;color:#0d5b49;font-weight:700;">
                                    {{ strtoupper(substr($user->full_name, 0, 1)) }}
                                </span>
                            @endif
                        </td>
                        <td><code>{{ $user->username }}</code></td>
                        <td class="person">{{ $user->full_name }}</td>
                        <td>{{ $user->email ?: '—' }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user) }}">Edit</a>

                            @if ((int) auth()->id() !== (int) $user->id)
                                <form method="POST"
                                      action="{{ route('users.destroy', $user) }}"
                                      style="display:inline;"
                                      onsubmit="return confirm('Delete this staff account?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No staff accounts found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection