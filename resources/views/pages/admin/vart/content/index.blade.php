@foreach ($getAllVartContent as $key => $vartContent)
    <div class=" form-group item-detail">
        <div class="row">
            <input type="hidden" class="vart_content_id_{{ $vartContent->vart_content_id }}"
                value="{{ $vartContent->vart_content_id }}">
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
            <div class="col-lg-2">
                <div class="item-detial-main">
                    <span class="title-item-detail">
                        Vart Content Title En
                    </span>
                    <div class="main-item-detail">
                        <input type="hidden" class="vart_content_title_en_{{ $vartContent->vart_content_id }}"
                            value="{{ $vartContent->vart_content_title_en }}">
                        {{ $vartContent->vart_content_title_en }}
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
            <div class="col-lg-4">
                <div class="item-detial-main">
                    <span class="title-item-detail">
                        Vart Content Text En
                    </span>
                    <div class="main-item-detail vart_content_text_en_{{ $vartContent->vart_content_id }}">
                        {!! $vartContent->vart_content_text_en !!}
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
                            <img src="{{ asset('storage/' . $vartContent->vart_content_image) }}"
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
                        Vart Content Image En
                    </span>
                    <div class="main-item-img">
                        <input type="hidden" class="vart_content_image_en_{{ $vartContent->vart_content_id }}"
                            value="{{ $vartContent->vart_content_image_en }}">
                        @if ($vartContent->vart_content_image_en)
                            <img src="{{ asset('storage/' . $vartContent->vart_content_image_en) }}"
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
                                onclick="updateContent({{ $vartContent->vart_content_id }},'Update Vart Content')"
                                class="btn btn-info "><i class="far fa-edit"></i></button>
                        </div>
                        <div class="section-d">
                            <button onclick="deleteContent({{ $vartContent->vart_content_id }})"
                                class="btn btn-danger "><i class="far fa-trash-alt"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
