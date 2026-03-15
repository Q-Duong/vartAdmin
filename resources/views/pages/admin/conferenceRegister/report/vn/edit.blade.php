@extends('layouts.default_auth')
@section('title', __('vart_define.button.update') . ' ' . __('conference.en.report_title') . ' - ')
@push('css')
    <link rel="stylesheet" href="{{ versionResource('assets/styles/support/filepond.css') }}" type="text/css" as="style" />
    <link rel="stylesheet" href="{{ versionResource('assets/styles/support/filepond-preview.css') }}" type="text/css"
        as="style" />
    <link rel="stylesheet" href="{{ versionResource('assets/styles/landing/web/form.built.css') }}" type="text/css"
        as="style" />
    {{-- <link rel="stylesheet" href="{{ versionResource('assets/styles/landing/web/app-eyebrow.css') }}" type="text/css"
        as="style"> --}}
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    @lang('vart_define.button.update') @lang('conference.en.report_title')
                    <span class="tools pull-right">
                        <a href="{{ Route('conference_report.index', $code) }}"
                            class="primary-btn-submit">@lang('conference.en.report_title')</a>
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form id="update-form">
                            @csrf
                            <input type="hidden" name="report_id" value="{{ $report->id }}">
                            <input type="hidden" name="previous_url" value="{{ $previous_url }}">
                            
                            <div class="form-textbox">
                                <input type="text" name="member_full_name"
                                    class="form-textbox-input {{ $report->member_full_name ? 'form-textbox-entered' : '' }}"
                                    value="{{ \Str::title($report->member_full_name) }}" disabled>
                                <div class="form-message-wrapper member_full_name">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="member_full_name-form-message"></span>
                                </div>
                                <span class="form-textbox-label">@lang('conference.en.fullname')</span>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-dropdown">
                                        <select name="member_date" class="form-dropdown-select" disabled>
                                            @for ($i = 1; $i <= 31; $i++)
                                                <option value="{{ $i }}"
                                                    {{ $report->member_date == $i ? 'selected' : '' }}>{{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                        <span class="form-dropdown-chevron" aria-hidden="true"><i
                                                class="fa-solid fa-angle-down"></i></span>
                                        <span class="form-dropdown-label">@lang('conference.en.date')</span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-dropdown">
                                        <select name="member_month" class="form-dropdown-select" disabled>
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}"
                                                    {{ $report->member_month == $i ? 'selected' : '' }}>
                                                    {{ $i }}</option>
                                            @endfor
                                        </select>
                                        <span class="form-dropdown-chevron" aria-hidden="true"><i
                                                class="fa-solid fa-angle-down"></i></span>
                                        <span class="form-dropdown-label">@lang('conference.en.month')</span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-dropdown">
                                        <select name="member_year" class="form-dropdown-select" disabled>
                                            @for ($i = 1940; $i < 2010; $i++)
                                                <option value="{{ $i }}"
                                                    {{ $report->member_year == $i ? 'selected' : '' }}>{{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                        <span class="form-dropdown-chevron" aria-hidden="true"><i
                                                class="fa-solid fa-angle-down"></i></span>
                                        <span class="form-dropdown-label">@lang('conference.en.year')</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-dropdown">
                                <select name="member_gender" class="form-dropdown-select" disabled>
                                    <option value="0" {{ $report->member_gender == 0 ? 'selected' : '' }}>
                                        @lang('conference.en.male')</option>
                                    <option value="1" {{ $report->member_gender == 1 ? 'selected' : '' }}>
                                        @lang('conference.en.female')</option>
                                </select>
                                <span class="form-dropdown-chevron" aria-hidden="true"><i
                                        class="fa-solid fa-angle-down"></i></span>
                                <span class="form-dropdown-label">@lang('conference.en.gender')</span>
                            </div>

                            <div class="form-textbox">
                                <input type="text" name="member_work_unit"
                                    class="form-textbox-input {{ $report->member_work_unit ? 'form-textbox-entered' : '' }}"
                                    value="{{ $report->member_work_unit }}">
                                <div class="form-message-wrapper member_work_unit">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="member_work_unit-form-message"></span>
                                </div>
                                <span class="form-textbox-label">@lang('conference.en.unit')</span>
                            </div>

                            <div class="form-dropdown">
                                <select name="member_place_of_birth" class="form-dropdown-select" disabled>
                                    @foreach ($getAllProvince as $key => $province)
                                        <option value="{{ $province->type . ' ' . $province->name }}"
                                            {{ $report->member_place_of_birth == $province->type . ' ' . $province->name ? 'selected' : '' }}>
                                            {{ $province->type }} {{ $province->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="form-dropdown-chevron" aria-hidden="true"><i
                                        class="fa-solid fa-angle-down"></i></span>
                                <span class="form-dropdown-label">@lang('conference.en.place_of_birth')</span>
                            </div>

                            <div class="form-textbox">
                                <input type="text" name="member_email"
                                    class="form-textbox-input {{ $report->member_email ? 'form-textbox-entered' : '' }}"
                                    value="{{ $report->member_email }}">
                                <div class="form-message-wrapper member_email">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="member_email-form-message"></span>
                                </div>
                                <span class="form-textbox-label">@lang('conference.en.email')</span>
                            </div>

                            <div class="form-textbox">
                                <input type="text" name="member_phone"
                                    class="form-textbox-input {{ $report->member_phone ? 'form-textbox-entered' : '' }}"
                                    value="{{ $report->member_phone }}" disabled>
                                <div class="form-message-wrapper member_phone">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="member_phone-form-message"></span>
                                </div>
                                <span class="form-textbox-label">@lang('conference.en.phone')</span>
                            </div>

                            <div class="form-textbox">
                                <input type="text" name="member_graduation_year"
                                    class="form-textbox-input {{ $report->member_graduation_year ? 'form-textbox-entered' : '' }}"
                                    value="{{ $report->member_graduation_year }}" disabled>
                                <div class="form-message-wrapper member_graduation_year">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="member_graduation_year-form-message"></span>
                                </div>
                                <span class="form-textbox-label">@lang('conference.en.graduation_year')</span>
                            </div>

                            <div class="form-textbox">
                                <label>@lang('conference.en.image')</label>
                                <input type="file" name="member_image"
                                    class="filepond member_image {{ $report->member_image == '' ? '' : 'hidden' }}">
                                @if ($report->member_image)
                                    <div class="section-file member_image_section">
                                        <div class="file-content">
                                            <div class="file-name">
                                                <p>@lang('conference.en.image')</p>
                                            </div>
                                            <div class="file-action">
                                                <a href="https://drive.google.com/file/d/{{ $report->member_image }}/view"
                                                    target="_blank" class="dowload-file">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                                <button class="delete-file " type="button"
                                                    onclick="deleteFile('member_image','{{ $report->member_image }}', '{{ $report->id }}')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="form-textbox">
                                <label>@lang('conference.en.image_card')</label>
                                <input type="file" name="member_image_card"
                                    class="filepond member_image_card {{ $report->member_image_card == '' ? '' : 'hidden' }}">
                                @if ($report->member_image_card)
                                    <div class="section-file member_image_card_section">
                                        <div class="file-content">
                                            <div class="file-name">
                                                <p>@lang('conference.en.image_card')</p>
                                            </div>
                                            <div class="file-action">
                                                <a href="https://drive.google.com/file/d/{{ $report->member_image_card }}/view"
                                                    target="_blank" class="dowload-file">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                                <button class="delete-file" type="button"
                                                    onclick="deleteFile('member_image_card','{{ $report->member_image_card }}', '{{ $report->id }}')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="form-textbox">
                                <label>@lang('conference.en.background')</label>
                                <input type="file" name="report_file_background"
                                    class="filepond report_file_background {{ $report->report_file_background == '' ? '' : 'hidden' }}">
                                @if ($report->report_file_background)
                                    <div class="section-file report_file_background_section">
                                        <div class="file-content">
                                            <div class="file-name">
                                                <p>@lang('conference.en.background')</p>
                                            </div>
                                            <div class="file-action">
                                                <a href="https://drive.google.com/file/d/{{ $report->report_file_background }}/view"
                                                    target="_blank" class="dowload-file">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                                <button class="delete-file" type="button"
                                                    onclick="deleteFile('report_file_background','{{ $report->report_file_background }}', '{{ $report->id }}')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
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
                                <select name="report_status" class="form-dropdown-select report-status">
                                    @if ($report->report_status == 1)
                                        <option value="1" selected>@lang('conference.en.status.step1')</option>
                                        <option value="2">@lang('conference.en.status.step3')</option>
                                        <option value="3">@lang('conference.en.status.step4')</option>
                                        <option value="4">@lang('conference.en.status.step5')</option>
                                    @elseif($report->report_status == 2)
                                        <option disabled>@lang('conference.en.status.step1')</option>
                                        <option value="2" selected>@lang('conference.en.status.step3')</option>
                                        <option value="3">@lang('conference.en.status.step4')</option>
                                        <option value="4">@lang('conference.en.status.step5')</option>
                                    @elseif($report->report_status == 3)
                                        <option disabled>@lang('conference.en.status.step1')</option>
                                        <option disabled>@lang('conference.en.status.step3')</option>
                                        <option value="3" selected>@lang('conference.en.status.step4')</option>
                                        <option disabled>@lang('conference.en.status.step5')</option>
                                    @elseif($report->report_status == 4)
                                        <option disabled>@lang('conference.en.status.step1')</option>
                                        <option disabled>@lang('conference.en.status.step3')</option>
                                        <option disabled>@lang('conference.en.status.step4')</option>
                                        <option value="4" selected>@lang('conference.en.status.step5')</option>
                                    @endif
                                </select>
                                <span class="form-dropdown-chevron" aria-hidden="true"><i
                                        class="fa-solid fa-angle-down"></i></span>
                                <span class="form-dropdown-label">@lang('conference.en.status.status')</span>
                            </div>

                            <div
                                class="form-textbox report-suggested-addition {{ $report->report_status == 3 ? '' : 'hidden' }}">
                                <label>@lang('conference.en.suggested_addition')</label>
                                <textarea name="report_suggested_addition" rows=6 class="form-textarea report-suggested-addition-input"
                                    {{ $report->report_status == 3 ? '' : 'disabled' }}>{{ $report->report_suggested_addition }}</textarea>
                                <div class="form-message-wrapper report_suggested_addition">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="report_suggested_addition-form-message"></span>
                                </div>
                            </div>
                            
                            <div
                                class="form-textbox report-reason-rejection {{ $report->report_status == 4 ? '' : 'hidden' }}">
                                <label>@lang('conference.en.reason_rejection')</label>
                                <textarea name="report_reason_rejection" rows=6 class="form-textarea report-reason-rejection-input"
                                    {{ $report->report_status == 4 ? '' : 'disabled' }}>{{ $report->report_reason_rejection }}</textarea>
                                <div class="form-message-wrapper report_reason_rejection">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="report_reason_rejection-form-message"></span>
                                </div>
                            </div>


                            <button type="button" class="primary-btn-submit button-submit">@lang('vart_define.button.update')</button>
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
        var url_update = "{{ route('conference_report.update', $code) }}";
    </script>
    <script src="{{ versionResource('assets/js/conference/update.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/file/filepond.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/file/filepond-preview.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/essential.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/file/handle-file.js') }}" defer></script>
@endpush
