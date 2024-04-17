@extends('layout')
@section('title', __('masterpages.header.contact') . ' - ')
@push('css')
    <link rel="stylesheet" href="{{ versionResource('frontend/css/ac-localnav.built.css') }}" type="text/css" as="style">
@endpush
@section('content')
<section class="homepage-section">
    <nav id="ac-localnav" class="no-js ac-localnav ac-localnav-scrim css-sticky" role="navigation"
        aria-label="@lang('masterpages.header.contact')">
        <div class="ac-ln-wrapper">
            <div class="ac-ln-background"></div>
            <div class="ac-ln-content">
                <span class="ac-ln-title">
                    <a href="/newsroom/" data-analytics-title="product index"
                        previewlistener="true">@lang('masterpages.header.contact')</a>
                </span>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="text-center spad">
            <h2 class="section-head">
                @lang('masterpages.header.contact')
            </h2>
        </div>
        <div class="component-content">
            <div class="split-section-full-width-2 contact">
                <div class="split-section-content-3">
                    <div class="justify-column-between content-width-medium">
                        <h3 class="contact-title">VART</h3>
                        <p class="contact-info">@lang('masterpages.footer.phone'):<a href="tel:+0913559636"> 0913.559.636 (
                                @lang('masterpages.footer.mrd') )</a>
                        </p>
                        <p class="contact-info">@lang('masterpages.footer.email'):<a href="mailto:hoikythuatdq.yhhn.vn@gmail.com">
                                hoikythuatdq.yhhn.vn@gmail.com</a>
                        </p>
                        <p class="contact-info">@lang('masterpages.footer.address'):
                            <a target="_blank" href="https://maps.app.goo.gl/7ggkU6YeGcWe1TFCA">
                                @lang('masterpages.footer.addHN')
                                <span class="link-maps"> ( @lang('masterpages.footer.seemaps') )</span>
                            </a>
                        </p>
                    </div>
                </div>
                <div class="contact-maps">
                    <iframe defer
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.7481352689088!2d105.83673477540758!3d21.00273088867184!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135adde1208b821%3A0x90e21ec8f685918a!2zQuG7h25oIHZp4buHbiBC4bqhY2ggTWFpIEjDoCBO4buZaQ!5e0!3m2!1svi!2s!4v1712223388776!5m2!1svi!2s"
                        height="400px" width="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
            <div class="split-section-full-width-2">
                <div class="contact-maps">
                    <iframe defer
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.6923412786073!2d106.65868287524705!3d10.75817745952959!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752ef1da39c533%3A0x816672e115a46765!2zQuG7h25oIFZp4buHbiDEkOG6oWkgSOG7jWMgWSBExrDhu6NjIFRQSENNLSBDxqEgc-G7nyAy!5e0!3m2!1svi!2s!4v1712223700237!5m2!1svi!2s"
                        height="400px" width="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                <div class="split-section-content-3">
                    <div class="justify-column-between content-width-medium">
                        <h3 class="contact-title">HART</h3>
                        <p class="contact-info">@lang('masterpages.footer.phone'):<a href="tel:+0913636541 "> 0913.636.541 (
                                @lang('masterpages.footer.mrv') )</a>
                        </p>
                        <p class="contact-info">@lang('masterpages.footer.email'):<a href="mailto:hoikythuatdq.yhhn.vn@gmail.com">
                                hoikythuatdq.yhhn.vn@gmail.com</a>
                        </p>
                        <p class="contact-info">@lang('masterpages.footer.address'):
                            <a target="_blank" href="https://maps.app.goo.gl/o9JrSEV8hYYViqth7">
                                @lang('masterpages.footer.addHCM')
                                <span class="link-maps"> ( @lang('masterpages.footer.seemaps') )</span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
