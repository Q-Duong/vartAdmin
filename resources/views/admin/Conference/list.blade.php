@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel-heading">
            List Conference
        </div>
        <div class="table-responsive table-content">
            <table class="table table-striped b-t b-light" id="myTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Conference Category</th>
                        <th>Conference Type</th>
                        <th>Conference Code</th>
                        <th>Conference Title</th>
                        <th>Conference Title En</th>
                        <th>Conference Slug</th>
                        <th>Conference Image</th>
                        <th style="width:60px;">Management</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getAllConference as $key => $conference)
                        <tr>
                            <td>{{ $conference->conference_id }}</td>
                            <td>{{ $conference->conference_category->conference_category_name }}</td>
                            <td>{{ $conference->conference_type->conference_type_name }}</td>
                            <td>{{ $conference->conference_code }}</td>
                            <td>{{ $conference->conference_title }}</td>
                            <td>{{ $conference->conference_title_en }}</td>
                            <td>{{ $conference->conference_slug }}</td>
                            <td>
                                <img class="img-fluid"
                                    src="{{ asset('storeimages/conference/' . $conference->conference_image) }}"
                                    alt="">
                            </td>
                            <td>
                                <a href="{{ Route('editConference', $conference->conference_id) }}" class="active style-edit"
                                    ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i>
                                </a>
                                <a onclick="return confirm('Nếu bạn xóa Danh mục tin tức thì tin túc thuộc danh mục cũng sẻ bị xóa. Bạn có chắc muốn xóa danh mục?')"
                                    href="{{ Route('deleteConference', $conference->conference_id) }}"
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
    <script src="{{ versionResource('backend/js/datatables/jquery.dataTables.min.js') }}" defer></script>
    <script type="text/javascript" defer>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endpush
