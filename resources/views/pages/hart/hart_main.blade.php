@extends('layout')
@section('content')
@section('title', 'HART - ')
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
            <h6 class="subheading">HART</h6>
            <h1 class="display-3">Liên chi Hội Kỹ thuật Hình ảnh Y học Thành phố
                Hồ Chí Minh</h1>
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
