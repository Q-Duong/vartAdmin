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
                        <th>Title</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Birth date</th>
                        <th>Birth month</th>
                        <th>Birth year</th>
                        <th>Email</th>
                        <th>Profession</th>
                        <th>Organization</th>
                        <th>Department</th>
                        <th>Country</th>
                        <th>Title of abstract, paper</th>
                        <th>Abstract, paper</th>
                        <th>Status</th>
                        <th style="width:60px;">Management</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getAllConferenceReportInternational as $key => $en_report)
                        <tr>
                            <td>{{ $en_report->en_report_id }}</td>
                            <td>{{ $en_report->en_report_title }}</td>
                            <td>{{ $en_report->en_report_firstname }}</td>
                            <td>{{ $en_report->en_report_lastname }}</td>
                            <td>{{ $en_report->en_report_date }}</td>
                            <td>{{ $en_report->en_report_month }}</td>
                            <td>{{ $en_report->en_report_year }}</td>
                            <td>{{ $en_report->en_report_email }}</td>
                            <td>{{ $en_report->en_report_profession }}</td>
                            <td>{{ $en_report->en_report_organization }}</td>
                            <td>{{ $en_report->en_report_department }}</td>
                            <td>{{ $en_report->en_report_nationality }}</td>
                            <td>{{ $en_report->en_report_file_title }}</td>
                            <td>
                                <a href="https://drive.google.com/file/d/{{ $en_report->en_report_file }}/view"
                                    target="_blank">
                                    Link
                                </a>
                            </td>
                            <td>
                                @if ($en_report->en_report_status == 1)
                                    <span style="color: #27c24c;">Wait checking</span>
                                @elseif ($en_report->en_report_status == 2)
                                    <span style="color: #FCB322;">Processed</span>
                                @elseif ($en_report->en_report_status == 3)
                                    <span style="color: #0071e3;">Processed and sent mail</span>
                                @endif
                            </td>
                            <td class="management">
                                <a href="{{ Route('editConferenceReportInternational', $en_report->en_report_id) }}"
                                    class="management-btn" ui-toggle-class=""><i
                                        class="fa fa-pencil-square-o text-success text-active"></i>
                                </a>
                                <form action="{{ Route('deleteConferenceReportInternational', $en_report->en_report_id) }}"
                                    method="POST">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="management-btn button-submit"><i class="fa fa-times text-danger text"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $getAllConferenceReportInternational->links('pagination::bootstrap-4') }}
        <div class="export-excel">
            <form action="{{ route('export-excel') }}" method="POST">
                @csrf
                <input type="hidden" name="conference_id" value="{{ $conference_id }}">
                <input type="hidden" name="export_type" value="enrp">
                <div class="col-md-3">
                    <button type="submit" class="primary-btn-filter">Export Excel</button>
                </div>
            </form>
        </div>
    </div>
@endsection