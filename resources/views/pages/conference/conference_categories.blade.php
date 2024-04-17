@extends('layout')
@section('title', App::getLocale() == 'en' ? $conferenceCategory->conference_category_name_en . ' - ' :
    $conferenceCategory->conference_category_name . ' - ')
@section('content')
    <section class="homepage-section">
        <div class="section-content">
            <div class="text-center spad">
                <h2 class="section-head">
                    {{ App::getLocale() == 'en' ? $conferenceCategory->conference_category_name_en : $conferenceCategory->conference_category_name }}
                </h2>
            </div>
            <hr>
            <ul class="section-tiles">
                @foreach ($getAllConference as $key => $conference)
                    <li class="tile-item blog-item">
                        <a href="{{ Route('conferenceDetails', [$conferenceCategory->conference_category_slug, $conference->conference_slug]) }}"
                            class="tile tile-3up">
                            <div class="tile__media">
                                <div class=" image set-bg"
                                    data-setbg="{{ App::getLocale() == 'en' ? asset('storeimages/conference/' . $conference->conference_image_en) : asset('storeimages/conference/' . $conference->conference_image) }}"
                                    alt="{{ App::getLocale() == 'en' ? $conference->conference_title_en : $conference->conference_title }}">
                                </div>
                            </div>
                            <div class="tile__description" aria-hidden="true">
                                <div class="tile__head">
                                    <div class="tile__category">{{ $conference->conference_type->conference_type_name }}
                                    </div>
                                    <div class="tile__headline">
                                        {{ App::getLocale() == 'en' ? $conference->conference_title_en : $conference->conference_title }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection
