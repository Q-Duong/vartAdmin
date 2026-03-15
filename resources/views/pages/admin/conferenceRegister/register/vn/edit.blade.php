@extends('layouts.default_auth')
@section('title', __('vart_define.button.update') . ' ' . __('conference.en.register_title') . ' - ')
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
                    @lang('vart_define.button.update') @lang('conference.en.register_title')
                    <span class="tools pull-right">
                        <a href="{{ Route('conference_register.index', $code) }}"
                            class="primary-btn-submit">@lang('conference.en.register_title')</a>
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form id="update-form">
                            @csrf
                            <input type="hidden" name="register_id" value="{{ $register->id }}">
                            
                            <div class="form-textbox">
                                <input name="member_full_name"
                                    class="form-textbox-input {{ $register->member->member_full_name ? 'form-textbox-entered' : '' }}"
                                    value="{{ \Str::title($register->member->member_full_name) }}" disabled>
                                <div class="form-message-wrapper member_full_name">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="member_full_name-form-message"></span>
                                </div>
                                <span class="form-textbox-label">@lang('conference.en.fullname')</span>
                            </div>

                            <div class="form-dropdown">
                                <select class="form-dropdown-select" name="member_gender" disabled>
                                    <option value="0" {{ $register->member->member_gender == 0 ? 'selected' : '' }}>
                                        @lang('conference.male')</option>
                                    <option value="1" {{ $register->member->member_gender == 1 ? 'selected' : '' }}>
                                        @lang('conference.female')</option>
                                </select>
                                <span class="form-dropdown-chevron" aria-hidden="true"><i
                                        class="fa-solid fa-angle-down"></i></span>
                                <span class="form-dropdown-label">@lang('conference.en.gender')</span>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-dropdown">
                                        <select class="form-dropdown-select" name="member_date" disabled>
                                            @for ($i = 1; $i <= 31; $i++)
                                                <option value="{{ $i }}"
                                                    {{ $register->member->member_date == $i ? 'selected' : '' }}>
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
                                                    {{ $register->member->member_month == $i ? 'selected' : '' }}>
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
                                                    {{ $register->member->member_year == $i ? 'selected' : '' }}>
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
                                <input type="text" name="member_work_unit"
                                    class="form-textbox-input {{ $register->member->member_work_unit ? 'form-textbox-entered' : '' }}"
                                    value="{{ $register->member->member_work_unit }}">
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
                                            {{ $register->member->member_place_of_birth == $province->type . ' ' . $province->name ? 'selected' : '' }}>
                                            {{ $province->type }} {{ $province->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="form-dropdown-chevron" aria-hidden="true"><i
                                        class="fa-solid fa-angle-down"></i></span>
                                <span class="form-dropdown-label">@lang('conference.en.place_of_birth')</span>
                            </div>

                            <div class="form-textbox">
                                <input type="text" name="member_nation"
                                    class="form-textbox-input {{ $register->member->member_nation ? 'form-textbox-entered' : '' }}"
                                    value="{{ $register->member->member_nation }}" disabled>
                                <div class="form-message-wrapper member_nation">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="member_nation-form-message"></span>
                                </div>
                                <span class="form-textbox-label">@lang('conference.en.nation')</span>
                            </div>

                            <div class="form-textbox">
                                <input type="text" name="member_email"
                                    class="form-textbox-input {{ $register->member->member_email ? 'form-textbox-entered' : '' }}"
                                    value="{{ $register->member->member_email }}">
                                <div class="form-message-wrapper member_email">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="member_email-form-message"></span>
                                </div>
                                <span class="form-textbox-label">@lang('conference.en.email')</span>
                            </div>

                            <div class="form-textbox">
                                <input type="text" name="member_phone"
                                    class="form-textbox-input {{ $register->member->member_phone ? 'form-textbox-entered' : '' }}"
                                    value="{{ $register->member->member_phone }}" disabled>
                                <div class="form-message-wrapper member_phone">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="member_phone-form-message"></span>
                                </div>
                                <span class="form-textbox-label">@lang('conference.en.phone')</span>
                            </div>

                            <div class="form-textbox">
                                <input type="text" name="member_graduation_year"
                                    class="form-textbox-input {{ $register->member->member_graduation_year ? 'form-textbox-entered' : '' }}"
                                    value="{{ $register->member->member_graduation_year }}" disabled>
                                <span class="form-textbox-label">@lang('conference.en.graduation_year')</span>
                            </div>

                            <div class="form-textbox">
                                <label>@lang('conference.en.image')</label>
                                <input type="file" name="member_image"
                                    class="filepond member_image {{ $register->member->member_image == '' ? '' : 'hidden' }}">
                                @if ($register->member->member_image)
                                    <div class="section-file member_image_section">
                                        <div class="file-content">
                                            <div class="file-name">
                                                <p>@lang('conference.en.image')</p>
                                            </div>
                                            <div class="file-action">
                                                <a href="https://drive.google.com/file/d/{{ $register->member->member_image }}/view"
                                                    target="_blank" class="dowload-file">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                                <button class="delete-file " type="button"
                                                    onclick="deleteFile('member_image','{{ $register->member->member_image }}', '{{ $register->member->id }}')">
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
                                    class="filepond member_image_card {{ $register->member->member_image_card == '' ? '' : 'hidden' }}">
                                @if ($register->member->member_image_card)
                                    <div class="section-file member_image_card_section">
                                        <div class="file-content">
                                            <div class="file-name">
                                                <p>@lang('conference.en.image_card')</p>
                                            </div>
                                            <div class="file-action">
                                                <a href="https://drive.google.com/file/d/{{ $register->member->member_image_card }}/view"
                                                    target="_blank" class="dowload-file">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                                <button class="delete-file" type="button"
                                                    onclick="deleteFile('member_image_card','{{ $register->member->member_image_card }}', '{{ $register->member->id }}')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="form-textbox">
                                <label>@lang('conference.en.transfer_image')</label>
                                <input type="file" name="payment_image"
                                    class="filepond payment_image {{ $register->payment->payment_image == '' ? '' : 'hidden' }}">
                                @if ($register->payment->payment_image)
                                    <div class="section-file payment_image_section">
                                        <div class="file-content">
                                            <div class="file-name">
                                                <p>@lang('conference.en.transfer_image')</p>
                                            </div>
                                            <div class="file-action">
                                                <a href="https://drive.google.com/file/d/{{ $register->payment->payment_image }}/view"
                                                    target="_blank" class="dowload-file">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                                <button class="delete-file" type="button"
                                                    onclick="deleteFile('payment_image', '{{ $register->payment->payment_image }}', '{{ $register->payment->id }}')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="form-dropdown">
                                <select class="form-dropdown-select" name="payment_status">
                                    @if ($register->payment->payment_status == 1)
                                        <option value="1" selected>@lang('conference.en.status.step1')</option>
                                        <option value="2">@lang('conference.en.status.step2')</option>
                                        <option value="3">@lang('conference.en.status.step3')</option>
                                        <option value="4">@lang('conference.en.status.step4')</option>
                                    @elseif($register->payment->payment_status == 2)
                                        <option disabled>@lang('conference.en.status.step1')</option>
                                        <option value="2" selected>@lang('conference.en.status.step2')</option>
                                        <option value="3">@lang('conference.en.status.step3')</option>
                                        <option value="4">@lang('conference.en.status.step4')</option>
                                    @elseif($register->payment->payment_status == 3)
                                        <option disabled>@lang('conference.en.status.step1')</option>
                                        <option disabled>@lang('conference.en.status.step2')</option>
                                        <option value="3" selected>@lang('conference.en.status.step3')</option>
                                        <option value="4">@lang('conference.en.status.step4')</option>
                                    @elseif($register->payment->payment_status == 4)
                                        <option disabled>@lang('conference.en.status.step1')</option>
                                        <option disabled>@lang('conference.en.status.step2')</option>
                                        <option disabled>@lang('conference.en.status.step3')</option>
                                        <option value="4" selected>@lang('conference.en.status.step4')</option>
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
        var url_update = "{{ route('conference_register.update', $code) }}";
    </script>
    <script src="{{ versionResource('assets/js/conference/update.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/file/filepond.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/file/filepond-preview.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/essential.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/file/handle-file.js') }}" defer></script>
@endpush
