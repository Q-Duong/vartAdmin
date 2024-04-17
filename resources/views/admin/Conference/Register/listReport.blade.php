@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel-heading">
            Conference Report List
        </div>
        <div class="table-responsive table-content">
            <table class="table table-striped b-t b-light table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Học vị</th>
                        <th>Họ và tên</th>
                        <th>Giới tính</th>
                        <th>Ngày sinh</th>
                        <th>Thánh sinh</th>
                        <th>Năm sinh</th>
                        <th>Đơn vị</th>
                        <th>Nơi sinh</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Năm tốt nghiệp trên bằng</th>
                        <th>Ảnh bằng đại học</th>
                        <th>Ảnh thẻ sinh viên</th>
                        <th>Bài báo cáo</th>
                        <th>Trạng thái</th>
                        <th style="width:60px;">Management</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getAllConferenceReport as $key => $report)
                        <tr>
                            <td>{{ $report->report_id }}</td>
                            <td>{{ $report->report_degree }}</td>
                            <td>{{ $report->report_name }}</td>
                            <td>{{ $report->report_gender == 0 ? 'Nam' : 'Nữ' }}</td>
                            <td>{{ $report->report_date }}</td>
                            <td>{{ $report->report_month }}</td>
                            <td>{{ $report->report_year }}</td>
                            <td>{{ $report->report_work_unit }}</td>
                            <td>{{ $report->report_place_of_birth }}</td>
                            <td>{{ $report->report_email }}</td>
                            <td>{{ $report->report_phone }}</td>
                            <td>{{ $report->report_graduation_year }}</td>
                            <td>
                                @if ($report->report_image)
                                    <a href="https://drive.google.com/file/d/{{ $report->report_image }}/view"
                                        target="_blank">
                                        Link
                                    </a>
                                @endif
                            </td>
                            <td>
                                @if ($report->report_image_card)
                                    <a href="https://drive.google.com/file/d/{{ $report->report_image_card }}/view"
                                        target="_blank">
                                        Link
                                    </a>
                                @endif
                            </td>
                            <td>
                                @if ($report->report_file)
                                    <a href="https://drive.google.com/file/d/{{ $report->report_file }}/view"
                                        target="_blank">
                                        Link
                                    </a>
                                @endif
                            </td>
                            <td>
                                @if ($report->report_status == 1)
                                    <span style="color: #27c24c;">Chờ kiểm tra</span>
                                @elseif ($report->report_status == 2)
                                    <span style="color: #FCB322;">Đã kiểm tra</span>
                                @else
                                    <span style="color: #0071e3;">Đã kiểm tra và gửi mail</span>
                                @endif
                            </td>
                            <td class="management">
                                <a href="{{ Route('editConferenceReport', $report->report_id) }}" class="management-btn"><i
                                        class="fa fa-pencil-square-o text-success text-active"></i>
                                </a>
                                <form action="{{ Route('deleteConferenceReport', $report->report_id) }}" method="POST">
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
        {{ $getAllConferenceReport->links('pagination::bootstrap-4') }}
        <div class="export-excel">
            <form action="{{ route('export-excel') }}" method="POST">
                @csrf
                <input type="hidden" name="conference_id" value="{{ $conference_id }}">
                <input type="hidden" name="export_type" value="vnrp">
                <div class="col-md-3">
                    <button type="submit" class="primary-btn-filter">Export Excel</button>
                </div>
            </form>
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