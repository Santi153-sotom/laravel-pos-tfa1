@extends('layouts.app')

@section('title', 'Customer Accounts')

@section('content')
    <div class="page-head">
        <div>
            <p class="eyebrow">Directory</p>
            <h1>Customer Accounts</h1>
            <p class="lead">Contact information for customers in the POS system.</p>
        </div>
        <div>
            <span class="count-pill">{{ count($customers) }} customers</span>
            <a href="{{ route('customers.create') }}"
               style="display:inline-block; margin-left:10px; padding:10px 14px; background:#0b514e; color:white; border-radius:8px; text-decoration:none;">
                + Create Customer
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
                    <th scope="col">Full name</th>
                    <th scope="col">Email address</th>
                    <th scope="col">Phone number</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($customers as $customer)
                    <tr>
                        <td class="number">{{ $customer->id }}</td>
                        <td class="person">{{ $customer->full_name }}</td>
                        <td class="email">{{ $customer->email }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>
                            <a href="{{ route('customers.edit', $customer->id) }}">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No customers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection