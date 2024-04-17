@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel-heading">
            Manager Blog Category
        </div>
        <div class="table-responsive table-content">
            <table class="table table-striped b-t b-light" id="myTable">
                <thead>
                    <tr>
                        <th>Tên danh mục bài viết</th>
                        <th>Slug danh mục bài viết</th>
                        <th style="width:60px;">Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getAllBlogCategory as $key => $blogCategory)
                        <tr>
                            <td>{{ $blogCategory->blog_category_name }}</td>
                            <td>{{ $blogCategory->blog_category_slug }}</td>
                            <td>
                                <a href="{{ route('editBlogCategory', $blogCategory->blog_category_id) }}"
                                    class="active style-edit" ui-toggle-class=""><i
                                        class="fa fa-pencil-square-o text-success text-active"></i>
                                </a>
                                <a onclick="return confirm('Nếu bạn xóa Danh mục tin tức thì tin túc thuộc danh mục cũng sẻ bị xóa. Bạn có chắc muốn xóa danh mục?')"
                                    href="{{ route('deleteBlogCategory', $blogCategory->blog_category_id) }}"
                                    class="active style-edit" ui-toggle-class="">
                                    <i class="fa fa-times text-danger text"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ versionResource('backend/js/datatables/jquery.dataTables.min.js') }}" defer ></script>
    <script type="text/javascript" defer>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endpush