@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <section class="hero">
        <div class="hero-copy">
            <p class="eyebrow">Point of sale · account directory</p>
            <h1>A clear view of your POS accounts.</h1>
            <p class="lead">Browse customer contact details and the people who use the system. This Laravel rebuild uses sample data while the application is being developed.</p>
            <div class="actions">
                <a class="button" href="{{ route('customers.index') }}">View customers <span aria-hidden="true">&nbsp;→</span></a>
                <a class="button secondary" href="{{ route('users.index') }}">View users</a>
            </div>
        </div>
    </section>

    <div class="section-head">
        <div>
            <h2>Account directory</h2>
            <p>Choose a section to browse the sample records.</p>
        </div>
    </div>
    <section class="card-grid" aria-label="Account sections">
        <article class="card">
            <div class="card-icon" aria-hidden="true">C</div>
            <h2>Customer Accounts</h2>
            <p>Contact details for customers saved in the POS directory.</p>
            <a class="card-link" href="{{ route('customers.index') }}">Open customers <span aria-hidden="true">→</span></a>
        </article>
        <article class="card">
            <div class="card-icon" aria-hidden="true">U</div>
            <h2>User Accounts</h2>
            <p>System usernames, names, and roles for the POS team.</p>
            <a class="card-link" href="{{ route('users.index') }}">Open users <span aria-hidden="true">→</span></a>
        </article>
        <article class="card">
            <div class="card-icon" aria-hidden="true">i</div>
            <h2>About this project</h2>
            <p>See the pages and Laravel features included in this activity.</p>
            <a class="card-link" href="{{ route('about') }}">Read about the project <span aria-hidden="true">→</span></a>
        </article>
    </section>
@endsection
