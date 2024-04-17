@foreach ($getAllVartContent as $key => $vartContent)
    <div class=" form-group item-detail">
        <div class="row">
            <input type="hidden" class="vart_content_id_{{ $vartContent->vart_content_id }}"
                value="{{ $vartContent->vart_content_id }}">
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
                        Vart Content Title
                    </span>
                    <div class="main-item-detail">
                        <input type="hidden" class="vart_content_title_{{ $vartContent->vart_content_id }}"
                            value="{{ $vartContent->vart_content_title }}">
                        {{ $vartContent->vart_content_title }}
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="item-detial-main">
                    <span class="title-item-detail">
                        Vart Content Text
                    </span>
                    <div class="main-item-detail vart_content_text_{{ $vartContent->vart_content_id }}">
                        {!! $vartContent->vart_content_text !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="item-detial-main">
                    <span class="title-item-detail">
                        Vart Content Image
                    </span>
                    <div class="main-item-img">
                        <input type="hidden" class="vart_content_image_{{ $vartContent->vart_content_id }}"
                            value="{{ $vartContent->vart_content_image }}">
                        @if ($vartContent->vart_content_image)
                            <img src="{{ asset('storeimages/vart/vartcontent/' . $vartContent->vart_content_image) }}"
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
                            <button type="button" onclick="updateVartContent({{ $vartContent->vart_content_id }})"
                                class="btn btn-info "><i class="far fa-edit"></i></button>
                        </div>
                        <div class="section-d">
                            <button onclick="deleteVartContent({{ $vartContent->vart_content_id }})"
                                class="btn btn-danger "><i class="far fa-trash-alt"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
