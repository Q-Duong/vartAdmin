@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel-heading">
            List
        </div>
        <div class="table-responsive table-content">
            <table class="table table-striped b-t b-light" id="myTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Image</th>
                        <th style="width:60px;">Management</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getAllCourses as $key => $courses)
                        <tr>
                            <td>{{ $courses->courses_title }}</td>
                            <td>{{ $courses->courses_slug }}</td>
                            <td><img class="img-fluid" src="{{ asset('storeimages/courses/' . $courses->courses_image) }}"
                                    alt="">
                            </td>
                            <td>
                                <a href="{{ route('editCourses', $courses->courses_id) }}" class="active style-edit"
                                    ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i>
                                </a>
                                <a onclick="return confirm('Bạn có chắc muốn xóa bài viết?')"
                                    href="{{ route('deleteCourses', $courses->courses_id) }}" class="active style-edit"
                                    ui-toggle-class="">
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
    <script src="{{ versionResource('backend/js/datatables/jquery.dataTables.min.js') }}" defer></script>
    <script type="text/javascript" defer>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endpush
