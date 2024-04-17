@extends('layout')
@section('content')
@section('title', $hart->hart_title . ' - ')

<section class="homepage-section">
    <div class="section bg-primary-2">
        <div class="container text-center">
            <h6 class="subheading">HART</h6>
            <h1 class="display-1">{{ $hart->hart_title }}</h1>
        </div>
    </div>
    {{-- @foreach ($getAllVartContent as $key => $vartContent)
        @if ($coursesContent->courses_content_type == 1)
            <div class="section">
                <div class="container">
                    <div class="split-section reverse-direction">
                        <div class="justify-column-between content-width-small">
                            <h4 class="large-heading">{{ $coursesContent->courses_content_title }}</h4>
                            <div class="list">
                                {!! $coursesContent->courses_content_text !!}
                            </div>
                        </div>
                        <img src="{{ asset('storeimages/coursescontent/' . $coursesContent->courses_content_image) }}"
                            class="centered">
                    </div>
                </div>
            </div>
        @elseif ($coursesContent->courses_content_type == 2)
            <div class="section">
                <div class="container">
                    <div class="split-section">
                        <div class="justify-column-between content-width-small">
                            <div>
                                <h4 class="large-heading">Focused on getting you licensed.</h4>
                                <p>Nationally accredited* academy with an owner and staff that will push you to the
                                    next
                                    level.
                                </p>
                            </div>
                            <div class="text-small border-top space-bottom">* accredited by National Accrediting
                                Commission of Career Arts and Sciences (NACCAS)</div>
                        </div>
                        <img src="{{ asset('storeimages/coursescontent/' . $coursesContent->courses_content_image) }}"
                            class="centered">
                    </div>
                </div>
            </div>
        @else
            <div class="section bg-primary-2">
                <div class="container">
                    <div class="content-width-large centered-in-parent">
                        <h3 class="display-1 space-bottom">{{ $coursesContent->courses_content_title }}</h3>
                        <div class="space-bottom">
                            <p>{!! $coursesContent->courses_content_text !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach --}}
    <div class="container">
        @foreach ($getAllHartContent as $key => $hartContent)
            <div class="blog__details__text">
                <p>{!! $hartContent->hart_content_text !!}</p>
            </div>
        @endforeach
    </div>
</section>
@endsection
