@foreach ($getAllHartContent as $key => $hartContent)
    <div class=" form-group item-detail">
        <div class="row">
            <input type="hidden" class="hart_content_id_{{ $hartContent->hart_content_id }}"
                value="{{ $hartContent->hart_content_id }}">
            {{-- <div class="col-lg-2">
                                    <div class="item-detial-main">
                                        
                                        <span class="title-item-detail">
                                            Vart Themes
                                        </span>
                                        <div class="main-item-img ">
                                            <input type="hidden"
                                                class="vart_content_themes_{{ $coursesContent->courses_content_id }}"
                                                value="{{ $coursesContent->vart_content_themes }}">
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
                                </div> --}}
            <div class="col-lg-2">
                <div class="item-detial-main">
                    <span class="title-item-detail">
                        Hart Content Title
                    </span>
                    <div class="main-item-detail">
                        <input type="hidden" class="hart_content_title_{{ $hartContent->hart_content_id }}"
                            value="{{ $hartContent->hart_content_title }}">
                        {{ $hartContent->hart_content_title }}
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="item-detial-main">
                    <span class="title-item-detail">
                        Hart Content Text
                    </span>
                    <div class="main-item-detail hart_content_text_{{ $hartContent->hart_content_id }}">
                        {!! $hartContent->hart_content_text !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="item-detial-main">
                    <span class="title-item-detail">
                        Hart Content Image
                    </span>
                    <div class="main-item-img">
                        <input type="hidden" class="hart_content_image_{{ $hartContent->hart_content_id }}"
                            value="{{ $hartContent->hart_content_image }}">
                        @if ($hartContent->hart_content_image)
                            <img src="{{ asset('storeimages/hart/hartcontent/' . $hartContent->hart_content_image) }}"
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
                            <button type="button" onclick="updateHartContent({{ $hartContent->hart_content_id }})"
                                class="btn btn-info "><i class="far fa-edit"></i></button>
                        </div>
                        <div class="section-d">
                            <button onclick="deleteHartContent({{ $hartContent->hart_content_id }})"
                                class="btn btn-danger "><i class="far fa-trash-alt"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
