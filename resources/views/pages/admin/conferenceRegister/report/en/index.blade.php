@extends('layouts.default_auth')
@section('title', __('conference.en.en_report_title') . ' - ')
@section('content')
    <div class="table-agile-info">
        <div class="panel-heading">
            @lang('conference.en.en_report_title')
        </div>
        <div class="table-responsive table-content">
            <table class="table table-striped b-t b-light table-bordered">
                <thead>
                    <tr>
                        <th>@lang('conference.en.create')</th>
                        <th>@lang('conference.en.id')</th>
                        <th>@lang('conference.en.code')</th>
                        <th>@lang('conference.en.title.title')</th>
                        <th>@lang('conference.en.firstname')</th>
                        <th>@lang('conference.en.lastname')</th>
                        <th>@lang('conference.en.date')</th>
                        <th>@lang('conference.en.month')</th>
                        <th>@lang('conference.en.year')</th>
                        <th>@lang('conference.en.email')</th>
                        <th>@lang('conference.en.profession.profession')</th>
                        <th>@lang('conference.en.organization')</th>
                        <th>@lang('conference.en.department')</th>
                        <th>@lang('conference.en.country')</th>
                        <th>@lang('conference.en.topics')</th>
                        <th>@lang('conference.en.file_title')</th>
                        <th>@lang('conference.en.file')</th>
                        <th>@lang('conference.en.share')</th>
                        <th>@lang('conference.en.status.status')</th>
                        <th>@lang('conference.en.management')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getAllConferenceReportInternational as $key => $en_report)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($en_report->created_at)->format('H:i:s d/m/Y') }}</td>
                            <td>{{ $en_report->id }}</td>
                            <td>{{ $en_report->en_report_code }}</td>
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
                            <td>{{ $en_report->topic_title_en }}</td>
                            <td>{{ $en_report->en_report_file_title }}</td>
                            <td>
                                @if($en_report->en_report_file)
                                    <a href="https://drive.google.com/file/d/{{ $en_report->en_report_file }}/view"
                                        target="_blank">
                                        @lang('conference.en.link')
                                    </a>
                                @endif
                            </td>
                            <td>{{ $en_report->en_report_share == 1 ? '<span style="color: #27c24c;">Agree</span>' : '<span style="color: #e53637;">Disagree</span>' }}</td>
                            <td>
                                @if ($en_report->en_report_status == 1)
                                    <span style="color: #27c24c;">@lang('conference.en.status.step1')</span>
                                @elseif ($en_report->en_report_status == 2)
                                    <span style="color: #FCB322;">@lang('conference.en.status.step3')</span>
                                @else
                                    <span style="color: #0071e3;">@lang('conference.en.status.step4')</span>
                                @endif
                            </td>
                            <td class="management">
                                <a href="{{ Route('conference_en_report.edit', [$conference->conference_code, $en_report->id]) }}"
                                    class="management-btn" title="@lang('vart_define.button.update')"><i
                                        class="fa fa-pencil-square-o text-success text-active"></i>
                                </a>
                                <form action="{{ Route('conference_en_report.destroy', $en_report->id) }}"
                                    method="POST" id="delete-form">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="management-btn button-delete" title="@lang('vart_define.button.delete')"><i
                                            class="fa fa-times text-danger text"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $getAllConferenceReportInternational->links('pagination::bootstrap-4') }}
        <div class="export-excel">
            <form action="{{ route('export.excel') }}" method="POST">
                @csrf
                <input type="hidden" name="conference_id" value="{{ $conference->id }}">
                <input type="hidden" name="export_type" value="enrp">
                <div class="col-md-3">
                    <button type="submit" class="primary-btn-filter">@lang('conference.en.export_excel')</button>
                </div>
            </form>
        </div>
    </div>
@endsection
