@extends('layouts.default_auth')
@section('title', __('conference.en.report_title') .' - ')
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
                    @lang('vart_define.button.update') @lang('conference.en.report_title')
                    <span class="tools pull-right">
                        <a href="{{ Route('conference_report.index') }}" class="primary-btn-submit">@lang('conference.en.report_title')</a>
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form action="{{ Route('conference_report.update', $report->report_id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label>@lang('conference.en.degree')</label>
                                <select name="report_degree" class="input-control">
                                    @foreach ($getAllAcademic as $key => $academic)
                                        <option value="{{ $academic->academic_title }}"
                                            {{ $academic->academic_title == $report->report_degree ? 'selected' : '' }}>
                                            {{ $academic->academic_title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group {{ $errors->has('report_name') ? 'has-error' : '' }}">
                                <label>@lang('conference.en.fullname')</label>
                                <input type="text" name="report_name" class="input-control"
                                    value="{{ $report->report_name }}">
                                {!! $errors->first(
                                    'report_name',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>@lang('conference.en.date')</label>
                                        <select name="report_date" class="input-control">
                                            @for ($i = 1; $i <= 31; $i++)
                                                <option value="{{ $i }}"
                                                    {{ $report->report_date == $i ? 'selected' : '' }}>{{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>@lang('conference.en.month')</label>
                                        <select name="report_month" class="input-control">
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}"
                                                    {{ $report->report_month == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>@lang('conference.en.year')</label>
                                        <select name="report_year" class="input-control">
                                            @for ($i = 1940; $i < 2010; $i++)
                                                <option value="{{ $i }}"
                                                    {{ $report->report_year == $i ? 'selected' : '' }}>{{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>@lang('conference.en.gender')</label>
                                <select name="report_gender" class="input-control">
                                    <option value="0" {{ $report->report_gender == 0 ? 'selected' : '' }}>
                                        @lang('conference.en.male')</option>
                                    <option value="1" {{ $report->report_gender == 1 ? 'selected' : '' }}>
                                        @lang('conference.en.female')</option>
                                </select>
                            </div>
                            <div class="form-group {{ $errors->has('report_work_unit') ? 'has-error' : '' }}">
                                <label>@lang('conference.en.unit')</label>
                                <input type="text" name="report_work_unit" class="input-control"
                                    value="{{ $report->report_work_unit }}">
                                {!! $errors->first(
                                    'report_work_unit',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group">
                                <label>@lang('conference.en.place_of_birth')</label>
                                <select name="report_place_of_birth" class="input-control">
                                    @foreach ($getAllProvince as $key => $province)
                                        <option value="{{ $province->province_name }}"
                                            {{ $province->province_name == $report->report_place_of_birth ? 'selected' : '' }}>
                                            {{ $province->province_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group {{ $errors->has('report_email') ? 'has-error' : '' }}">
                                <label>@lang('conference.en.email')</label>
                                <input type="text" name="report_email" class="input-control"
                                    value="{{ $report->report_email }}">
                                {!! $errors->first(
                                    'report_email',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('report_phone') ? 'has-error' : '' }}">
                                <label>@lang('conference.en.phone')</label>
                                <input type="text" name="report_phone" class="input-control"
                                    value="{{ $report->report_phone }}">
                                {!! $errors->first(
                                    'report_phone',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('report_graduation_year') ? 'has-error' : '' }}">
                                <label>@lang('conference.en.graduation_year')</label>
                                <input type="text" name="report_graduation_year" class="input-control"
                                    value="{{ $report->report_graduation_year }}">
                                {!! $errors->first(
                                    'report_graduation_year',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">@lang('conference.en.image')</label>
                                <input type="file" name="report_image"
                                    class="filepond report_image {{ $report->report_image == '' ? '' : 'hidden' }}">
                                @if ($report->report_image)
                                    <div class="section-file report_image_section">
                                        <div class="file-content">
                                            <div class="file-name">
                                                <p>@lang('conference.en.image')</p>
                                            </div>
                                            <div class="file-action">
                                                <a href="https://drive.google.com/file/d/{{ $report->report_image }}/view"
                                                    target="_blank" class="dowload-file">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                                <button class="delete-file " type="button"
                                                    onclick="deleteFile('report_image','{{ $report->report_image }}', '{{ $report->report_id }}')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">@lang('conference.en.image_card')</label>
                                <input type="file" name="report_image_card"
                                    class="filepond report_image_card {{ $report->report_image_card == '' ? '' : 'hidden' }}">
                                @if ($report->report_image_card)
                                    <div class="section-file report_image_card_section">
                                        <div class="file-content">
                                            <div class="file-name">
                                                <p>@lang('conference.en.image_card')</p>
                                            </div>
                                            <div class="file-action">
                                                <a href="https://drive.google.com/file/d/{{ $report->report_image_card }}/view"
                                                    target="_blank" class="dowload-file">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                                <button class="delete-file" type="button"
                                                    onclick="deleteFile('report_image_card','{{ $report->report_image_card }}', '{{ $report->report_id }}')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">@lang('conference.en.file')</label>
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
                                                    onclick="deleteFile('report_file','{{ $report->report_file }}', '{{ $report->report_id }}')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">@lang('conference.en.status.status')</label>
                                <select name="report_status" class="input-control">
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