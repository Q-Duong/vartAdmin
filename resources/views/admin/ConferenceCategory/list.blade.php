@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel-heading">
            List Conference Category
        </div>
        <div class="table-responsive table-content">
            <table class="table table-striped b-t b-light" id="myTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Conference Category Name</th>
                        <th>Conference Category Slug</th>
                        <th style="width:60px;">Management</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getAllConferenceCategory as $key => $conferenceCategory)
                        <tr>
                            <td>{{ $conferenceCategory->conference_category_id }}</td>
                            <td>{{ $conferenceCategory->conference_category_name }}</td>
                            <td>{{ $conferenceCategory->conference_category_slug }}</td>
                            <td>
                                <a href="{{ route('editConferenceCategory', $conferenceCategory->conference_category_id) }}"
                                    class="active style-edit" ui-toggle-class=""><i
                                        class="fa fa-pencil-square-o text-success text-active"></i>
                                </a>
                                <a onclick="return confirm('Nếu bạn xóa Danh mục tin tức thì tin túc thuộc danh mục cũng sẻ bị xóa. Bạn có chắc muốn xóa danh mục?')"
                                    href="{{ route('deleteConferenceCategory', $conferenceCategory->conference_category_id) }}"
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