@extends('layouts.app')

@section('title', 'Sales History')

@section('content')
    <div class="page-head">
        <div>
            <p class="eyebrow">Transactions</p>
            <h1>Sales History</h1>
            <p class="lead">Review completed sales and inventory transactions.</p>
        </div>
        <a href="{{ route('sales.create') }}">+ Record Sale</a>
    </div>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <div class="table-wrap" style="padding:24px; overflow-x:auto;">
        @if ($sales->isEmpty())
            <p>No sales have been recorded yet.</p>
        @else
            <table style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr>
                        <th style="text-align:left; padding:12px;">Date</th>
                        <th style="text-align:left; padding:12px;">Product</th>
                        <th style="text-align:left; padding:12px;">Customer</th>
                        <th style="text-align:left; padding:12px;">Staff</th>
                        <th style="text-align:right; padding:12px;">Quantity</th>
                        <th style="text-align:right; padding:12px;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                        <tr>
                            <td style="padding:12px;">
                                {{ $sale->created_at?->format('M d, Y h:i A') }}
                            </td>
                            <td style="padding:12px;">
                                {{ $sale->product?->name ?? 'Product unavailable' }}
                            </td>
                            <td style="padding:12px;">
                                {{ $sale->customer?->full_name ?? 'Walk-in' }}
                            </td>
                            <td style="padding:12px;">
                                {{ $sale->staff?->full_name ?? 'Staff unavailable' }}
                            </td>
                            <td style="padding:12px; text-align:right;">
                                {{ $sale->quantity }}
                            </td>
                            <td style="padding:12px; text-align:right;">
                                PHP {{ number_format((float) $sale->total_price, 2) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="margin-top:20px;">
                {{ $sales->links() }}
            </div>
        @endif
    </div>
@endsection
