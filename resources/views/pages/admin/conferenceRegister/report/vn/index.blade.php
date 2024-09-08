@extends('layouts.default_auth')
@section('title', __('conference.en.report_title') . ' - ')
@section('content')
    <div class="table-agile-info">
        <div class="panel-heading">
            @lang('conference.en.report_title')
        </div>
        <div class="table-responsive table-content">
            <table class="table table-striped b-t b-light table-bordered">
                <thead>
                    <tr>
                        <th>@lang('conference.en.create')</th>
                        <th>@lang('conference.en.id')</th>
                        <th>@lang('conference.en.code')</th>
                        <th>@lang('conference.en.degree')</th>
                        <th>@lang('conference.en.fullname')</th>
                        <th>@lang('conference.en.gender')</th>
                        <th>@lang('conference.en.date')</th>
                        <th>@lang('conference.en.month')</th>
                        <th>@lang('conference.en.year')</th>
                        <th>@lang('conference.en.unit')</th>
                        <th>@lang('conference.en.place_of_birth')</th>
                        <th>@lang('conference.en.email')</th>
                        <th>@lang('conference.en.phone')</th>
                        <th>@lang('conference.en.graduation_year')</th>
                        <th>@lang('conference.en.image')</th>
                        <th>@lang('conference.en.image_card')</th>
                        <th>@lang('conference.en.background')</th>
                        <th>@lang('conference.en.topics')</th>
                        <th>@lang('conference.en.file_title')</th>
                        <th>@lang('conference.en.file')</th>
                        <th>@lang('conference.en.share')</th>
                        <th>@lang('conference.en.status.status')</th>
                        <th>@lang('conference.en.management')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getAllConferenceReport as $key => $report)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($report->created_at)->format('H:i:s d/m/Y') }}</td>
                            <td>{{ $report->id }}</td>
                            <td>{{ $report->report_code }}</td>
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
                                        @lang('conference.en.link')
                                    </a>
                                @endif
                            </td>
                            <td>
                                @if ($report->report_image_card)
                                    <a href="https://drive.google.com/file/d/{{ $report->report_image_card }}/view"
                                        target="_blank">
                                        @lang('conference.en.link')
                                    </a>
                                @endif
                            </td>
                            <td>
                                @if ($report->report_file_background)
                                    <a href="https://drive.google.com/file/d/{{ $report->report_file_background }}/view"
                                        target="_blank">
                                        @lang('conference.en.background')
                                    </a>
                                @endif
                            </td>
                            <td>{{ $report->topic_title_en }}</td>
                            <td>{{ $report->report_file_title }}</td>
                            <td>
                                @if ($report->report_file)
                                    <a href="https://drive.google.com/file/d/{{ $report->report_file }}/view"
                                        target="_blank">
                                        @lang('conference.en.link')
                                    </a>
                                @endif
                            </td>
                            <td>{{ $report->report_share == 1 ? '<span style="color: #27c24c;">Agree</span>' : '<span style="color: #e53637;">Disagree</span>' }}</td>
                            <td>
                                @if ($report->report_status == 1)
                                    <span style="color: #27c24c;">@lang('conference.en.status.step1')</span>
                                @elseif ($report->report_status == 2)
                                    <span style="color: #FCB322;">@lang('conference.en.status.step3')</span>
                                @else
                                    <span style="color: #0071e3;">@lang('conference.en.status.step4')</span>
                                @endif
                            </td>
                            <td class="management">
                                <a href="{{ Route('conference_report.edit', [$conference->conference_code, $report->id]) }}" class="management-btn"
                                    title="@lang('vart_define.button.update')"><i
                                        class="fa fa-pencil-square-o text-success text-active"></i>
                                </a>
                                <form action="{{ Route('conference_report.destroy', $report->id) }}" method="POST" id="delete-form">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="management-btn button-delete"
                                        title="@lang('vart_define.button.delete')"><i class="fa fa-times text-danger text"></i></button>
                                </form>
                                <form action="{{ Route('mail.reply', $report->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="type" value="report">
                                    <button type="submit" class="management-btn button-submit" title="@lang('vart_define.button.mail')">
                                        <i class="far fa-envelope btn-mail"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $getAllConferenceReport->links('pagination::custom') }}
        <div class="export-excel">
            <form action="{{ route('export.excel') }}" method="POST">
                @csrf
                <input type="hidden" name="conference_id" value="{{ $conference->id }}">
                <input type="hidden" name="export_type" value="vnrp">
                <div class="col-md-3">
                    <button type="submit" class="primary-btn-filter">@lang('conference.en.export_excel')</button>
                </div>
            </form>
        </div>
    </div>
@endsection
