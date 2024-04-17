@extends('layout')
@section('title', App::getLocale() == 'en' ? $conference->conference_title_en . ' - ' : $conference->conference_title .
    ' - ')
@section('content')
    <section class="homepage-section">
        <div class="container">
            <div class="blog-section-header">
                <div class="blog-section-title component">
                    <h2 class="hero-headline">
                        {{ App::getLocale() == 'en' ? $conference->conference_title_en : $conference->conference_title }}
                    </h2>
                    <div class="sharesheet">
                        <div class="sharesheet-content">
                            <ul class="sharesheet-options">
                                <li class="social-option">
                                    <a class="icon icon-facebook social-icon"
                                        href="https://www.facebook.com/profile.php?id=100063636246876" target="_blank"
                                        data-analytics-title="Share via Facebook"
                                        aria-label="Share this article via Facebook (opens in new window)">
                                        <i class="fab fa-facebook"></i>
                                    </a>
                                </li>
                                <li class="social-option">
                                    <a class="icon icon-mail social-icon" href="">
                                        <i class="far fa-envelope"></i>
                                    </a>
                                </li>

                                <li class="social-option">
                                    <a class="icon icon-link social-icon" href="https://www.youtube.com/c/vietnamvartnm"
                                        target="_blank" data-analytics-title="Share via Youtube"
                                        aria-label="Share this article via Youtube (opens in new window)">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="image-fullbleed">
            <div class="component-content">
                <div class="blog__details__pic">
                    <img src="{{ App::getLocale() == 'en' ? asset('storeimages/conference/' . $conference->conference_image_en) : asset('storeimages/conference/' . $conference->conference_image) }}"
                        alt="{{ App::getLocale() == 'en' ? $conference->conference_title_en : $conference->conference_title }}">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="conference blog-section component-content">
                <div class="blog-details-content">
                    <div class="blog__details__text">
                        @if (App::getLocale() == 'en')
                            <p>{!! $conference->conference_content_en !!}</p>
                        @else
                            <p>{!! $conference->conference_content !!}</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
        @if (App::getLocale() == 'vn')
            <div class="section-content">
                <div class="register-conference-block">
                    <div class="lockup">
                        <h2 class="lockup-title">@lang('conference.register')</h2>
                        <div class="subheading">
                            {{ $conference->conference_title }}
                        </div>
                        <a href="{{ Route('registerReport', $conference->conference_code) }}"
                            class="nr-cta-primary-dark">@lang('conference.register_report')</a>
                    </div>
                    <p class="comment-line"></p>
                    <div class="lockup">
                        <h2 class="section-head">@lang('conference.register_conference')</h2>
                    </div>
                    <ul class="section-tiles">
                        @foreach ($getAllConferenceFee as $key => $conferenceFee)
                            <li class="tile-item conference-item">
                                <div class="tile {{ $totalObjects <= 2 ? 'tile-2up' : 'tile-3up' }}">
                                    <div class="tile__title">
                                        <div class="tile__headline title-line">{{ $conferenceFee->conference_fee_title }}
                                        </div>
                                        <div class="title-date">{{ $conferenceFee->conference_fee_date }}</div>
                                    </div>
                                    <div class="price">
                                        {{ number_format($conferenceFee->conference_fee_price, 0, ',', '.') }}₫
                                    </div>
                                    <div class="description-main">{!! $conferenceFee->conference_fee_content !!}</div>
                                    <p class="comment-line"></p>
                                    <div class="tile__description" aria-hidden="true">
                                        <div>{!! $conferenceFee->conference_fee_desc !!}</div>
                                        <a href="{{ Route('registerConference', [$conference->conference_code, $conferenceFee->conference_fee_id]) }}"
                                            class="nr-cta-primary-dark">@lang('conference.register')</a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @else
            <div class="section-content">
                <div class="register-conference-block">
                    <div class="lockup">
                        <h2 class="lockup-title">@lang('conference.register')</h2>
                        <div class="subheading">
                            {{ $conference->conference_title_en }}
                        </div>
                    </div>
                    <ul class="section-tiles">
                        <li class="tile-item conference-item">
                            <div class="tile {{ $totalObjects == 1 ? 'tile-2up' : 'tile-3up' }}">
                                <div class="tile__title">
                                    <div class="tile__headline title-line">@lang('conference.register_report')
                                    </div>
                                    <div class="title-date">April 30, 2024</div>
                                </div>
                                <div class="price">
                                    $100.00
                                </div>
                                <div class="description-main">
                                    <ul style="list-style-type:disc;"><li>Main conference day, 2 tea breaks &amp;1 lunch box.</li><li>Speaker certificate.</li><li>Electronic document.</li><li>Welcome dinner (June 21).</li><li>Gala dinner (June 22).</li><li>Exclude accommodation fees</li></ul>
                                </div>
                                <p class="comment-line"></p>
                                <div class="tile__description" aria-hidden="true">
                                    <div></div>
                                    <a href="{{ Route('registerReportInternational', $conference->conference_code) }}"
                                        class="nr-cta-primary-dark">@lang('conference.register')</a>
                                </div>
                            </div>
                        </li>
                        @foreach ($getAllConferenceFee as $key => $conferenceFee)
                            <li class="tile-item conference-item">
                                <div class="tile {{ $totalObjects == 1 ? 'tile-2up' : 'tile-3up' }}">
                                    <div class="tile__title">
                                        <div class="tile__headline title-line">
                                            {{ $conferenceFee->conference_fee_title }}
                                        </div>
                                        <div class="title-date">{{ $conferenceFee->conference_fee_date }}</div>
                                    </div>
                                    <div class="price">
                                        ${{ number_format($conferenceFee->conference_fee_price, 2) }}
                                    </div>
                                    <div class="description-main">{!! $conferenceFee->conference_fee_content !!}</div>
                                    <p class="comment-line"></p>
                                    <div class="tile__description" aria-hidden="true">
                                        <div>{!! $conferenceFee->conference_fee_desc !!}</div>
                                        <a href="{{ Route('registerConferenceInternational', [$conference->conference_code, $conferenceFee->conference_fee_id]) }}"
                                            class="nr-cta-primary-dark">@lang('conference.register')</a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </section>
@endsection
