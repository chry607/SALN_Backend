@extends('layouts.app')

@section('title', 'Simplify Your SALN Filing')

@section('content')

<header style="background-color: var(--bg-white); border-bottom: 1px solid var(--border-color); padding: 16px 0; position: sticky; top: 0; z-index: 100;">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <h3 class="logo-text" style="margin: 0; font-size: 1.25rem; font-weight: 700;">SALN Filing System</h3>
            @if (Auth::check())
                <a href="{{ url('/dashboard') }}" class="btn btn-primary">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            @endif
        </div>
    </div>
</header>

<main>
    <div class="container-narrow hero-section fade-in">
        <div class="text-center" style="margin-bottom: 64px; margin-top: 32px;">
            <h1 style="margin-bottom: 24px;">Simplify Your SALN Filing</h1>
            <p style="font-size: 1.125rem; color: var(--text-secondary); max-width: 560px; margin: 0 auto 32px;">
                A modern, user-friendly way to complete your Statement of Assets, Liabilities, and Net Worth.
            </p>
            @if (Auth::check())
                <a href="{{ url('/dashboard') }}" class="btn btn-primary" style="font-size: 18px; padding: 14px 32px;">Open Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary" style="font-size: 18px; padding: 14px 32px;">Get Started</a>
            @endif
        </div>

        <div class="feature-grid" style="margin-bottom: 48px; display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px;">
            <div class="card" style="text-align: center;">
                <div class="feature-icon">✨</div>
                <h3>Easier SALN Completion</h3>
                <p style="margin-bottom: 0;">Clean form interface with clear sections and safer data flow.</p>
            </div>
            <div class="card" style="text-align: center;">
                <div class="feature-icon">📄</div>
                <h3>Official Document Output</h3>
                <p style="margin-bottom: 0;">Document microservice generates final output separately.</p>
            </div>
            <div class="card" style="text-align: center;">
                <div class="feature-icon">🔒</div>
                <h3>Privacy-First Design</h3>
                <p style="margin-bottom: 0;">Independent auth and form services improve access boundaries.</p>
            </div>
        </div>

        <div class="privacy-notice" style="margin-bottom: 48px;">
            <p style="font-weight: 500; margin-bottom: 8px;">
                🔒 Your Privacy Matters
            </p>
            <p style="font-size: 14px; color: var(--text-secondary);">
                This system stores your SALN data temporarily for your convenience. All data is automatically 
                deleted after 5 days of inactivity. You can also export your data locally at any time as JSON.
            </p>
        </div>

    </div>
</main>

@endsection
