<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="A simple point-of-sale account directory built with Laravel.">
    <title>@yield('title', 'POS Accounts') · POS Accounts</title>
    <style>
        :root { color-scheme: light; --ink: #172b3a; --muted: #697b86; --line: #e4ebed; --paper: #f5f8f7; --green: #147d64; --green-dark: #0d5b49; --mint: #e6f4ef; --gold: #e8b65b; }
        * { box-sizing: border-box; }
        body { margin: 0; background: var(--paper); color: var(--ink); font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; }
        a { color: inherit; text-decoration: none; }
        .topbar { background: #102b36; color: white; }
        .topbar-inner { width: min(1120px, calc(100% - 40px)); min-height: 76px; margin: auto; display: flex; align-items: center; justify-content: space-between; gap: 24px; }
        .brand { display: flex; align-items: center; gap: 12px; font-weight: 750; letter-spacing: -.03em; }
        .brand-mark { width: 39px; height: 39px; border-radius: 12px; display: grid; place-items: center; background: var(--gold); color: #102b36; font-size: 19px; font-weight: 900; }
        .brand small { display: block; color: #a8bdc3; font-size: 11px; letter-spacing: .12em; text-transform: uppercase; margin-top: 2px; }
        nav { display: flex; align-items: center; gap: 7px; flex-wrap: wrap; }
        nav a { padding: 10px 13px; border-radius: 9px; color: #cfdbdf; font-size: 14px; font-weight: 600; transition: .18s ease; }
        nav a:hover, nav a.active { color: white; background: rgba(255,255,255,.12); }
        main { width: min(1120px, calc(100% - 40px)); min-height: calc(100vh - 150px); margin: 0 auto; padding: 54px 0 72px; }
        .eyebrow { margin: 0 0 12px; color: var(--green); font-size: 12px; letter-spacing: .14em; font-weight: 800; text-transform: uppercase; }
        h1 { margin: 0; font-size: clamp(34px, 5vw, 52px); line-height: 1.08; letter-spacing: -.045em; }
        h2 { margin: 0; font-size: 21px; letter-spacing: -.025em; }
        p { line-height: 1.65; }
        .lead { max-width: 640px; margin: 17px 0 0; color: var(--muted); font-size: 17px; }
        .hero { position: relative; overflow: hidden; padding: clamp(32px, 6vw, 64px); border-radius: 24px; background: #eaf3ef; }
        .hero::after { position: absolute; width: 280px; height: 280px; right: -85px; top: -100px; border: 1px solid rgba(20,125,100,.18); border-radius: 50%; box-shadow: 0 0 0 32px rgba(20,125,100,.035), 0 0 0 64px rgba(20,125,100,.025); content: ""; }
        .hero-copy { position: relative; z-index: 1; max-width: 690px; }
        .hero h1 { max-width: 620px; }
        .actions { display: flex; gap: 12px; flex-wrap: wrap; margin-top: 27px; }
        .button { display: inline-flex; align-items: center; justify-content: center; min-height: 46px; padding: 0 18px; border-radius: 10px; background: var(--green); color: white; font-weight: 700; font-size: 14px; }
        .button:hover { background: var(--green-dark); }
        .button.secondary { background: white; color: var(--ink); border: 1px solid var(--line); }
        .button.secondary:hover { border-color: #b8ceca; background: #fbfdfc; }
        .section-head { display: flex; align-items: end; justify-content: space-between; gap: 20px; margin: 38px 0 17px; }
        .section-head p { margin: 6px 0 0; color: var(--muted); font-size: 14px; }
        .card-grid { display: grid; grid-template-columns: repeat(3, minmax(0,1fr)); gap: 16px; }
        .card { padding: 22px; border: 1px solid var(--line); border-radius: 16px; background: white; }
        .card-icon { width: 42px; height: 42px; display: grid; place-items: center; margin-bottom: 18px; border-radius: 12px; background: var(--mint); color: var(--green-dark); font-size: 19px; font-weight: 800; }
        .card p { margin: 8px 0 0; color: var(--muted); font-size: 14px; }
        .card-link { display: inline-block; margin-top: 17px; color: var(--green-dark); font-size: 14px; font-weight: 750; }
        .page-head { display: flex; align-items: end; justify-content: space-between; gap: 24px; margin-bottom: 27px; }
        .page-head .lead { margin-top: 10px; font-size: 15px; }
        .count-pill { display: inline-flex; align-items: center; gap: 7px; padding: 9px 12px; border: 1px solid #cfe6dd; border-radius: 99px; background: #f1faf6; color: var(--green-dark); white-space: nowrap; font-size: 13px; font-weight: 750; }
        .table-wrap { overflow: auto; border: 1px solid var(--line); border-radius: 16px; background: white; box-shadow: 0 8px 26px rgba(16,43,54,.035); }
        table { width: 100%; border-collapse: collapse; text-align: left; }
        th, td { padding: 16px 20px; border-bottom: 1px solid var(--line); }
        th { background: #f8faf9; color: #72818a; font-size: 11px; letter-spacing: .1em; text-transform: uppercase; }
        td { color: #334b57; font-size: 14px; }
        tbody tr:last-child td { border-bottom: 0; }
        tbody tr:hover { background: #fbfdfc; }
        .number { color: #8a989e; font-variant-numeric: tabular-nums; }
        .person { color: var(--ink); font-weight: 700; }
        .email { color: #54707d; }
        .role { display: inline-block; padding: 6px 9px; border-radius: 7px; background: #eef5f3; color: #315b52; font-size: 12px; font-weight: 700; }
        .about-grid { display: grid; grid-template-columns: 1.2fr .8fr; gap: 18px; margin-top: 32px; }
        .about-panel { padding: 26px; border: 1px solid var(--line); border-radius: 16px; background: white; }
        .about-panel p { margin: 11px 0 0; color: var(--muted); }
        .route-list { display: grid; gap: 12px; margin: 17px 0 0; padding: 0; list-style: none; }
        .route-list li { display: flex; align-items: center; justify-content: space-between; gap: 12px; padding: 11px 0; border-bottom: 1px solid var(--line); color: var(--muted); font-size: 14px; }
        .route-list li:last-child { border: 0; }
        code { color: var(--green-dark); font-weight: 700; }
        footer { padding: 20px; border-top: 1px solid var(--line); background: white; color: #819099; text-align: center; font-size: 12px; }
        @media (max-width: 720px) { .topbar-inner { width: min(100% - 28px, 1120px); align-items: flex-start; flex-direction: column; padding: 15px 0; gap: 12px; } nav { width: 100%; gap: 2px; } nav a { padding: 8px 10px; font-size: 13px; } main { width: min(100% - 28px, 1120px); padding-top: 30px; } .card-grid, .about-grid { grid-template-columns: 1fr; } .page-head { align-items: flex-start; flex-direction: column; } th, td { padding: 13px 14px; } }
    </style>
</head>
<body>
    <header class="topbar">
        <div class="topbar-inner">
            <a class="brand" href="{{ route('home') }}" aria-label="POS Accounts home">
                <span class="brand-mark">P</span>
                <span>POS Accounts<small>Point of sale directory</small></span>
            </a>
            <nav aria-label="Main navigation">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
                <a href="{{ route('customers.index') }}" class="{{ request()->routeIs('customers.*') ? 'active' : '' }}">Customers</a>
                <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}">Users</a>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>Laravel POS Accounts · TFA1 static data exercise</footer>
</body>
</html>
