@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Add Courses
                    <span class="tools pull-right">
                        <a href="{{ route('listCourses') }}" class="primary-btn-submit">Management</a>
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form action="{{ route('saveCourses') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Themes</label>
                                <select name="courses_themes" class="input-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                            <div class="form-group {{ $errors->has('courses_title') ? 'has-error' : '' }}">
                                <label>Courses Title</label>
                                <input type="text" name="courses_title" class="input-control" placeholder="Courses Title"
                                    id="slug" onkeyup="ChangeToSlug();" value="{{ old('courses_title') }}">
                                {!! $errors->first(
                                    'courses_title',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('courses_slug') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Courses Slug</label>
                                <input type="text" name="courses_slug" class="input-control" id="convert_slug"
                                    value="{{ old('courses_slug') }}" readonly>
                                {!! $errors->first(
                                    'courses_slug',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('courses_image') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Courses Image</label>
                                <input type="file" name="courses_image" class="input-control"
                                    value="{{ old('courses_image') }}">
                                {!! $errors->first(
                                    'courses_image',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('courses_content') ? 'has-error' : '' }}">
                                <label for="exampleInputPassword1">Courses Content</label>
                                <textarea name="courses_content" class="textarea-control" id="editor2">{{ old('courses_content') }}</textarea>
                                {!! $errors->first(
                                    'courses_content',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('courses_programs') ? 'has-error' : '' }}">
                                <label for="exampleInputPassword1">Courses Programs</label>
                                <textarea name="courses_programs" class="textarea-control" id="editor3">{{ old('courses_programs') }}</textarea>
                                {!! $errors->first(
                                    'courses_programs',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <button type="submit" class="primary-btn-submit">Add</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ versionResource('backend/js/ckeditor/ckeditor.min.js') }}" defer></script>
    <script src="{{ versionResource('backend/js/ckeditor/ckeditor-custom.js') }}" defer></script>
@endpush
