@extends('layouts.default_auth')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Update Hart
                    <span class="tools pull-right">
                        <a href="{{ route('listHart') }}" class="primary-btn-submit">Management</a>
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form action="{{ Route('updateHart', $hart->hart_id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group {{ $errors->has('hart_title') ? 'has-error' : '' }}">
                                <label>Hart Title</label>
                                <input type="text" name="hart_title" class="input-control" placeholder="Enter Hart Title"
                                    id="slug" onkeyup="ChangeToSlug();" value="{{ $hart->hart_title }}">
                                {!! $errors->first(
                                    'hart_title',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('hart_slug') ? 'has-error' : '' }}">
                                <label>Hart Slug</label>
                                <input type="text" name="hart_slug" class="input-control" id="convert_slug"
                                    value="{{ $hart->hart_slug }}" readonly>
                                {!! $errors->first(
                                    'hart_slug',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hart Image</label>
                                <input type="file" name="hart_image" class="input-control">
                                <img class="img-fluid" src="{{ asset('storeimages/hart/' . $hart->hart_image) }}"
                                    alt="">
                            </div>
                            <button type="submit" class="primary-btn-submit">Update Hart</button>
                        </form>
                    </div>
                </div>
            </section>

            <section class="panel">
                <header class="panel-heading">
                    Hart Content
                    <span class="tools pull-right">
                        <a href="javascript:;" onclick="addHartContent()" class="primary-btn-submit">Add Hart
                            Content</a>
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body list-hart-content">
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
                                            <input type="hidden"
                                                class="hart_content_title_{{ $hartContent->hart_content_id }}"
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
                                            <input type="hidden"
                                                class="hart_content_image_{{ $hartContent->hart_content_id }}"
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
                                                <button type="button"
                                                    onclick="updateHartContent({{ $hartContent->hart_content_id }})"
                                                    class="btn btn-info "><i class="far fa-edit"></i></button>
                                            </div>
                                            <div class="section-d">
                                                <button
                                                    onclick="deleteHartContent({{ $hartContent->hart_content_id }})"
                                                    class="btn btn-danger "><i class="far fa-trash-alt"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            {{-- Review Popup --}}
            <div class="popup-model-review">
                <div class="overlay-model-review"></div>
                <div class="model-review-content">
                    <div class="model-review-close">
                        <p class="model-review-tile">Hart Content</p>
                        <p class="close-model"><i class="fas fa-times"></i></p>
                    </div>
                    <div class="panel-body">
                        <form id="hart_content">
                            @csrf
                            <input type="hidden" name="hart_id" value="{{ $hart->hart_id }}">
                            <input type="hidden" name="hart_content_id">
                            {{-- <div class="form-group">
                                <label>Courses Content Type</label>
                                <select name="courses_content_type" class="input-control courses_content_type">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div> --}}
                            <div class="form-group">
                                <label>Hart Content Title</label>
                                <input type="text" name="hart_content_title" class="input-control">
                            </div>
                            <div class="form-group">
                                <label>Hart Content Text</label>
                                <textarea name="hart_content_text" rows=8 class="textarea-control" id="editor1"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Hart Content Image</label>
                                <input type="file" name="hart_content_image" class="input-control">
                                <div class="img-thumb"></div>
                            </div>
                            <div class="btn-hart-content">
                                <button type="button" class="primary-btn-submit add-hart-content">
                                    Add Hart Content
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--End Review Popup -->
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ versionResource('backend/js/ckeditor/ckeditor.min.js') }}" defer></script>
    <script src="{{ versionResource('backend/js/ckeditor/ckeditor-custom.js') }}" defer></script>
    <script type="text/javascript" defer>
        var url_add_hart_content = "{{ Route('addHartContent') }}";
        var url_load_hart_content = "{{ Route('loadHartContent') }}";
        var url_update_hart_content = "{{ Route('updateHartContent') }}";
        var url_del_hart_content = "{{ Route('deleteHartContent', ':id') }}";
        var assetImg = "{{ asset('storeimages/hart/hartcontent/') }}";

        function clearForm() {
            $('.popup-model-review').fadeOut(300);
            $("#hart_content")[0].reset();
            $(".img-thumb").html('');
            editor1.setData("");
        }

        function loadHartContent() {
            var hart_id = $('input[name="hart_id"]').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: url_load_hart_content,
                method: "POST",
                data: {
                    hart_id: hart_id,
                    _token: _token
                },
                success: function(data) {
                    $('.list-hart-content').html(data.html);
                }
            });
        }

        function addHartContent() {
            clearForm();
            $('.popup-model-review').fadeIn(300);
            $('.model-review-tile').html('Add Hart Content');
            $('.btn-hart-content').html(
                '<button type="button" class="primary-btn-submit add-hart-content">Add Hart Content</button>');
        }

        function updateHartContent(e) {
            $('.popup-model-review').fadeIn(300);
            $('.model-review-tile').html('Update Hart Content');
            $('.btn-hart-content').html(
                '<button type="button" class="primary-btn-submit update-hart-content">Update Hart Content</button>'
            );
            // $(".hart_content_themes").val($('.courses_content_type_' + e).val()).change();
            $('input[name="hart_content_title"]').val($('.hart_content_title_' + e).val());
            $('input[name="hart_content_id"]').val($('.hart_content_id_' + e).val());
            var hart_content_image = $(".hart_content_image_" + e).val();
            if (hart_content_image != '') {
                var html = '<img src="' + assetImg + '/' + hart_content_image + '" class="main-item-detail-image">';
                $(".img-thumb").html(html);
            } else {
                $(".img-thumb").html('');
            }
            editor1.setData($('.hart_content_text_' + e).html());
        };

        function deleteHartContent(e) {
            var hart_content_id = e;
            var _token = $('input[name="_token"]').val();
            url_del_hart_content = url_del_hart_content.replace(":id", hart_content_id);
            $.ajax({
                url: url_del_hart_content,
                type: 'DELETE',
                data: {
                    _token: _token
                },
                success: function(data) {
                    url_del_hart_content = url_del_hart_content.replace(hart_content_id, ":id");
                    successMsg(data.message);
                    loadHartContent();
                }
            });
        };
        $(document).on("click", ".add-hart-content", function() {
            var formData = new FormData($("#hart_content")[0]);
            formData.append('hart_content_text', editor1.getData());
            $.ajax({
                url: url_add_hart_content,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    successMsg(data.message);
                    loadHartContent();
                    clearForm();
                },
            });
        });
        $(document).on("click", ".update-hart-content", function() {
            var formData = new FormData($("#hart_content")[0]);
            formData.append('hart_content_text', editor1.getData());
            $.ajax({
                url: url_update_hart_content,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    successMsg(data.message);
                    loadHartContent();
                    clearForm();
                },
            });
        });
    </script>
@endpush
