@extends('layouts.default_auth')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    @lang('vart_define.button.update') @lang('conference.en.en_register_title')
                    <span class="tools pull-right">
                        <a href="{{ Route('conference_en_register.index') }}" class="primary-btn-submit">@lang('conference.en.en_register_title')</a>
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form action="{{ Route('conference_en_register.update', $en_register->id) }}"
                            method="post">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label>@lang('conference.en.title.title')</label>
                                <select name="en_register_title" class="input-control">
                                    <option value="@lang('conference.en.title.mr')" {{ $en_register->en_register_title == 'Mr.' ? 'selected' : '' }}>@lang('conference.en.title.mr')</option>
                                    <option value="@lang('conference.en.title.ms')" {{ $en_register->en_register_title == 'Ms.' ? 'selected' : '' }}>@lang('conference.en.title.ms')</option>
                                    <option value="@lang('conference.en.title.mrs')"
                                        {{ $en_register->en_register_title == 'Mrs.' ? 'selected' : '' }}>@lang('conference.en.title.mrs')</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('en_register_firstname') ? 'has-error' : '' }}">
                                        <label>@lang('conference.en.firstname')</label>
                                        <input type="text" name="en_register_firstname" class="input-control"
                                            value="{{ $en_register->en_register_firstname }}">
                                            {!! $errors->first(
                                                'en_register_firstname',
                                                '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                            ) !!}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('en_register_lastname') ? 'has-error' : '' }}">
                                        <label>@lang('conference.en.lastname')</label>
                                        <input type="text" name="en_register_lastname" class="input-control"
                                            value="{{ $en_register->en_register_lastname }}">
                                            {!! $errors->first(
                                                'en_register_lastname',
                                                '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                            ) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>@lang('conference.en.gender')</label>
                                <select name="en_register_gender" class="input-control">
                                    <option value="0" {{ $en_register->en_register_gender == 0 ? 'selected' : '' }}>
                                        @lang('conference.en.male')</option>
                                    <option value="1" {{ $en_register->en_register_gender == 1 ? 'selected' : '' }}>
                                        @lang('conference.en.female')</option>
                                </select>
                            </div>
                            <div class="form-group {{ $errors->has('en_register_work_unit') ? 'has-error' : '' }}">
                                <label>@lang('conference.en.official_company')</label>
                                <input type="text" name="en_register_work_unit" class="input-control"
                                    value="{{ $en_register->en_register_work_unit }}">
                                    {!! $errors->first(
                                        'en_register_work_unit',
                                        '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                    ) !!}
                            </div>
                            <div class="form-group">
                                <label>@lang('conference.en.country')</label>
                                <select name="en_register_nation" class="select-2">
                                    @foreach ($getAllCountries as $key => $countries)
                                        <option value="{{ $countries->country_name }}"
                                            {{ $countries->country_name == $en_register->en_register_nation ? 'selected' : '' }}>
                                            {{ $countries->country_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group {{ $errors->has('en_register_email') ? 'has-error' : '' }}">
                                <label>@lang('conference.en.email')</label>
                                <input type="text" name="en_register_email" class="input-control"
                                    value="{{ $en_register->en_register_email }}">
                                    {!! $errors->first(
                                        'en_register_email',
                                        '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                    ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('en_register_phone') ? 'has-error' : '' }}">
                                <label>@lang('conference.en.phone')</label>
                                <input type="text" name="en_register_phone" class="input-control"
                                    value="{{ $en_register->en_register_phone }}">
                                    {!! $errors->first(
                                        'en_register_phone',
                                        '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                    ) !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">@lang('conference.en.status.status')</label>
                                <select name="payment_status" class="input-control">
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
    <script src="{{ versionResource('assets/js/support/essential.js') }}" defer></script>
@endpush
