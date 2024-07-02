@extends('layouts.default_auth')
@section('title', __('conference.en.en_report_title') .' - ')
@push('css')
    <link rel="stylesheet" href="{{ versionResource('assets/css/support/filepond.css') }}" type="text/css" as="style" />
    <link rel="stylesheet" href="{{ versionResource('assets/css/support/filepond-preview.css') }}" type="text/css"
        as="style" />
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    @lang('vart_define.button.update') @lang('conference.en.en_report_title')
                    <span class="tools pull-right">
                        <a href="{{ Route('conference_en_report.index') }}" class="primary-btn-submit">@lang('conference.en.en_report_title')</a>
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form action="{{ Route('conference_en_report.update', $en_report->en_report_id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label>@lang('conference.en.title.title')</label>
                                <select name="en_report_title" class="input-control">
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
                                    <div class="form-group {{ $errors->has('en_report_firstname') ? 'has-error' : '' }}">
                                        <label>@lang('conference.en.firstname')</label>
                                        <input type="text" name="en_report_firstname" class="input-control"
                                            value="{{ $en_report->en_report_firstname }}">
                                        {!! $errors->first(
                                            'en_report_firstname',
                                            '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                        ) !!}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('en_report_lastname') ? 'has-error' : '' }}">
                                        <label>@lang('conference.en.lastname')</label>
                                        <input type="text" name="en_report_lastname" class="input-control"
                                            value="{{ $en_report->en_report_lastname }}">
                                        {!! $errors->first(
                                            'en_report_lastname',
                                            '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                        ) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>@lang('conference.en.date')</label>
                                        <select name="en_report_date" class="input-control">
                                            @for ($i = 1; $i <= 31; $i++)
                                                <option value="{{ $i }}"
                                                    {{ $en_report->en_report_date == $i ? 'selected' : '' }}>
                                                    {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>@lang('conference.en.month')</label>
                                        <select name="en_report_month" class="input-control">
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
                                    <div class="form-group">
                                        <label>@lang('conference.en.year')</label>
                                        <select name="en_report_year" class="select-2">
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
                            <div class="form-group {{ $errors->has('en_report_email') ? 'has-error' : '' }}">
                                <label>@lang('conference.en.email')</label>
                                <input type="text" name="en_report_email" class="input-control"
                                    value="{{ $en_report->en_report_email }}">
                                {!! $errors->first(
                                    'en_report_email',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group">
                                <label>@lang('conference.en.profession.profession')</label>
                                <select name="en_report_profession" class="input-control">
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
                            <div class="form-group {{ $errors->has('en_report_organization') ? 'has-error' : '' }}">
                                <label>@lang('conference.en.organization')</label>
                                <input type="text" name="en_report_organization" class="input-control"
                                    value="{{ $en_report->en_report_organization }}">
                                {!! $errors->first(
                                    'en_report_organization',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('en_report_department') ? 'has-error' : '' }}">
                                <label>@lang('conference.en.department')</label>
                                <input type="text" name="en_report_department" class="input-control"
                                    value="{{ $en_report->en_report_department }}">
                                {!! $errors->first(
                                    'en_report_department',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group">
                                <label>@lang('conference.en.country')</label>
                                <select name="en_report_nationality" class="select-2">
                                    @foreach ($getAllCountries as $key => $countries)
                                        <option value="{{ $countries->country_name }}"
                                            {{ $countries->country_name == $en_report->en_report_nationality ? 'selected' : '' }}>
                                            {{ $countries->country_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group {{ $errors->has('en_report_file_title') ? 'has-error' : '' }}">
                                <label>@lang('conference.en.file_title')</label>
                                <input type="text" name="en_report_file_title" class="input-control"
                                    value="{{ $en_report->en_report_file_title }}">
                                {!! $errors->first(
                                    'en_report_file_title',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">@lang('conference.en.file')</label>
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
                                                    onclick="deleteFile('en_report_file','{{ $en_report->en_report_file }}', '{{ $en_report->en_report_id }}')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">@lang('conference.en.status.status')</label>
                                <select name="en_report_status" class="input-control">
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
    </script>
    <script src="{{ versionResource('assets/js/support/file/filepond.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/file/filepond-preview.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/essential.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/file/handle-file.js') }}" defer></script>
@endpush