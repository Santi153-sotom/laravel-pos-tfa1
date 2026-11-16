@extends('layouts.app')

@section('title', 'Edit Customer')

@section('content')
    <div class="page-head">
        <div>
            <p class="eyebrow">Update account</p>
            <h1>Edit Customer</h1>
            <p class="lead">Update this customer’s account details.</p>
        </div>
    </div>

    <div class="table-wrap" style="padding: 24px;">
        <form method="POST" action="{{ route('customers.update', $customer->id) }}">
            @csrf
            @method('PUT')

            <label for="full_name">Full name</label>
            <input id="full_name" name="full_name" type="text"
                   value="{{ old('full_name', $customer->full_name) }}" maxlength="100" required
                   style="display:block; box-sizing:border-box; width:100%; padding:12px; margin:6px 0 14px;">
            @error('full_name') <p>{{ $message }}</p> @enderror

            <label for="email">Email address</label>
            <input id="email" name="email" type="email"
                   value="{{ old('email', $customer->email) }}" maxlength="100" required
                   style="display:block; box-sizing:border-box; width:100%; padding:12px; margin:6px 0 14px;">
            @error('email') <p>{{ $message }}</p> @enderror

            <label for="phone">Phone number</label>
            <input id="phone" name="phone" type="text"
                   value="{{ old('phone', $customer->phone) }}" maxlength="20"
                   style="display:block; box-sizing:border-box; width:100%; padding:12px; margin:6px 0 14px;">
            @error('phone') <p>{{ $message }}</p> @enderror

            <button type="submit">Update Customer</button>
            <a href="{{ route('customers.index') }}">Cancel</a>
        </form>
    </div>
@endsection