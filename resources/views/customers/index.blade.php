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
            <span class="count-pill">{{ $customers->count() }} customers</span>
            <a class="button" href="{{ route('customers.create') }}">+ Create Customer</a>
        </div>
    </div>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Full name</th>
                    <th>Email address</th>
                    <th>Phone number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($customers as $customer)
                    <tr>
                        <td class="number">{{ $loop->iteration }}</td>
                        <td class="person">{{ $customer->full_name }}</td>
                        <td class="email">{{ $customer->email }}</td>
                        <td>{{ $customer->phone ?: '—' }}</td>
                        <td>
                            <a href="{{ route('customers.edit', $customer->id) }}">Edit</a>
                            <form method="POST"
                                  action="{{ route('customers.destroy', $customer->id) }}"
                                  style="display:inline;"
                                  onsubmit="return confirm('Delete this customer? Their past sales will remain in history.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
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