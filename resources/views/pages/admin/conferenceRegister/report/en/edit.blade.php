@extends('layouts.default_auth')
@section('title', __('vart_define.button.update') . ' ' . __('conference.en.en_report_title') . ' - ')
@push('css')
    <link rel="stylesheet" href="{{ versionResource('assets/styles/support/filepond.css') }}" type="text/css" as="style" />
    <link rel="stylesheet" href="{{ versionResource('assets/styles/support/filepond-preview.css') }}" type="text/css"
        as="style" />
    <link rel="stylesheet" href="{{ versionResource('assets/styles/landing/web/form.built.css') }}" type="text/css"
        as="style" />
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    @lang('vart_define.button.update') @lang('conference.en.en_report_title')
                    <span class="tools pull-right">
                        <a href="{{ Route('conference_en_report.index', $code) }}"
                            class="primary-btn-submit">@lang('conference.en.en_report_title')</a>
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form id="update-form">
                            @csrf
                            <input type="hidden" name="report_id" value="{{ $report->id }}">
                            <div class="form-dropdown">
                                <select class="form-dropdown-select" name="member_title" disabled>
                                    <option value="@lang('conference.en.title.mr')"
                                        {{ $report->member_title == 'Mr.' ? 'selected' : '' }}>@lang('conference.en.title.mr')
                                    </option>
                                    <option value="@lang('conference.en.title.ms')"
                                        {{ $report->member_title == 'Ms.' ? 'selected' : '' }}>@lang('conference.en.title.ms')
                                    </option>
                                    <option value="@lang('conference.en.title.mrs')"
                                        {{ $report->member_title == 'Mrs.' ? 'selected' : '' }}>@lang('conference.en.title.mrs')
                                    </option>
                                </select>
                                <span class="form-dropdown-chevron" aria-hidden="true"><i
                                        class="fa-solid fa-angle-down"></i></span>
                                <span class="form-dropdown-label">@lang('conference.en.title.title')</span>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-textbox">
                                        <input type="text" name="member_first_name"
                                            class="form-textbox-input {{ $report->member_first_name ? 'form-textbox-entered' : '' }}"
                                            value="{{ \Str::title($report->member_first_name) }}" disabled>
                                        <div class="form-message-wrapper member_first_name">
                                            <i class="fa fa-exclamation-circle"></i>
                                            <span class="member_first_name-form-message"></span>
                                        </div>
                                        <span class="form-textbox-label">@lang('conference.en.firstname')</span>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-textbox">
                                        <input type="text" name="member_last_name"
                                            class="form-textbox-input {{ $report->member_last_name ? 'form-textbox-entered' : '' }}"
                                            value="{{ \Str::title($report->member_last_name) }}" disabled>
                                        <div class="form-message-wrapper member_last_name">
                                            <i class="fa fa-exclamation-circle"></i>
                                            <span class="member_last_name-form-message"></span>
                                        </div>
                                        <span class="form-textbox-label">@lang('conference.en.lastname')</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-dropdown">
                                        <select class="form-dropdown-select" name="member_date" disabled>
                                            @for ($i = 1; $i <= 31; $i++)
                                                <option value="{{ $i }}"
                                                    {{ $report->member_date == $i ? 'selected' : '' }}>
                                                    {{ $i }}</option>
                                            @endfor
                                        </select>
                                        <span class="form-dropdown-chevron" aria-hidden="true"><i
                                                class="fa-solid fa-angle-down"></i></span>
                                        <span class="form-dropdown-label">@lang('conference.en.date')</span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-dropdown">
                                        <select class="form-dropdown-select" name="member_month" disabled>
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}"
                                                    {{ $report->member_month == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                        <span class="form-dropdown-chevron" aria-hidden="true"><i
                                                class="fa-solid fa-angle-down"></i></span>
                                        <span class="form-dropdown-label">@lang('conference.en.month')</span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-dropdown">
                                        <select class="form-dropdown-select" name="member_year" disabled>
                                            @for ($i = 1940; $i < 2010; $i++)
                                                <option value="{{ $i }}"
                                                    {{ $report->member_year == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                        <span class="form-dropdown-chevron" aria-hidden="true"><i
                                                class="fa-solid fa-angle-down"></i></span>
                                        <span class="form-dropdown-label">@lang('conference.en.year')</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-textbox">
                                <input type="text" name="member_email"
                                    class="form-textbox-input {{ $report->member_email ? 'form-textbox-entered' : '' }}"
                                    value="{{ $report->member_email }}" disabled>
                                <div class="form-message-wrapper member_email">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="member_email-form-message"></span>
                                </div>
                                <span class="form-textbox-label">@lang('conference.en.email')</span>
                            </div>
                            <div class="form-textbox">
                                <input type="text" name="member_phone"
                                    class="form-textbox-input {{ $report->member_phone ? 'form-textbox-entered' : '' }}"
                                    value="{{ $report->member_phone }}">
                                <div class="form-message-wrapper member_phone">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="member_phone-form-message"></span>
                                </div>
                                <span class="form-textbox-label">@lang('conference.en.phone')</span>
                            </div>
                            
                            <div class="form-textbox">
                                <input type="text" name="member_work_unit"
                                    class="form-textbox-input {{ $report->member_work_unit ? 'form-textbox-entered' : '' }}"
                                    value="{{ $report->member_work_unit }}" disabled>
                                <div class="form-message-wrapper member_work_unit">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="member_work_unit-form-message"></span>
                                </div>
                                <span class="form-textbox-label">@lang('conference.en.department')</span>
                            </div>

                            <div class="form-dropdown">
                                <select class="form-dropdown-select" name="member_country" disabled>
                                    @foreach ($getAllCountries as $key => $countries)
                                        <option value="{{ $countries->country_name }}"
                                            {{ $countries->country_name == $report->member_country ? 'selected' : '' }}>
                                            {{ $countries->country_name }}</option>
                                    @endforeach
                                </select>
                                <span class="form-dropdown-chevron" aria-hidden="true"><i
                                        class="fa-solid fa-angle-down"></i></span>
                                <span class="form-dropdown-label">@lang('conference.en.country')</span>
                            </div>

                            <div class="form-dropdown">
                                <select class="form-dropdown-select" name="report_topics" disabled>
                                    @foreach ($topics as $key => $topic)
                                        <option value="{{ $topic->id }}"
                                            {{ $topic->id == $report->report_topics ? 'selected' : '' }}>
                                            {{ $topic->topic_title_en }}</option>
                                    @endforeach
                                </select>
                                <span class="form-dropdown-chevron" aria-hidden="true"><i
                                        class="fa-solid fa-angle-down"></i></span>
                                <span class="form-dropdown-label">@lang('conference.en.topics')</span>
                            </div>

                            <div class="form-textbox">
                                <input type="text" name="report_file_title"
                                    class="form-textbox-input {{ $report->report_file_title ? 'form-textbox-entered' : '' }}"
                                    value="{{ $report->report_file_title }}">
                                <div class="form-message-wrapper report_file_title">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="report_file_title-form-message"></span>
                                </div>
                                <span class="form-textbox-label">@lang('conference.en.file_title')</span>
                            </div>

                            <div class="form-textbox">
                                <label>@lang('conference.en.file')</label>
                                <input type="file" name="report_file"
                                    class="filepond report_file {{ $report->report_file == '' ? '' : 'hidden' }}">
                                @if ($report->report_file)
                                    <div class="section-file report_file_section">
                                        <div class="file-content">
                                            <div class="file-name">
                                                <p>@lang('conference.en.file')</p>
                                            </div>
                                            <div class="file-action">
                                                <a href="https://drive.google.com/file/d/{{ $report->report_file }}/view"
                                                    target="_blank" class="dowload-file">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                                <button class="delete-file" type="button"
                                                    onclick="deleteFile('report_file','{{ $report->report_file }}', '{{ $report->id }}')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="form-dropdown">
                                <select class="form-dropdown-select" name="report_status">
                                    @if ($report->report_status == 1)
                                        <option value="1" selected>@lang('conference.en.status.step1')</option>
                                        <option value="2">@lang('conference.en.status.step3')</option>
                                        <option value="3">@lang('conference.en.status.step4')</option>
                                    @elseif($report->report_status == 2)
                                        <option disabled>@lang('conference.en.status.step1')</option>
                                        <option value="2" selected>@lang('conference.en.status.step3')</option>
                                        <option value="3">@lang('conference.en.status.step4')</option>
                                    @elseif($report->report_status == 3)
                                        <option disabled>@lang('conference.en.status.step1')</option>
                                        <option disabled>@lang('conference.en.status.step3')</option>
                                        <option value="3" selected>@lang('conference.en.status.step4')</option>
                                    @endif
                                </select>
                                <span class="form-dropdown-chevron" aria-hidden="true"><i
                                        class="fa-solid fa-angle-down"></i></span>
                                <span class="form-dropdown-label">@lang('conference.en.status.status')</span>
                            </div>
                            <button type="submit" class="primary-btn-submit button-submit">@lang('vart_define.button.update')</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        var url_file_process = "{{ route('file.process') }}";
        var url_file_revert = "{{ route('file.revert') }}";
        var url_file_delete = "{{ route('file.destroy') }}";
        var url_update = "{{ route('conference_en_report.update', $code) }}";
    </script>
    <script src="{{ versionResource('assets/js/conference/update.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/file/filepond.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/file/filepond-preview.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/essential.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/file/handle-file.js') }}" defer></script>
@endpush
