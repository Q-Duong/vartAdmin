@extends('layouts.default_auth')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật danh mục bài viết
                    <span class="tools pull-right">
                        <a href="{{ route('blog_category.index') }}" class="primary-btn-submit">List</a>
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form action="{{ route('blog_category.update', $blogCategory->blog_category_id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên danh mục bài viết</label>
                                <input type="text" name="blog_category_name" class="input-control" id="slug"
                                    placeholder="Điền tên danh mục bài viết" onkeyup="ChangeToSlug();"
                                    value="{{ $blogCategory->blog_category_name }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Slug danh mục bài viết</label>
                                <input type="text" name="blog_category_slug" class="input-control" id="convert_slug"
                                    placeholder="Điền Slug danh mục bài viết"
                                    value="{{ $blogCategory->blog_category_slug }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình ảnh </label>
                                <input type="file" name="blog_category_image" class="input-control"
                                    value="{{ old('blog_category_image') }}">
                                {!! $errors->first(
                                    'blog_category_image',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <button type="submit" class="primary-btn-submit">Cập nhật danh mục bài
                                viết</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
