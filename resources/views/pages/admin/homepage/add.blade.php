@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Add
                    <span class="tools pull-right">
                        <a href="{{ Route('listHomePage') }}" class="primary-btn-submit">Manage</a>
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form action="{{ Route('saveHomePage') }}" method="post" enctype="multipart/form-data" id="post">
                            @csrf
                            <div class="form-group {{ $errors->has('home_page_title') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" name="home_page_title" class="input-control"
                                    placeholder="Điền tên bài viết"
                                    value="{{ old('home_page_title') }}">
                                {!! $errors->first(
                                    'home_page_title',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('blog_slug') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Slug bài viết</label>
                                <input type="text" name="blog_slug" class="input-control"
                                    placeholder="Điền Slug bài viết" id="convert_slug" value="{{ old('blog_slug') }}"
                                    readonly>
                                {!! $errors->first(
                                    'blog_slug',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('blog_image') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Hình ảnh bài viết</label>
                                <input type="file" name="blog_image" class="input-control"
                                    value="{{ old('blog_image') }}">
                                {!! $errors->first(
                                    'blog_image',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('blog_content') ? 'has-error' : '' }}">
                                <label for="exampleInputPassword1">Nội dung bài viết</label>
                                <textarea name="blog_content" class="textarea-control" id="editor" placeholder="Điền nội dung bài viết">
                                {{ old('blog_content') }}
                            </textarea>
                                {!! $errors->first(
                                    'blog_content',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Danh mục bài viết</label>
                                <select name="blog_category_id" class="input-control">
                                    @foreach ($getAllBlogCategory as $key => $blogCategory)
                                        <option value="{{ $blogCategory->blog_category_id }}">{{ $blogCategory->blog_category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="primary-btn-submit">Thêm bài viết</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ versionResource('backend/js/ckeditor/ckeditor.min.js') }}" defer></script>
    <script src="{{ versionResource('backend/js/ckeditor/ckeditor-custom.min.js') }}" defer></script>
@endpush
