@extends('layout')
@section('content')
@section('title', 'Courses - ')
<section class="homepage-section">
    {{-- <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Blog Categories</h4>
                    <div class="breadcrumb__links">
                        <a href="{{ URL::to('/') }}">Trang chủ</a>
                        <span>Danh mục tin tức</span>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="section">
        <div class="container text-center">
            <h6 class="subheading">Learn with us</h6>
            <h1 class="display-1">Beauty &amp;&nbsp;Barber<br>Courses</h1>
        </div>
    </div>
    <div class="section bg-primary-2">
        <div class="container">
            <div class="w-layout-grid grid-40-60">
                <div class="justify-column-between content-width-small">
                    <div>
                        <h6 class="subtitle">Choose your own path</h6>
                        <h3 class="large-heading">Why Cosmetology? </h3>
                    </div>
                    <p>Beyond 21st Century Beauty Academy is accredited by the National Accrediting Commission of Career
                        Arts and Sciences (NACCAS) and offers cosmetology, barbering, barber crossover, esthetician,
                        manicuring, and cosmetology instructor trainee programs.</p>
                    <div class="row"></div>
                </div>
                <div class="w-layout-grid icon-card-grid-halves">
                    <div class="card card-muted content-width-small">
                        <div class="card-body"><img
                                src="https://assets-global.website-files.com/5e64221268556a38fc35f758/5e642212e129e123a4c91f5f_heart.svg"
                                alt="heart icon" class="icon-large subheading">
                            <h5>Independence</h5>
                            <div>Build your business and become your own boss. </div>
                        </div>
                    </div>
                    <div class="card card-muted content-width-small">
                        <div class="card-body"><img
                                src="https://assets-global.website-files.com/5e64221268556a38fc35f758/5e642212e129e1aaffc91f52_arrow-up.svg"
                                alt="up arrow" class="icon-large subheading">
                            <h5>Always in Demand</h5>
                            <div>Choose a career that will never go out of style. </div>
                        </div>
                    </div>
                    <div class="card card-muted content-width-small">
                        <div class="card-body"><img
                                src="https://assets-global.website-files.com/5e64221268556a38fc35f758/5e642212e129e102c9c91f6d_more-vertical.svg"
                                alt="three dots" class="icon-large subheading">
                            <h5>Career Options</h5>
                            <div>From the salon to Hollywood or the classroom, and beyond. </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section bg-gray-4">
        <div class="container">
            <div class="section-title-left content-width-medium">
                <h6 class="subheading">We're blushing</h6>
                <h3 class="large-heading-2">Why Tammy's Beauty School?</h3>
            </div>
            <div class="grid-halves space-bottom">
                <ul role="list" class="content-width-large centered-content-mobile">
                    <li class="bulleted-list-item border-bottom">
                        <div class="icon-bullet"></div>
                        <div>CCA School Owner of the Year</div>
                    </li>
                    <li class="bulleted-list-item border-bottom">
                        <div class="icon-bullet"></div>
                        <div>2X Supercuts Teacher of the Year</div>
                    </li>
                    <li class="bulleted-list-item border-bottom">
                        <div class="icon-bullet"></div>
                        <div>Strong alumni network for career placement</div>
                    </li>
                </ul>
                <ul role="list" class="content-width-large centered-content-mobile">
                    <li class="bulleted-list-item border-bottom">
                        <div class="icon-bullet"></div>
                        <div>Active in competition</div>
                    </li>
                    <li class="bulleted-list-item border-bottom">
                        <div class="icon-bullet"></div>
                        <div>Nationally Accredited </div>
                    </li>
                    <li class="bulleted-list-item border-bottom">
                        <div class="icon-bullet"></div>
                        <div>All the courses</div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="w-layout-grid split-section align-center">
                <div class="content-width-large">
                    <div class="overlay-title-wrapper"><img
                            src="https://assets-global.website-files.com/5e64221268556a38fc35f758/5e6456d8ba5f93255ff1a9b4_hair%20swing.jpeg"
                            alt="hair stylist student"
                            sizes="(max-width: 479px) 95vw, (max-width: 767px) 89vw, (max-width: 991px) 598px, 46vw">
                        <div class="overlay-title display-3">Pick your passion.</div>
                    </div>
                </div>
                {{-- <div class="content-width-medium">
                    <div class="accordion-panel">
                        <div class="accordion-title-panel">
                            <h5 class="no-bottom-space">Cosmetology</h5><img
                                src="https://assets-global.website-files.com/5e64221268556a38fc35f758/5e642212e129e151d2c91f7f_chevron-down.svg"
                                alt="" class="accordion-title-icon">
                        </div>
                        <div class="accordion-content" style="display: none;">
                            <p>1000 hours<br><br>¾ Time (30 hours per week) – 8.3 months<br>Part Time (20 hours per
                                week) – 12.5 months</p>
                            <div class="w-richtext">
                                <p><a href="/beauty-school-courses/cosmetology" previewlistener="true">Learn more about
                                        Cosmetology School</a></p>
                            </div>
                        </div>
                    </div>
                    
                </div> --}}
                <div class="content-width-medium">
                    {{-- <div class="team-item">
                        <button class="btn-team">
                            <div class="team-name">
                                <div class="section-name">
                                    <h2>Tammy</h2>
                                    <h3>Chief Executive Officer</h3>
                                </div>
                                <div class="team-icon"><i class="fas fa-chevron-down"></i></div>
                            </div>
                            <div class="team-avt">
                                <img src="https://assets-global.website-files.com/5e64221268556a38fc35f758/5e644b46af400203c5a01033_purp%20beauty%20rect.jpeg"
                                    alt="purple beauty school student" class="content-width-extra-large muted">
                            </div>
                        </button>
                        <div class="team-info">
                            <div class="team-info-text">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi illo eaque animi
                                commodi quibusdam, nostrum ipsam voluptate mollitia exercitationem explicabo officiis
                                laboriosam, facere aliquid earum ut iste rerum soluta esse?
                            </div>
                        </div>
                        <div class="line"></div>
                    </div> --}}
                    @foreach ($getAllCourses as $key => $course)
                        <div class="accordion-panel">
                            <button class="accordion-panel-button">
                                <div class="accordion-panel-title">
                                    <div class="accordion-panel-title-name">
                                        <h3>{{ $course->courses_title }}</h3>
                                    </div>
                                    <div class="accordion-panel-title-icon"><i class="fas fa-chevron-down"></i></div>
                                </div>
                            </button>
                            <div class="accordion-panel-text">
                                {!! $course->courses_programs !!}
                            </div>
                            <div class="accordion-panel-line"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
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
</script>
@endpush
