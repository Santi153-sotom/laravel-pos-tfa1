@extends('layouts.app')

@section('title', 'User Accounts')

@section('content')
    <div class="page-head">
        <div>
            <p class="eyebrow">Team access</p>
            <h1>User Accounts</h1>
            <p class="lead">Usernames and roles for people who work with the POS system.</p>
        </div>
        <span class="count-pill"><span aria-hidden="true">●</span> {{ count($users) }} sample users</span>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr><th scope="col">#</th><th scope="col">Username</th><th scope="col">Full name</th><th scope="col">Role</th></tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="number">{{ $user['id'] }}</td>
                        <td><code>{{ $user['username'] }}</code></td>
                        <td class="person">{{ $user['full_name'] }}</td>
                        <td><span class="role">{{ $user['role'] }}</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
