@extends('layout')
@section('content')
@section('title', $courses->courses_title . ' - ')
@if ($courses->courses_themes == 1)
    <section class="homepage-section">
        <div class="section bg-primary-2">
            <div class="container text-center">
                <h6 class="subheading">Tammy's Beauty School</h6>
                <h1 class="display-1">{{ $courses->courses_title }}</h1>
            </div>
        </div>
        @foreach ($getAllCoursesContent as $key => $coursesContent)
            @if ($coursesContent->courses_content_type == 1)
                <div class="section">
                    <div class="container">
                        <div class="split-section reverse-direction">
                            <div class="justify-column-between content-width-small">
                                <h4 class="large-heading">{{ $coursesContent->courses_content_title }}</h4>
                                <div class="list">
                                    {{-- <ul>
                                        <li class="bulleted-list-item border-bottom">
                                            <div class="icon-bullet"></div>
                                            <div class="content-bullet">Day/Evening Classes</div>
                                        </li>
                                        <li class="bulleted-list-item border-bottom">
                                            <div class="icon-bullet"></div>
                                            <div class="content-bullet">Full/Part Time Schedules</div>
                                        </li>
                                        <li class="bulleted-list-item border-bottom">
                                            <div class="icon-bullet"></div>
                                            <div class="content-bullet">Flexible Tuition Payment Options</div>
                                        </li>
                                        <li class="bulleted-list-item border-bottom no-bottom-space">
                                            <div class="icon-bullet"></div>
                                            <div class="content-bullet">Financial Aid</div>
                                        </li>
                                    </ul> --}}
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
        @endforeach
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
        <div class="section bg-primary-2">
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
                                        <input type="text" class="form-textbox" name="customer_name"
                                            autocapitalize="off" autocomplete="off">
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
                                    <button type="button" class="button button-submit schedule-submit">Apply
                                        Now</button>
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
@else
    <section class="homepage-section">
        <div class="section bg-primary-2">
            <div class="container text-center">
                <h6 class="subheading">Tammy's Beauty School</h6>
                <h1 class="display-1">{{ $courses->courses_title }}</h1>
            </div>
        </div>
        <div class="section bg-primary-2">
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
                                        <input type="text" class="form-textbox" name="customer_name"
                                            autocapitalize="off" autocomplete="off">
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
                                    <button type="button" class="button button-submit schedule-submit">Apply
                                        Now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <img src="https://assets-global.website-files.com/5e64221268556a38fc35f758/5e64310b68556a69a836503e_makeup%20girl.jpeg"
                alt="MUA student" sizes="(max-width: 991px) 100vw, 661.921875px" class="form-section-tall-image">
        </div>
        <div class="section">
            <div class="container">
                <div class="split-section reverse-direction">
                    <div class="justify-column-between content-width-small">
                        <h4 class="large-heading">Options to fit your lifestyle</h4>
                        <div class="list">
                            <ul>
                                <li class="bulleted-list-item border-bottom">
                                    <div class="icon-bullet"></div>
                                    <div class="content-bullet">Day/Evening Classes</div>
                                </li>
                                <li class="bulleted-list-item border-bottom">
                                    <div class="icon-bullet"></div>
                                    <div class="content-bullet">Full/Part Time Schedules</div>
                                </li>
                                <li class="bulleted-list-item border-bottom">
                                    <div class="icon-bullet"></div>
                                    <div class="content-bullet">Flexible Tuition Payment Options</div>
                                </li>
                                <li class="bulleted-list-item border-bottom no-bottom-space">
                                    <div class="icon-bullet"></div>
                                    <div class="content-bullet">Financial Aid</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <img src="https://assets-global.website-files.com/5e64221268556a38fc35f758/5e642be6af40024c579f4a0e_purp%20beauty.jpeg"
                        class="centered">
                </div>
            </div>
        </div>
        <div class="section">
            <div class="container">
                <div class="split-section">
                    <div class="justify-column-between content-width-small">
                        <div>
                            <h4 class="large-heading">Focused on getting you licensed.</h4>
                            <p>Nationally accredited* academy with an owner and staff that will push you to the next
                                level.
                            </p>
                        </div>
                        <div class="text-small border-top space-bottom">* accredited by National Accrediting
                            Commission of Career Arts and Sciences (NACCAS)</div>
                    </div>
                    <img src="https://assets-global.website-files.com/5e64221268556a38fc35f758/5e64340fbc2ae5be8f18f53c_hoody%20squareish.jpeg"
                        class="centered">
                </div>
            </div>
        </div>
        <div class="section bg-primary-2">
            <div class="container">
                <div class="content-width-large centered-in-parent">
                    <h3 class="display-1 space-bottom">400 hours</h3>
                    <div class="space-bottom">
                        <p>Manicuring 400 hours scheduled completion:<br>Part Time (20 hours per week) – 5
                            mo.<br>Course:&nbsp;Manicuring <br>Tuition:&nbsp;4,680<br>Reg. Fees(non refundable):
                            75<br>Kit/Books(non refundable):&nbsp;825<br>STRF Fee: 15<br>Total: 5,595 <br></p>
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
    </section>
@endif
@endsection
