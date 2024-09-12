@extends('layouts.default_auth')
@section('title', __('vart_define.button.update') . ' ' . __('conference.en.register_title') . ' - ')
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
                            <div class="form-element">
                                <input type="text" name="register_object_group"
                                    class="form-textbox {{ $register->register_object_group ? 'form-textbox-entered' : '' }}"
                                    value="{{ $register->register_object_group }}">
                                <span class="form-label">@lang('conference.en.object_group')</span>
                            </div>
                            <div class="form-element">
                                <span class="select-label">@lang('conference.en.degree')</span>
                                <select class="select-textbox" name="register_degree">
                                    @foreach ($getAllAcademic as $key => $academic)
                                        <option value="{{ $academic->academic_title }}"
                                            {{ $academic->academic_title == $register->register_degree ? 'selected' : '' }}>
                                            {{ $academic->academic_title }}
                                        </option>
                                    @endforeach
                                    <option value="">Trống</option>
                                </select>
                            </div>
                            <div class="form-element">
                                <input name="register_name"
                                    class="form-textbox {{ $register->register_name ? 'form-textbox-entered' : '' }}"
                                    value="{{ $register->register_name }}">
                                <div class="alert-error error hidden register_name">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="register_name_message"></span>
                                </div>
                                <span class="form-label">@lang('conference.en.fullname')</span>
                            </div>
                            <div class="form-element">
                                <span class="select-label">@lang('conference.en.gender')</span>
                                <select class="select-textbox" name="register_gender">
                                    <option value="0" {{ $register->register_gender == 0 ? 'selected' : '' }}>
                                        @lang('conference.en.male')</option>
                                    <option value="1" {{ $register->register_gender == 1 ? 'selected' : '' }}>
                                        @lang('conference.en.female')</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-element">
                                        <span class="select-label">@lang('conference.en.date')</span>
                                        <select class="select-textbox" name="register_date">
                                            @for ($i = 1; $i <= 31; $i++)
                                                <option value="{{ $i }}"
                                                    {{ $register->register_date == $i ? 'selected' : '' }}>
                                                    {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-element">
                                        <span class="select-label">@lang('conference.en.month')</span>
                                        <select class="select-textbox" name="register_month">
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}"
                                                    {{ $register->register_month == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-element">
                                        <span class="select-label">@lang('conference.en.year')</span>
                                        <select class="select-textbox" name="register_year">
                                            @for ($i = 1940; $i < 2010; $i++)
                                                <option value="{{ $i }}"
                                                    {{ $register->register_year == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-element">
                                <input type="text" name="register_work_unit"
                                    class="form-textbox {{ $register->register_work_unit ? 'form-textbox-entered' : '' }}"
                                    value="{{ $register->register_work_unit }}">
                                <div class="alert-error error hidden register_work_unit">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="register_work_unit_message"></span>
                                </div>
                                <span class="form-label">@lang('conference.en.unit')</span>
                            </div>
                            <div class="form-element">
                                <span class="select-label">@lang('conference.en.place_of_birth')</span>
                                <select class="select-textbox" name="register_place_of_birth">
                                    @foreach ($getAllProvince as $key => $province)
                                        <option value="{{ $province->province_name }}"
                                            {{ $province->province_name == $register->register_place_of_birth ? 'selected' : '' }}>
                                            {{ $province->province_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-element">
                                <input type="text" name="register_nation"
                                    class="form-textbox {{ $register->register_nation ? 'form-textbox-entered' : '' }}"
                                    value="{{ $register->register_nation }}">
                                <div class="alert-error error hidden register_nation">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="register_nation_message"></span>
                                </div>
                                <span class="form-label">@lang('conference.en.nation')</span>
                            </div>
                            <div class="form-element">
                                <input type="text" name="register_email"
                                    class="form-textbox {{ $register->register_email ? 'form-textbox-entered' : '' }}"
                                    value="{{ $register->register_email }}">
                                <div class="alert-error error hidden register_email">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="register_email_message"></span>
                                </div>
                                <span class="form-label">@lang('conference.en.email')</span>
                            </div>
                            <div class="form-element">
                                <input type="text" name="register_phone"
                                    class="form-textbox {{ $register->register_phone ? 'form-textbox-entered' : '' }}"
                                    value="{{ $register->register_phone }}">
                                <div class="alert-error error hidden register_phone">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="register_phone_message"></span>
                                </div>
                                <span class="form-label">@lang('conference.en.phone')</span>
                            </div>
                            <div class="form-element">
                                <input type="text" name="register_graduation_year"
                                    class="form-textbox {{ $register->register_graduation_year ? 'form-textbox-entered' : '' }}"
                                    value="{{ $register->register_graduation_year }}">
                                <span class="form-label">@lang('conference.en.graduation_year')</span>
                            </div>
                            <div class="form-element">
                                <input type="text" name="register_receiving_address"
                                    class="form-textbox {{ $register->register_receiving_address ? 'form-textbox-entered' : '' }}"
                                    value="{{ $register->register_receiving_address }}">
                                <div class="alert-error error hidden register_receiving_address">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="register_receiving_address_message"></span>
                                </div>
                                <span class="form-label">@lang('conference.en.address')</span>
                            </div>
                            <div class="form-element">
                                <label>@lang('conference.en.image')</label>
                                <input type="file" name="register_image"
                                    class="filepond register_image {{ $register->register_image == '' ? '' : 'hidden' }}">
                                @if ($register->register_image)
                                    <div class="section-file register_image_section">
                                        <div class="file-content">
                                            <div class="file-name">
                                                <p>@lang('conference.en.image')</p>
                                            </div>
                                            <div class="file-action">
                                                <a href="https://drive.google.com/file/d/{{ $register->register_image }}/view"
                                                    target="_blank" class="dowload-file">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                                <button class="delete-file " type="button"
                                                    onclick="deleteFile('register_image','{{ $register->register_image }}', '{{ $register->id }}')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="form-element">
                                <label>@lang('conference.en.image_card')</label>
                                <input type="file" name="register_image_card"
                                    class="filepond register_image_card {{ $register->register_image_card == '' ? '' : 'hidden' }}">
                                @if ($register->register_image_card)
                                    <div class="section-file register_image_card_section">
                                        <div class="file-content">
                                            <div class="file-name">
                                                <p>@lang('conference.en.image_card')</p>
                                            </div>
                                            <div class="file-action">
                                                <a href="https://drive.google.com/file/d/{{ $register->register_image_card }}/view"
                                                    target="_blank" class="dowload-file">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                                <button class="delete-file" type="button"
                                                    onclick="deleteFile('register_image_card','{{ $register->register_image_card }}', '{{ $register->id }}')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="form-element">
                                <label>@lang('conference.en.transfer_image')</label>
                                <input type="file" name="payment_image"
                                    class="filepond payment_image {{ $register->payment_image == '' ? '' : 'hidden' }}">
                                @if ($register->payment_image)
                                    <div class="section-file payment_image_section">
                                        <div class="file-content">
                                            <div class="file-name">
                                                <p>@lang('conference.en.transfer_image')</p>
                                            </div>
                                            <div class="file-action">
                                                <a href="https://drive.google.com/file/d/{{ $register->payment_image }}/view"
                                                    target="_blank" class="dowload-file">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                                <button class="delete-file" type="button"
                                                    onclick="deleteFile('payment_image', '{{ $register->payment_image }}', '{{ $register->id }}')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="form-element">
                                <label>@lang('conference.en.status.status')</label>
                                <select class="select-textbox" name="payment_status">
                                    @if ($register->payment_status == 1)
                                        <option value="1" selected>@lang('conference.en.status.step1')</option>
                                        <option value="2">@lang('conference.en.status.step2')</option>
                                        <option value="3">@lang('conference.en.status.step3')</option>
                                        <option value="4">@lang('conference.en.status.step4')</option>
                                    @elseif($register->payment_status == 2)
                                        <option disabled>@lang('conference.en.status.step1')</option>
                                        <option value="2" selected>@lang('conference.en.status.step2')</option>
                                        <option value="3">@lang('conference.en.status.step3')</option>
                                        <option value="4">@lang('conference.en.status.step4')</option>
                                    @elseif($register->payment_status == 3)
                                        <option disabled>@lang('conference.en.status.step1')</option>
                                        <option disabled>@lang('conference.en.status.step2')</option>
                                        <option value="3" selected>@lang('conference.en.status.step3')</option>
                                        <option value="4">@lang('conference.en.status.step4')</option>
                                    @elseif($register->payment_status == 4)
                                        <option disabled>@lang('conference.en.status.step1')</option>
                                        <option disabled>@lang('conference.en.status.step2')</option>
                                        <option disabled>@lang('conference.en.status.step3')</option>
                                        <option value="4" selected>@lang('conference.en.status.step4')</option>
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
        var url_update = "{{ route('conference_register.update', $code) }}";
    </script>
    <script src="{{ versionResource('assets/js/conference/update.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/file/filepond.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/file/filepond-preview.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/essential.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/file/handle-file.js') }}" defer></script>
@endpush