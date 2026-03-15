@extends('layouts.default_auth')
@section('title', __('vart_define.button.update') . ' ' . __('conference.en.en_register_title') . ' - ')
@push('css')
    <link rel="stylesheet" href="{{ versionResource('assets/styles/landing/web/form.built.css') }}" type="text/css"
        as="style" />
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    @lang('vart_define.button.update') @lang('conference.en.en_register_title')
                    <span class="tools pull-right">
                        <a href="{{ Route('conference_en_register.index', $code) }}"
                            class="primary-btn-submit">@lang('conference.en.en_register_title')</a>
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form id="update-form">
                            @csrf
                            <input type="hidden" name="register_id" value="{{ $register->id }}">
                            <div class="form-dropdown">
                                <select class="form-dropdown-select" name="member_title" disabled>
                                    <option value="@lang('conference.en.title.mr')"
                                        {{ $register->member->member_title == 'Mr.' ? 'selected' : '' }}>@lang('conference.en.title.mr')
                                    </option>
                                    <option value="@lang('conference.en.title.ms')"
                                        {{ $register->member->member_title == 'Ms.' ? 'selected' : '' }}>@lang('conference.en.title.ms')
                                    </option>
                                    <option value="@lang('conference.en.title.mrs')"
                                        {{ $register->member->member_title == 'Mrs.' ? 'selected' : '' }}>@lang('conference.en.title.mrs')
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
                                            class="form-textbox-input {{ $register->member->member_first_name ? 'form-textbox-entered' : '' }}"
                                            value="{{ \Str::title($register->member->member_first_name) }}" disabled>
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
                                            class="form-textbox-input {{ $register->member->member_last_name ? 'form-textbox-entered' : '' }}"
                                            value="{{ \Str::title($register->member->member_last_name) }}" disabled>
                                        <div class="form-message-wrapper member_last_name">
                                            <i class="fa fa-exclamation-circle"></i>
                                            <span class="member_last_name-form-message"></span>
                                        </div>
                                        <span class="form-textbox-label">@lang('conference.en.lastname')</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-dropdown">
                                <select class="form-dropdown-select" name="member_gender" disabled>
                                    <option value="0" {{ $register->member->member_gender == 0 ? 'selected' : '' }}>
                                        @lang('conference.en.male')</option>
                                    <option value="1" {{ $register->member->member_gender == 1 ? 'selected' : '' }}>
                                        @lang('conference.en.female')</option>
                                </select>
                                <span class="form-dropdown-chevron" aria-hidden="true"><i
                                        class="fa-solid fa-angle-down"></i></span>
                                <span class="form-dropdown-label">@lang('conference.en.gender')</span>
                            </div>

                            <div class="form-textbox">
                                <input type="text" name="member_work_unit"
                                    class="form-textbox-input {{ $register->member->member_work_unit ? 'form-textbox-entered' : '' }}"
                                    value="{{ $register->member->member_work_unit }}" disabled>
                                <div class="form-message-wrapper member_work_unit">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="member_work_unit-form-message"></span>
                                </div>
                                <span class="form-textbox-label">@lang('conference.en.official_company')</span>
                            </div>

                            <div class="form-dropdown">
                                <select class="form-dropdown-select" name="member_country" disabled>
                                    @foreach ($getAllCountries as $key => $countries)
                                        <option value="{{ $countries->country_name }}"
                                            {{ $countries->country_name == $register->member->member_country ? 'selected' : '' }}>
                                            {{ $countries->country_name }}</option>
                                    @endforeach
                                </select>
                                <span class="form-dropdown-chevron" aria-hidden="true"><i
                                        class="fa-solid fa-angle-down"></i></span>
                                <span class="form-dropdown-label">@lang('conference.en.country')</span>
                            </div>

                            <div class="form-textbox">
                                <input type="text" name="member_email"
                                    class="form-textbox-input {{ $register->member->member_email ? 'form-textbox-entered' : '' }}"
                                    value="{{ $register->member->member_email }}" disabled>
                                <div class="form-message-wrapper member_email">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="member_email-form-message"></span>
                                </div>
                                <span class="form-textbox-label">@lang('conference.en.email')</span>
                            </div>

                            <div class="form-textbox">
                                <input type="text" name="member_phone"
                                    class="form-textbox-input {{ $register->member->member_phone ? 'form-textbox-entered' : '' }}"
                                    value="{{ $register->member->member_phone }}">
                                <div class="form-message-wrapper member_phone">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="member_phone-form-message"></span>
                                </div>
                                <span class="form-textbox-label">@lang('conference.en.phone')</span>
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
        var url_update = "{{ route('conference_en_register.update', $code) }}";
    </script>
    <script src="{{ versionResource('assets/js/conference/update.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/essential.js') }}" defer></script>
@endpush
