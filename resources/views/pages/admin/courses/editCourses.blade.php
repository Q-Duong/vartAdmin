@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Update Courses
                    <span class="tools pull-right">
                        <a href="{{ route('listCourses') }}" class="primary-btn-submit">Management</a>
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form action="{{ route('updateCourses', $courses->courses_id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Themes</label>
                                <select name="courses_themes" class="input-control">
                                    <option {{ $courses->courses_themes == 1 ? 'selected' : '' }} value="1">1</option>
                                    <option {{ $courses->courses_themes == 2 ? 'selected' : '' }} value="2">2</option>
                                </select>
                            </div>
                            <div class="form-group {{ $errors->has('courses_title') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Courses Title</label>
                                <input type="text" name="courses_title" class="input-control" placeholder="Courses Title"
                                    id="slug" onkeyup="ChangeToSlug();" value="{{ $courses->courses_title }}">
                                {!! $errors->first(
                                    'courses_title',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('courses_slug') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Courses Slug</label>
                                <input type="text" name="courses_slug" class="input-control" id="convert_slug"
                                    value="{{ $courses->courses_slug }}" readonly>
                                {!! $errors->first(
                                    'courses_slug',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Courses Image</label>
                                <input type="file" name="courses_image" class="input-control">
                                <img class="img-fluid" src="{{ asset('storeimages/courses/' . $courses->courses_image) }}"
                                    alt="">
                            </div>
                            <div class="form-group {{ $errors->has('courses_content') ? 'has-error' : '' }}">
                                <label for="exampleInputPassword1">Courses Content</label>
                                <textarea name="courses_content" rows=8 class="textarea-control" id="editor2">{{ $courses->courses_content }}</textarea>
                                {!! $errors->first(
                                    'courses_content',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('courses_programs') ? 'has-error' : '' }}">
                                <label for="exampleInputPassword1">Courses Programs</label>
                                <textarea name="courses_programs" rows=8 class="textarea-control" id="editor3">{{ $courses->courses_programs }}</textarea>
                                {!! $errors->first(
                                    'courses_programs',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <button type="submit" class="primary-btn-submit">Update</button>
                        </form>
                    </div>
                </div>
            </section>

            <section class="panel">
                <header class="panel-heading">
                    Courses Content
                    <span class="tools pull-right">
                        <a href="javascript:;" onclick="addCoursesContent()" class="primary-btn-submit">Add Courses
                            Content</a>
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body list-courses-content">
                    @foreach ($getAllCoursesContent as $key => $coursesContent)
                        <div class=" form-group item-detail">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="item-detial-main">
                                        <input type="hidden"
                                            class="courses_content_id_{{ $coursesContent->courses_content_id }}"
                                            value="{{ $coursesContent->courses_content_id }}">
                                        <span class="title-item-detail">
                                            CC Type
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
                                            CC Title
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
                                            CC Text
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
                                            CC Image
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
                </div>
            </section>
            {{-- Review Popup --}}
            <div class="popup-model-review">
                <div class="overlay-model-review"></div>
                <div class="model-review-content">
                    <div class="model-review-close">
                        <p class="model-review-tile">Courses Content</p>
                        <p class="close-model"><i class="fas fa-times"></i></p>
                    </div>
                    <div class="panel-body">
                        <form id="courses_content">
                            @csrf
                            <input type="hidden" name="courses_id" value="{{ $courses->courses_id }}">
                            <input type="hidden" name="courses_content_id">
                            <div class="form-group">
                                <label>Courses Content Type</label>
                                <select name="courses_content_type" class="input-control courses_content_type">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Courses Content Title</label>
                                <input type="text" name="courses_content_title" class="input-control">
                            </div>
                            <div class="form-group">
                                <label>Courses Content Text</label>
                                <textarea name="courses_content_text" rows=8 class="textarea-control" id="editor1"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Courses Content Image</label>
                                <input type="file" name="courses_content_image" class="input-control">
                                <div class="img-thumb"></div>
                            </div>
                            <div class="btn-courses-content">
                                <button type="button" class="primary-btn-submit add-courses-content">
                                    Add Courses Content
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
        var url_add_courses_content = "{{ Route('addCoursesContent') }}";
        var url_load_courses_content = "{{ Route('loadCoursesContent') }}";
        var url_update_courses_content = "{{ Route('updateCoursesContent') }}";
        var url_del_courses_content = "{{ Route('deleteCoursesContent', ':id') }}";
        var assetImg = "{{ asset('storeimages/coursescontent/') }}";

        function clearForm() {
            $('.popup-model-review').fadeOut(300);
            $("#courses_content")[0].reset();
            $(".img-thumb").html('');
            editor1.setData("");
        }

        function loadCoursesContent() {
            var courses_id = $('input[name="courses_id"]').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: url_load_courses_content,
                method: "POST",
                data: {
                    courses_id: courses_id,
                    _token: _token
                },
                success: function(data) {
                    $('.list-courses-content').html(data.html);
                }
            });
        }

        function addCoursesContent() {
            clearForm();
            $('.popup-model-review').fadeIn(300);
            $('.model-review-tile').html('Add Courses Content');
            $('.btn-courses-content').html(
                '<button type="button" class="primary-btn-submit add-courses-content">Add Courses Content</button>');
        }

        function updateCoursesContent(e) {
            $('.popup-model-review').fadeIn(300);
            $('.model-review-tile').html('Update Courses Content');
            $('.btn-courses-content').html(
                '<button type="button" class="primary-btn-submit update-courses-content">Update Courses Content</button>'
            );
            $(".courses_content_type").val($('.courses_content_type_' + e).val()).change();
            $('input[name="courses_content_title"]').val($('.courses_content_title_' + e).val());
            $('input[name="courses_content_id"]').val($('.courses_content_id_' + e).val());
            var courses_content_image = $(".courses_content_image_" + e).val();
            if (courses_content_image != '') {
                var html = '<img src="' + assetImg + '/' + courses_content_image + '" class="main-item-detail-image">';
                $(".img-thumb").html(html);
            } else {
                $(".img-thumb").html('');
            }
            editor1.setData($('.courses_content_text_' + e).html());
        };

        function deleteCoursesContent(e) {
            var courses_content_id = e;
            var _token = $('input[name="_token"]').val();
            url_del_courses_content = url_del_courses_content.replace(":id", courses_content_id);
            $.ajax({
                url: url_del_courses_content,
                type: 'DELETE',
                data: {
                    _token: _token
                },
                success: function(data) {
                    url_del_courses_content = url_del_courses_content.replace(courses_content_id, ":id");
                    successMsg(data.message);
                    loadCoursesContent();
                }
            });
        };
        $(document).on("click", ".add-courses-content", function() {
            var formData = new FormData($("#courses_content")[0]);
            formData.append('courses_content_text', editor1.getData());
            $.ajax({
                url: url_add_courses_content,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    successMsg(data.message);
                    loadCoursesContent();
                    clearForm();
                },
            });
        });
        $(document).on("click", ".update-courses-content", function() {
            var formData = new FormData($("#courses_content")[0]);
            formData.append('courses_content_text', editor1.getData());
            $.ajax({
                url: url_update_courses_content,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    successMsg(data.message);
                    loadCoursesContent();
                    clearForm();
                },
            });
        });
    </script>
@endpush
