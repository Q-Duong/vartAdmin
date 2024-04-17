@extends('layout')
@section('title', 'Page Note Found - ')
@push('css')
    <link rel="stylesheet" href="{{ versionResource('assets/css/overview.built.css') }}" type="text/css" as="style">
@endpush
@section('content')
    <section class="homepage-section">
        <main id="main" class="main" role="main" data-page-type="overview">
            <h2 class="section-headline typography-headline">The page you’re looking for can’t be&nbsp;found.</h2>
            <aside id="search-wrapper" role="search" data-analytics-region="search" aria-hidden="false">

            </aside>
            <div class="cta-sitemap">
                <a href="{{ Route('home') }}" class="nr-cta-primary-dark" previewlistener="true">
                    Go to Home
                </a>
            </div>
        </main>
    </section>
@endsection
