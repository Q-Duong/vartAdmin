@extends('layouts.default_auth')
@section('title', __('vart_define.button.update') . ' ' . __('conference.en.en_register_title') . ' - ')
@push('css')
    <link rel="stylesheet" href="{{ versionResource('assets/styles/landing/web/app-eyebrow.css') }}" type="text/css"
        as="style">
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
                            <input type="hidden" name="en_register_id" value="{{ $en_register->id }}">
                            <div class="form-element">
                                <span class="select-label">@lang('conference.en.title.title')</span>
                                <select class="select-textbox" name="en_register_title">
                                    <option value="@lang('conference.en.title.mr')"
                                        {{ $en_register->en_register_title == 'Mr.' ? 'selected' : '' }}>@lang('conference.en.title.mr')
                                    </option>
                                    <option value="@lang('conference.en.title.ms')"
                                        {{ $en_register->en_register_title == 'Ms.' ? 'selected' : '' }}>@lang('conference.en.title.ms')
                                    </option>
                                    <option value="@lang('conference.en.title.mrs')"
                                        {{ $en_register->en_register_title == 'Mrs.' ? 'selected' : '' }}>@lang('conference.en.title.mrs')
                                    </option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-element">
                                        <input type="text" name="en_register_firstname"
                                            class="form-textbox {{ $en_register->en_register_firstname ? 'form-textbox-entered' : '' }}"
                                            value="{{ $en_register->en_register_firstname }}">
                                        <div class="alert-error error hidden en_register_firstname">
                                            <i class="fa fa-exclamation-circle"></i>
                                            <span class="en_register_firstname_message"></span>
                                        </div>
                                        <span class="form-label">@lang('conference.en.firstname')</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-element">
                                        <input type="text" name="en_register_lastname"
                                            class="form-textbox {{ $en_register->en_register_lastname ? 'form-textbox-entered' : '' }}"
                                            value="{{ $en_register->en_register_lastname }}">
                                        <div class="alert-error error hidden en_register_lastname">
                                            <i class="fa fa-exclamation-circle"></i>
                                            <span class="en_register_lastname_message"></span>
                                        </div>
                                        <span class="form-label">@lang('conference.en.lastname')</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-element">
                                <span class="select-label">@lang('conference.en.gender')</span>
                                <select class="select-textbox" name="en_register_gender">
                                    <option value="0" {{ $en_register->en_register_gender == 0 ? 'selected' : '' }}>
                                        @lang('conference.en.male')</option>
                                    <option value="1" {{ $en_register->en_register_gender == 1 ? 'selected' : '' }}>
                                        @lang('conference.en.female')</option>
                                </select>
                            </div>
                            <div class="form-element">
                                <input type="text" name="en_register_work_unit"
                                    class="form-textbox {{ $en_register->en_register_work_unit ? 'form-textbox-entered' : '' }}"
                                    value="{{ $en_register->en_register_work_unit }}">
                                <div class="alert-error error hidden en_register_work_unit">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="en_register_work_unit_message"></span>
                                </div>
                                <span class="form-label">@lang('conference.en.official_company')</span>
                            </div>
                            <div class="form-element">
                                <span class="select-label">@lang('conference.en.country')</span>
                                <select class="select-textbox" name="en_register_nation">
                                    @foreach ($getAllCountries as $key => $countries)
                                        <option value="{{ $countries->country_name }}"
                                            {{ $countries->country_name == $en_register->en_register_nation ? 'selected' : '' }}>
                                            {{ $countries->country_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-element">
                                <input type="text" name="en_register_email"
                                    class="form-textbox {{ $en_register->en_register_email ? 'form-textbox-entered' : '' }}"
                                    value="{{ $en_register->en_register_email }}">
                                <div class="alert-error error hidden en_register_email">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="en_register_email_message"></span>
                                </div>
                                <span class="form-label">@lang('conference.en.email')</span>
                            </div>
                            <div class="form-element">
                                <input type="text" name="en_register_phone"
                                    class="form-textbox {{ $en_register->en_register_phone ? 'form-textbox-entered' : '' }}"
                                    value="{{ $en_register->en_register_phone }}">
                                <div class="alert-error error hidden en_register_phone">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="en_register_phone_message"></span>
                                </div>
                                <span class="form-label">@lang('conference.en.phone')</span>
                            </div>
                            <div class="form-element">
                                <span class="select-label">@lang('conference.en.status.status')</span>
                                <select class="select-textbox"  name="payment_status">
                                    @if ($en_register->payment->payment_status == 1)
                                        <option value="1" selected>@lang('conference.en.status.step1')</option>
                                        <option value="2">@lang('conference.en.status.step2')</option>
                                        <option value="3">@lang('conference.en.status.step3')</option>
                                        <option value="4">@lang('conference.en.status.step4')</option>
                                    @elseif($en_register->payment->payment_status == 2)
                                        <option disabled>@lang('conference.en.status.step1')</option>
                                        <option value="2" selected>@lang('conference.en.status.step2')</option>
                                        <option value="3">@lang('conference.en.status.step3')</option>
                                        <option value="4">@lang('conference.en.status.step4')</option>
                                    @elseif($en_register->payment->payment_status == 3)
                                        <option disabled>@lang('conference.en.status.step1')</option>
                                        <option disabled>@lang('conference.en.status.step2')</option>
                                        <option value="3" selected>@lang('conference.en.status.step3')</option>
                                        <option value="4">@lang('conference.en.status.step4')</option>
                                    @elseif($en_register->payment->payment_status == 4)
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
        var url_update = "{{ route('conference_en_register.update', $code) }}";
    </script>
    <script src="{{ versionResource('assets/js/conference/update.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/essential.js') }}" defer></script>
@endpush
