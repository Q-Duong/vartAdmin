@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Update Vart
                    <span class="tools pull-right">
                        <a href="{{ route('listVart') }}" class="primary-btn-submit">Management</a>
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form action="{{ Route('updateVart', $vart->vart_id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group {{ $errors->has('vart_title') ? 'has-error' : '' }}">
                                <label>Vart Title</label>
                                <input type="text" name="vart_title" class="input-control" placeholder="Enter Vart Title"
                                    id="slug" onkeyup="ChangeToSlug();" value="{{ $vart->vart_title }}">
                                {!! $errors->first(
                                    'vart_title',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('vart_slug') ? 'has-error' : '' }}">
                                <label>Vart Slug</label>
                                <input type="text" name="vart_slug" class="input-control" id="convert_slug"
                                    value="{{ $vart->vart_slug }}" readonly>
                                {!! $errors->first(
                                    'vart_slug',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Vart Image</label>
                                <input type="file" name="vart_image" class="input-control">
                                <img class="img-fluid" src="{{ asset('storeimages/vart/' . $vart->vart_image) }}"
                                    alt="">
                            </div>
                            <button type="submit" class="primary-btn-submit">Update Vart</button>
                        </form>
                    </div>
                </div>
            </section>

            <section class="panel">
                <header class="panel-heading">
                    Vart Content
                    <span class="tools pull-right">
                        <a href="javascript:;" onclick="addVartContent()" class="primary-btn-submit">Add Vart
                            Content</a>
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body list-vart-content">
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
                                            <input type="hidden"
                                                class="vart_content_title_{{ $vartContent->vart_content_id }}"
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
                                            <input type="hidden"
                                                class="vart_content_image_{{ $vartContent->vart_content_id }}"
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
                                                <button type="button"
                                                    onclick="updateVartContent({{ $vartContent->vart_content_id }})"
                                                    class="btn btn-info "><i class="far fa-edit"></i></button>
                                            </div>
                                            <div class="section-d">
                                                <button
                                                    onclick="deleteVartContent({{ $vartContent->vart_content_id }})"
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
                        <p class="model-review-tile">Vart Content</p>
                        <p class="close-model"><i class="fas fa-times"></i></p>
                    </div>
                    <div class="panel-body">
                        <form id="vart_content">
                            @csrf
                            <input type="hidden" name="vart_id" value="{{ $vart->vart_id }}">
                            <input type="hidden" name="vart_content_id">
                            {{-- <div class="form-group">
                                <label>Courses Content Type</label>
                                <select name="courses_content_type" class="input-control courses_content_type">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div> --}}
                            <div class="form-group">
                                <label>Vart Content Title</label>
                                <input type="text" name="vart_content_title" class="input-control">
                            </div>
                            <div class="form-group">
                                <label>Vart Content Text</label>
                                <textarea name="vart_content_text" rows=8 class="textarea-control" id="editor1"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Vart Content Image</label>
                                <input type="file" name="vart_content_image" class="input-control">
                                <div class="img-thumb"></div>
                            </div>
                            <div class="btn-vart-content">
                                <button type="button" class="primary-btn-submit add-vart-content">
                                    Add Vart Content
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
        var url_add_vart_content = "{{ Route('addVartContent') }}";
        var url_load_vart_content = "{{ Route('loadVartContent') }}";
        var url_update_vart_content = "{{ Route('updateVartContent') }}";
        var url_del_vart_content = "{{ Route('deleteVartContent', ':id') }}";
        var assetImg = "{{ asset('storeimages/vart/vartcontent/') }}";

        function clearForm() {
            $('.popup-model-review').fadeOut(300);
            $("#vart_content")[0].reset();
            $(".img-thumb").html('');
            editor1.setData("");
        }

        function loadVartContent() {
            var vart_id = $('input[name="vart_id"]').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: url_load_vart_content,
                method: "POST",
                data: {
                    vart_id: vart_id,
                    _token: _token
                },
                success: function(data) {
                    $('.list-vart-content').html(data.html);
                }
            });
        }

        function addVartContent() {
            clearForm();
            $('.popup-model-review').fadeIn(300);
            $('.model-review-tile').html('Add Vart Content');
            $('.btn-vart-content').html(
                '<button type="button" class="primary-btn-submit add-vart-content">Add Vart Content</button>');
        }

        function updateVartContent(e) {
            $('.popup-model-review').fadeIn(300);
            $('.model-review-tile').html('Update Vart Content');
            $('.btn-vart-content').html(
                '<button type="button" class="primary-btn-submit update-vart-content">Update Vart Content</button>'
            );
            // $(".vart_content_themes").val($('.courses_content_type_' + e).val()).change();
            $('input[name="vart_content_title"]').val($('.vart_content_title_' + e).val());
            $('input[name="vart_content_id"]').val($('.vart_content_id_' + e).val());
            var vart_content_image = $(".vart_content_image_" + e).val();
            if (vart_content_image != '') {
                var html = '<img src="' + assetImg + '/' + vart_content_image + '" class="main-item-detail-image">';
                $(".img-thumb").html(html);
            } else {
                $(".img-thumb").html('');
            }
            editor1.setData($('.vart_content_text_' + e).html());
        };

        function deleteVartContent(e) {
            var vart_content_id = e;
            var _token = $('input[name="_token"]').val();
            url_del_vart_content = url_del_vart_content.replace(":id", vart_content_id);
            $.ajax({
                url: url_del_vart_content,
                type: 'DELETE',
                data: {
                    _token: _token
                },
                success: function(data) {
                    url_del_vart_content = url_del_vart_content.replace(vart_content_id, ":id");
                    successMsg(data.message);
                    loadVartContent();
                }
            });
        };
        $(document).on("click", ".add-vart-content", function() {
            var formData = new FormData($("#vart_content")[0]);
            formData.append('vart_content_text', editor1.getData());
            $.ajax({
                url: url_add_vart_content,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    successMsg(data.message);
                    loadVartContent();
                    clearForm();
                },
            });
        });
        $(document).on("click", ".update-vart-content", function() {
            var formData = new FormData($("#vart_content")[0]);
            formData.append('vart_content_text', editor1.getData());
            $.ajax({
                url: url_update_vart_content,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    successMsg(data.message);
                    loadVartContent();
                    clearForm();
                },
            });
        });
    </script>
@endpush
