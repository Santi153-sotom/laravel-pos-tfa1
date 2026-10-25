@extends('layouts.app')

@section('title', 'Customer Accounts')

@section('content')
    <div class="page-head">
        <div>
            <p class="eyebrow">Directory</p>
            <h1>Customer Accounts</h1>
            <p class="lead">Contact information for customers in the POS system.</p>
        </div>
        <span class="count-pill"><span aria-hidden="true">●</span> {{ count($customers) }} sample customers</span>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr><th scope="col">#</th><th scope="col">Full name</th><th scope="col">Email address</th><th scope="col">Phone number</th></tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td class="number">{{ $customer['id'] }}</td>
                        <td class="person">{{ $customer['full_name'] }}</td>
                        <td class="email">{{ $customer['email'] }}</td>
                        <td>{{ $customer['phone'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
