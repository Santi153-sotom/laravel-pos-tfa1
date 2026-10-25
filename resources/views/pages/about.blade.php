@extends('layouts.app')

@section('title', 'About')

@section('content')
    <p class="eyebrow">Project overview</p>
    <h1>About the POS application</h1>
    <p class="lead">This activity rebuilds the original POS account pages in Laravel using routes, controllers, and Blade templates.</p>

    <section class="about-grid">
        <article class="about-panel">
            <h2>What is included</h2>
            <p>The landing and about pages are handled by <strong>PageController</strong>. Customer and user pages are handled by their own controllers, each with five sample records in a static PHP array.</p>
            <p>The account views use Blade loops to display those records. Navigation links connect every page so the directory can be explored from any screen.</p>
        </article>
        <aside class="about-panel">
            <h2>Application routes</h2>
            <ul class="route-list">
                <li><span>Home</span><code>/</code></li>
                <li><span>About</span><code>/about</code></li>
                <li><span>Customer Accounts</span><code>/customers</code></li>
                <li><span>User Accounts</span><code>/users</code></li>
            </ul>
        </aside>
    </section>
@endsection
