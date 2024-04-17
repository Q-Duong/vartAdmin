@extends('layout')
@section('title', 'About - ')
@section('content')
{{-- 
<div class="section">
    <section class="blog-hero-simple spad">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-9 text-center">
                    <div class="blog__hero__text">
                        <h2>Cơ sở vật chất</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row product__filter">

        </div>
    </div>
</div> --}}
<section class="homepage-section">
    {{-- <div class="section dark">
        <div class="container text-center">
            <h6 class="subheading text-light">Tammy's</h6>
            <h1 class="display-1 text-light">Barber&nbsp;School</h1>
        </div>
    </div> --}}

    <div class="section bg-primary-2">
        <div class="container">
            <div class="centered-hero-container">
                <img src="https://assets-global.website-files.com/5e64221268556a38fc35f758/5e644b46af400203c5a01033_purp%20beauty%20rect.jpeg"
                    alt="purple beauty school student" class="content-width-extra-large muted">
                <h1 class="display-1 centered-hero-heading">We go beyond.</h1>
            </div>
        </div>
    </div>
    <div class="container section">
        <div class="content-width-large centered-in-parent">
            <h6 class="subheading">Peroxide + Purple</h6>
            <h3 class="display-1">Tammy Beauty Education.</h3>
            <div class="border-bottom">
                <p>
                    Our school was built on the foundation of helping out our community & giving opportunities to those who are most in need of it.
                    <br><br>
                    We pride ourselves in being able to help out the Vietnamese community the most, along with people of other diverse backgrounds & give them a better chance to build their careers. 
                </p>
            </div>
        </div>
    </div>
    <div class="pinion-team">
        <div class="container">
            <div class="title-block">
                <h3 class="large-heading-2">Our Management Team</h3>
            </div>
            <section class="team-block">
                <div class="accordion-panel">
                    <button class="accordion-panel-button team">
                        <div class="accordion-panel-title team">
                            <div class="accordion-panel-title-name">
                                <h2>Tammy</h2>
                                <h3>Chief Executive Officer</h3>
                            </div>
                            <div class="accordion-panel-title-icon"><i class="fas fa-chevron-down"></i></div>
                        </div>
                        <div class="accordion-panel-title-avt">
                            <img src="https://assets-global.website-files.com/5e64221268556a38fc35f758/5e644b46af400203c5a01033_purp%20beauty%20rect.jpeg"
                                alt="purple beauty school student" class="content-width-extra-large muted">
                        </div>
                    </button>
                    <div class="accordion-panel-text">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi illo eaque animi
                        commodi quibusdam, nostrum ipsam voluptate mollitia exercitationem explicabo officiis
                        laboriosam, facere aliquid earum ut iste rerum soluta esse?
                    </div>
                    <div class="accordion-panel-line team"></div>
                </div>
                <div class="accordion-panel">
                    <button class="accordion-panel-button team">
                        <div class="accordion-panel-title team">
                            <div class="accordion-panel-title-name">
                                <h2>Tammy</h2>
                                <h3>Chief Executive Officer</h3>
                            </div>
                            <div class="accordion-panel-title-icon"><i class="fas fa-chevron-down"></i></div>
                        </div>
                        <div class="accordion-panel-title-avt">
                            <img src="https://assets-global.website-files.com/5e64221268556a38fc35f758/5e644b46af400203c5a01033_purp%20beauty%20rect.jpeg"
                                alt="purple beauty school student" class="content-width-extra-large muted">
                        </div>
                    </button>
                    <div class="accordion-panel-text">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi illo eaque animi
                        commodi quibusdam, nostrum ipsam voluptate mollitia exercitationem explicabo officiis
                        laboriosam, facere aliquid earum ut iste rerum soluta esse?
                    </div>
                    <div class="accordion-panel-line team"></div>
                </div>
            </section>
        </div>
    </div>
    {{-- <div class="arrow">
                <div class="left"></div>
                <div class="right"></div>
            </div> --}}
    <div class="section bg-primary-2 overflow-hidden">
        <div class="container justify-content-center">
            <div class="content-width-large">
                <div class="card">
                    <div class="card-body-tall">
                        <h6 class="subtitle">Begin Your Journey</h6>
                        <h3 class="large-heading">Schedule Campus Tour</h3>
                        <div class="form-block w-form">
                            <form action="{{ URL::to('/save-order-f') }}" method="POST" class="form-grid-vertical">
                                @csrf
                                <div class="form-element {{ $errors->has('customer_name') ? 'has-error' : '' }}">
                                    <input type="text" class="form-textbox " name="customer_name"
                                        autocapitalize="off" autocomplete="off" value="{{ old('customer_name') }}">
                                    {!! $errors->first(
                                        'customer_name',
                                        '<div class="alert-error"><i class="fas fa-exclamation-circle"></i> :message</div>',
                                    ) !!}
                                    <span class="form-label">Your Name</span>
                                </div>
                                <div class="form-element {{ $errors->has('customer_address') ? 'has-error' : '' }}">
                                    <input type="text" class="form-textbox " name="customer_address"
                                        autocomplete="off" value="{{ old('customer_address') }}">
                                    {!! $errors->first(
                                        'customer_address',
                                        '<div class="alert-error"><i class="fas fa-exclamation-circle"></i> :message</div>',
                                    ) !!}
                                    <span class="form-label">Email Address</span>
                                </div>
                                <div class="form-element {{ $errors->has('customer_address') ? 'has-error' : '' }}">
                                    <input type="text" class="form-textbox " name="customer_address"
                                        autocomplete="off" value="{{ old('customer_address') }}">
                                    {!! $errors->first(
                                        'customer_address',
                                        '<div class="alert-error"><i class="fas fa-exclamation-circle"></i> :message</div>',
                                    ) !!}
                                    <span class="form-label">Phone</span>
                                </div>
                                <button type="button" class="button button-submit">Apply Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <img src="https://assets-global.website-files.com/5e64221268556a38fc35f758/5e64310b68556a69a836503e_makeup%20girl.jpeg"
            alt="MUA student" sizes="(max-width: 991px) 100vw, 661.921875px" class="form-section-tall-image">
    </div>
</section>
@endsection
@push('js')
<script type="text/javascript" defer>
    $(".accordion-panel-button").click(function() {
        // Close all open windows
        $(".accordion-panel-text").stop().slideUp(300, function() {
            $(this).parent().find('.accordion-panel-title-icon').html(
                '<i class="fas fa-chevron-down"></i>');
        });

        $(this).next(".accordion-panel-text").stop().slideToggle(300, function() {
            if ($(this).parent().find('.accordion-panel-title-icon').html() ==
                '<i class="fas fa-chevron-down"></i>') {
                $(this).parent().find('.accordion-panel-title-icon').html(
                    '<i class="fas fa-chevron-up"></i>');
            } else {
                $(this).parent().find('.accordion-panel-title-icon').html(
                    '<i class="fas fa-chevron-down"></i>');
            }
        });
    });
    $(".arrow")
        .mouseenter(function() {
            $(".right").stop(true).animate({
                    bottom: "40px"
                }, 300)
                .animate({
                    right: "31px"
                }, 300);

            $(".left").stop(true).animate({
                    bottom: "40px"
                }, 300)
                .animate({
                    left: "32px"
                }, 300);

            // console.log("hover in");
        })
        .mouseleave(function() {
            $(".right").stop(true).animate({
                bottom: "20px"
            }, 300).animate({
                right: "0px"
            }, 300);

            $(".left").stop(true).animate({
                bottom: "20px"
            }, 300).animate({
                left: "0px"
            }, 300);

            // console.log("hover out");
        });
</script>
@endpush
