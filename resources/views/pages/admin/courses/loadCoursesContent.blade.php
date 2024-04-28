@foreach ($getAllCoursesContent as $key => $coursesContent)
                        <div class=" form-group item-detail">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="item-detial-main">
                                        <input type="hidden"
                                                class="courses_content_id_{{ $coursesContent->courses_content_id }}"
                                                value="{{ $coursesContent->courses_content_id }}">
                                        <span class="title-item-detail">
                                            Type
                                        </span>
                                        <div class="main-item-img ">
                                            <input type="hidden"
                                                class="courses_content_type_{{ $coursesContent->courses_content_id }}"
                                                value="{{ $coursesContent->courses_content_type }}">
                                            @if ($coursesContent->courses_content_type == 1)
                                                <img src="{{ asset('backend/images/content_type/content_type_1.png') }}"
                                                    class="main-item-detail-img">
                                            @elseif ($coursesContent->courses_content_type == 2)
                                                <img src="{{ asset('backend/images/content_type/content_type_2.png') }}"
                                                    class="main-item-detail-img">
                                            @else
                                                <img src="{{ asset('backend/images/content_type/content_type_3.png') }}"
                                                    class="main-item-detail-img">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="item-detial-main">
                                        <span class="title-item-detail">
                                            Title
                                        </span>
                                        <div class="main-item-detail">
                                            <input type="hidden"
                                                class="courses_content_title_{{ $coursesContent->courses_content_id }}"
                                                value="{{ $coursesContent->courses_content_title }}">
                                            {{ $coursesContent->courses_content_title }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="item-detial-main">
                                        <span class="title-item-detail">
                                            Content
                                        </span>
                                        <div
                                            class="main-item-detail {{ $coursesContent->courses_content_type == 3 ? 'bg-dark' : '' }} courses_content_text_{{ $coursesContent->courses_content_id }}">
                                            {!! $coursesContent->courses_content_text !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="item-detial-main">
                                        <span class="title-item-detail">
                                            Image
                                        </span>
                                        <div class="main-item-img">
                                            <input type="hidden"
                                                class="courses_content_image_{{ $coursesContent->courses_content_id }}"
                                                value="{{ $coursesContent->courses_content_image }}">
                                            @if ($coursesContent->courses_content_image)
                                                <img src="{{ asset('storeimages/coursescontent/' . $coursesContent->courses_content_image) }}"
                                                    class="main-item-detail-image">
                                            @else
                                                <img src="{{ asset('backend/images/content_type/no_photo.jpeg') }}"
                                                    class="main-item-detail-image">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="item-detial-main">
                                        <span class="title-item-detail">
                                            Management
                                        </span>
                                        <div class="main-item-manage">
                                            <div class="section-">
                                                <button type="button"
                                                    onclick="updateCoursesContent({{ $coursesContent->courses_content_id }})"
                                                    class="btn btn-info "><i class="far fa-edit"></i></button>
                                            </div>
                                            <div class="section-d">
                                                <button
                                                    onclick="deleteCoursesContent({{ $coursesContent->courses_content_id }})"
                                                    class="btn btn-danger "><i class="far fa-trash-alt"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach