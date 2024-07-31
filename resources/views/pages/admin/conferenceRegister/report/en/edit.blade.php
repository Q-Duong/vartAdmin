@extends('layouts.default_auth')
@section('title', __('vart_define.button.update') . ' ' . __('conference.en.en_report_title') . ' - ')
@push('css')
    <link rel="stylesheet" href="{{ versionResource('assets/styles/support/filepond.css') }}" type="text/css" as="style" />
    <link rel="stylesheet" href="{{ versionResource('assets/styles/support/filepond-preview.css') }}" type="text/css"
        as="style" />
    <link rel="stylesheet" href="{{ versionResource('assets/styles/landing/web/app-eyebrow.css') }}" type="text/css"
        as="style">
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
                            <input type="hidden" name="en_report_id" value="{{ $en_report->id }}">
                            <div class="form-element">
                                <span class="select-label">@lang('conference.en.title.title')</span>
                                <select class="select-textbox" name="en_report_title">
                                    <option value="@lang('conference.en.title.mr')"
                                        {{ $en_report->en_report_title == 'Mr.' ? 'selected' : '' }}>@lang('conference.en.title.mr')
                                    </option>
                                    <option value="@lang('conference.en.title.ms')"
                                        {{ $en_report->en_report_title == 'Ms.' ? 'selected' : '' }}>@lang('conference.en.title.ms')
                                    </option>
                                    <option value="@lang('conference.en.title.mrs')"
                                        {{ $en_report->en_report_title == 'Mrs.' ? 'selected' : '' }}>@lang('conference.en.title.mrs')
                                    </option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-element">
                                        <input type="text" name="en_report_firstname"
                                            class="form-textbox {{ $en_report->en_report_firstname ? 'form-textbox-entered' : '' }}"
                                            value="{{ $en_report->en_report_firstname }}">
                                        <div class="alert-error error hidden en_report_firstname">
                                            <i class="fa fa-exclamation-circle"></i>
                                            <span class="en_report_firstname_message"></span>
                                        </div>
                                        <span class="form-label">@lang('conference.en.firstname')</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-element">
                                        <input type="text" name="en_report_lastname"
                                            class="form-textbox {{ $en_report->en_report_lastname ? 'form-textbox-entered' : '' }}"
                                            value="{{ $en_report->en_report_lastname }}">
                                        <div class="alert-error error hidden en_report_lastname">
                                            <i class="fa fa-exclamation-circle"></i>
                                            <span class="en_report_lastname_message"></span>
                                        </div>
                                        <span class="form-label">@lang('conference.en.lastname')</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-element">
                                        <span class="select-label">@lang('conference.en.date')</span>
                                        <select class="select-textbox" name="en_report_date">
                                            @for ($i = 1; $i <= 31; $i++)
                                                <option value="{{ $i }}"
                                                    {{ $en_report->en_report_date == $i ? 'selected' : '' }}>
                                                    {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-element">
                                        <span class="select-label">@lang('conference.en.month')</span>
                                        <select class="select-textbox" name="en_report_month">
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}"
                                                    {{ $en_report->en_report_month == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-element">
                                        <span class="select-label">@lang('conference.en.year')</span>
                                        <select class="select-textbox" name="en_report_year">
                                            @for ($i = 1940; $i < 2010; $i++)
                                                <option value="{{ $i }}"
                                                    {{ $en_report->en_report_year == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-element">
                                <input type="text" name="en_report_email"
                                    class="form-textbox {{ $en_report->en_report_email ? 'form-textbox-entered' : '' }}"
                                    value="{{ $en_report->en_report_email }}">
                                <div class="alert-error error hidden en_report_email">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="en_report_email_message"></span>
                                </div>
                                <span class="form-label">@lang('conference.en.email')</span>
                            </div>
                            <div class="form-element">
                                <span class="select-label">@lang('conference.en.profession.profession')</span>
                                <select class="select-textbox" name="en_report_profession">
                                    <option value="@lang('conference.en.profession.radiologist')"
                                        {{ $en_report->en_report_profession == 'Radiologist' ? 'selected' : '' }}>
                                        @lang('conference.en.profession.radiologist')</option>
                                    <option value="@lang('conference.en.profession.technologist')"
                                        {{ $en_report->en_report_profession == 'Technologist' ? 'selected' : '' }}>
                                        @lang('conference.en.profession.technologist')</option>
                                    <option value="@lang('conference.en.profession.physicist')"
                                        {{ $en_report->en_report_profession == 'Physicist' ? 'selected' : '' }}>
                                        @lang('conference.en.profession.physicist')
                                    </option>
                                    <option value="@lang('conference.en.profession.engineer')"
                                        {{ $en_report->en_report_profession == 'Engineer' ? 'selected' : '' }}>
                                        @lang('conference.en.profession.engineer')</option>
                                    <option value="@lang('conference.en.profession.other')"
                                        {{ $en_report->en_report_profession == 'Other' ? 'selected' : '' }}>
                                        @lang('conference.en.profession.other')</option>
                                </select>
                            </div>
                            <div class="form-element">
                                <input type="text" name="en_report_organization"
                                    class="form-textbox {{ $en_report->en_report_organization ? 'form-textbox-entered' : '' }}"
                                    value="{{ $en_report->en_report_organization }}">
                                <div class="alert-error error hidden en_report_organization">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="en_report_organization_message"></span>
                                </div>
                                <span class="form-label">@lang('conference.en.organization')</span>
                            </div>
                            <div class="form-element">
                                <input type="text" name="en_report_department"
                                    class="form-textbox {{ $en_report->en_report_department ? 'form-textbox-entered' : '' }}"
                                    value="{{ $en_report->en_report_department }}">
                                <div class="alert-error error hidden en_report_department">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="en_report_department_message"></span>
                                </div>
                                <span class="form-label">@lang('conference.en.department')</span>
                            </div>
                            <div class="form-element">
                                <span class="select-label">@lang('conference.en.country')</span>
                                <select class="select-textbox" name="en_report_nationality">
                                    @foreach ($getAllCountries as $key => $countries)
                                        <option value="{{ $countries->country_name }}"
                                            {{ $countries->country_name == $en_report->en_report_nationality ? 'selected' : '' }}>
                                            {{ $countries->country_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-element">
                                <input type="text" name="en_report_file_title"
                                    class="form-textbox {{ $en_report->en_report_file_title ? 'form-textbox-entered' : '' }}"
                                    value="{{ $en_report->en_report_file_title }}">
                                <div class="alert-error error hidden en_report_file_title">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="en_report_file_title_message"></span>
                                </div>
                                <span class="form-label">@lang('conference.en.file_title')</span>
                            </div>
                            <div class="form-element">
                                <label>@lang('conference.en.file')</label>
                                <input type="file" name="en_report_file"
                                    class="filepond en_report_file {{ $en_report->en_report_file == '' ? '' : 'hidden' }}">
                                @if ($en_report->en_report_file)
                                    <div class="section-file en_report_file_section">
                                        <div class="file-content">
                                            <div class="file-name">
                                                <p>@lang('conference.en.file')</p>
                                            </div>
                                            <div class="file-action">
                                                <a href="https://drive.google.com/file/d/{{ $en_report->en_report_file }}/view"
                                                    target="_blank" class="dowload-file">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                                <button class="delete-file" type="button"
                                                    onclick="deleteFile('en_report_file','{{ $en_report->en_report_file }}', '{{ $en_report->id }}')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="form-element">
                                <span class="select-label">@lang('conference.en.status.status')</span>
                                <select class="select-textbox" name="en_report_status">
                                    @if ($en_report->en_report_status == 1)
                                        <option value="1" selected>@lang('conference.en.status.step1')</option>
                                        <option value="2">@lang('conference.en.status.step3')</option>
                                        <option value="3">@lang('conference.en.status.step4')</option>
                                    @elseif($en_report->en_report_status == 2)
                                        <option disabled>@lang('conference.en.status.step1')</option>
                                        <option value="2" selected>@lang('conference.en.status.step3')</option>
                                        <option value="3">@lang('conference.en.status.step4')</option>
                                    @elseif($en_report->en_report_status == 3)
                                        <option disabled>@lang('conference.en.status.step1')</option>
                                        <option disabled>@lang('conference.en.status.step3')</option>
                                        <option value="3" selected>@lang('conference.en.status.step4')</option>
                                    @endif
                                </select>
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
