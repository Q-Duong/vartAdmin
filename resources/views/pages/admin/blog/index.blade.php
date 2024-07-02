@extends('layouts.default_auth')
@section('content')
    <div class="table-agile-info">
        <div class="panel-heading">
            Liệt kê bài viết
        </div>
        <div class="table-responsive table-content">
            <table class="table table-striped b-t b-light" id="myTable">
                <thead>
                    <tr>
                        <th>Tên bài viết</th>
                        <th>Slug bài viết</th>
                        <th>Hình sản phẩm</th>
                        <th>Danh mục bài viết</th>
                        <th style="width:60px;">Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getAllBlog as $key => $blog)
                        <tr>
                            <td>{{ $blog->blog_title }}</td>
                            <td>{{ $blog->blog_slug }}</td>
                            <td><img class="img-fluid" src="{{ asset('storeimages/blog/' . $blog->blog_image) }}"
                                    alt="">
                            </td>
                            <td>{{ $blog->blog_category->blog_category_name }}</td>
                            <td>
                                <a href="{{ Route('blog.edit', $blog->id) }}" class="active style-edit" ui-toggle-class=""><i
                                        class="fa fa-pencil-square-o text-success text-active"></i>
                                </a>
                                <form action="{{ Route('blog.destroy', $blog->id) }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="management-btn button-submit"><i
                                            class="fa fa-times text-danger text"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ versionResource('backend/js/datatables/jquery.dataTables.min.js') }}" defer></script>
    <script type="text/javascript" defer>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endpush
