@extends('layout')
@section('content')
    <section class="homepage-section">
        <div class="component-content">
            <div class="split-section-full-width-2 conference">
                <a href="{{ Route('conferenceDetails', [$getConferenceVart->conference_category->conference_category_slug, $getConferenceVart->conference_slug]) }}"
                    class="unit-link"></a>
                <div class="split-section-content-3">
                    <div class="justify-column-between content-width-medium">
                        <h3 class="subheading">@lang('conference.conference')
                            {{ $getConferenceVart->conference_type->conference_type_name }}</h3>
                        <h1 class="display-3">
                            {{ App::getLocale() == 'en' ? $getConferenceVart->conference_title_en : $getConferenceVart->conference_title }}
                        </h1>
                        <div class="cta-links">
                            <a href="{{ Route('conferenceDetails', [$getConferenceVart->conference_category->conference_category_slug, $getConferenceVart->conference_slug]) }}"
                                class="nr-cta-primary-dark">@lang('masterpages.home.learn_more')</a>
                        </div>
                    </div>
                </div>
                <img src="{{ App::getLocale() == 'en' ? asset('storeimages/conference/' . $getConferenceVart->conference_image_en) : asset('storeimages/conference/' . $getConferenceVart->conference_image) }}"
                    class="align-self-center-2"
                    alt="{{ App::getLocale() == 'en' ? $getConferenceVart->conference_title_en : $getConferenceVart->conference_title }}">
            </div>
        </div>
        {{-- <div class="split-section-full-width-2">
            <img src="https://assets-global.website-files.com/5e64221268556a38fc35f758/5e642464ba5f93c826f0bab7_purple%20girl2.jpeg"
                class="align-self-center-2">
            <div class="split-section-content-3">
                <div class="justify-column-between content-width-medium">
                    <div>
                        <h6 class="subheading">Go Beyond</h6>
                        <h1 class="display-3">Style Your Beauty Career</h1>
                    </div>
                    <div>
                        <p class="text-lead">Award-winning beauty school in Los Angeles County.</p>
                        <div class="row space-top"><a href="{{ URL::to('/create-order') }}"
                                class="primary-btn-top blue">Learn More</a></div>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="section bg-primary-2">
            <div class="container">
                <img src="{{ asset('assets/images/phien1.png') }}" alt="beauty school open sign"
                    sizes="(max-width: 479px) 95vw, (max-width: 767px) 93vw, (max-width: 991px) 95vw, 96vw"
                    class="section-title overlap-image-top">
                <div class="content-width-medium">
                    <h3 class="large-heading white">The door to your beauty career is wide open. </h3>
                </div>
                <div class="grid-thirds">
                    <div class="card card-muted content-width-small">
                        <div class="card-body numbered-list-card">
                            <div class="large-heading numbered-list-item-number">1.</div>
                            <div class="content-numbered">Schedule a campus tour and meet our staff. </div>
                        </div>
                    </div>
                    <div class="card card-muted content-width-small">
                        <div class="card-body numbered-list-card">
                            <div class="large-heading numbered-list-item-number">2.</div>
                            <div>Learn about the courses and financial aid options.</div>
                        </div>
                    </div>
                    <div class="card card-muted content-width-small">
                        <div class="card-body numbered-list-card">
                            <div class="large-heading numbered-list-item-number">3.</div>
                            <div>Enroll and start your education within days. </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="container">
                <div class="split-section reverse-direction">
                    <div class="justify-column-between content-width-small">
                        <h4 class="large-heading">THÔNG BÁO ĐĂNG KÝ BÀI BÁO CÁO
                            tại HỘI NGHỊ KỸ THUẬT VIÊN Tháng 10/2023.</h4>
                        <div class="list">
                            <ul>
                                <li class="bulleted-list-item border-bottom">
                                    <div class="icon-bullet"></div>
                                    <div class="content-bullet">Link đăng ký BCV dành cho KTV đã đi làm: 👉
                                        https://www.vartconference.com/speaker</div>
                                </li>
                                <li class="bulleted-list-item border-bottom">
                                    <div class="icon-bullet"></div>
                                    <div class="content-bullet">Link đăng ký BCV dành cho Sinh viên:
                                        👉 https://www.vartconference.com/sinhvien</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <img src="{{ asset('assets/images/test4.jpeg') }}" width="494"
                        sizes="(max-width: 479px) 95vw, (max-width: 767px) 89vw, (max-width: 991px) 494px, 46vw"
                        class="centered">
                </div>
            </div>
        </div>
        <div class="section">
            <div class="container">
                <div class="split-section">
                    <div class="justify-column-between content-width-small">
                        <div>
                            <h4 class="large-heading">Trí tuệ nhân tạo.</h4>
                            <p>Với mục đích mang hơi thở của thời đại 4.0 và cập nhật những tiến bộ của khoa học công nghệ
                                thế giới đến quý đông đảo anh chị đồng nghiệp là Kỹ thuật viên, Bác sỹ, Kỹ sư hoặc nhân viên
                                y tế quan tâm đến lĩnh vực Kỹ thuật hình ảnh Y học.
                                Chúng tôi trân trọng kính mời quý anh chị đồng nghiệp cùng tham gia chương trình Hội thảo
                                khoa học hấp dẫn được tổ chức bởi Liên Chi Hội Kỹ thuật hình ảnh y học, Y học hạt nhân và Xạ
                                trị TP. HCM (trực thuộc Hội Y học TPHCM). Chương trình có cả ONLINE và OFFLINE
                            </p>
                        </div>
                        <div class="text-small border-top space-bottom">* Chương trình được đồng cấp CME 8 tiết bởi Hội Y
                            học TP. HCM và Liên chi hội Kỹ thuật hình ảnh Y học, Y học hạt nhân và Xạ trị TP. HCM.</div>
                    </div>
                    <img src="{{ asset('assets/images/test5.jpeg') }}" width="494"
                        alt="beauty school student in yellow hoody"
                        id="w-node-_5a7513d5-a2ec-3801-d1d3-31e71a596db1-5a863bb6"
                        sizes="(max-width: 479px) 95vw, (max-width: 767px) 89vw, (max-width: 991px) 494px, 46vw"
                        class="centered">
                </div>
            </div>
        </div>
        {{-- <div class="section bg-primary-2">
            <div class="container justify-content-center">
                <div class="content-width-large">
                    <div class="card">
                        <div class="card-body-tall">
                            <h6 class="subtitle">Begin Your Journey</h6>
                            <h3 class="large-heading">Schedule Campus Tour</h3>
                            <div class="form-block w-form">
                                <form class="form-grid-vertical" id="schedule-form">
                                    @csrf
                                    <div class="form-element">
                                        <input type="text" class="form-textbox" name="customer_name" autocapitalize="off"
                                            autocomplete="off">
                                        <span class="form-label">Your Name</span>
                                    </div>
                                    <div class="form-element">
                                        <input type="text" class="form-textbox" name="customer_address"
                                            autocomplete="off">
                                        <span class="form-label">Email Address</span>
                                    </div>
                                    <div class="form-element">
                                        <input type="text" class="form-textbox" name="customer_phone"
                                            autocomplete="off">
                                        <span class="form-label">Phone</span>
                                    </div>
                                    <div class="form-element">
                                        <span class="select-label">AGENCY</span>
                                        <select name="customer_agency" class="select-textbox">
                                            <option value="1">AR</option>
                                            <option value="2">MO</option>
                                        </select>
                                    </div>
                                    <div class="form-element">
                                        <textarea type="text" class="form-textbox text-area" name="customer_message" autocomplete="off"></textarea>
                                        <span class="form-label">Your Message</span>
                                    </div>
                                    <button type="button" class="button button-submit schedule-submit">Apply Now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <img src="https://assets-global.website-files.com/5e64221268556a38fc35f758/5e64310b68556a69a836503e_makeup%20girl.jpeg"
                alt="MUA student" sizes="(max-width: 991px) 100vw, 661.921875px" class="form-section-tall-image">
        </div> --}}
    </section>
@endsection
@push('js')
    <script src="{{ versionResource('frontend/js/owl.carousel.min.js') }}" defer></script>
    <script type="text/javascript" defer>
        var url_schedule_submit = "{{ route('schedule_submit') }}";
        $(".btn-team").click(function() {
            // Close all open windows
            $(".content").stop().slideUp(300);
            // $(".icon").html('<i class="fas fa-chevron-up"></i>');
            // Toggle this window open/close
            $(this).next(".content").stop().slideToggle(300);
            $(this).next(".icon").children().html('<i class="fas fa-chevron-up"></i>');
        });
    </script>
    <script src="{{ versionResource('frontend/js/home.js') }}" defer></script>
@endpush
