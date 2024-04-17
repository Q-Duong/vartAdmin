@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật đăng ký hội nghị
                    <span class="tools pull-right">
                        <a href="{{ Route('listConferenceRegister') }}" class="primary-btn-submit">Quản lý</a>
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form action="{{ Route('updateConferenceRegisterInternational', $en_register->en_register_id) }}"
                            method="post">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label>@lang('conference.title')</label>
                                <select name="en_register_title" class="input-control">
                                    <option value="Mr." {{ $en_register->en_register_title == 'Mr.' ? 'selected' : '' }}>
                                        Mr.</option>
                                    <option value="Ms." {{ $en_register->en_register_title == 'Ms.' ? 'selected' : '' }}>
                                        Ms.</option>
                                    <option value="Mrs."
                                        {{ $en_register->en_register_title == 'Mrs.' ? 'selected' : '' }}>Mrs.</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('en_register_firstname') ? 'has-error' : '' }}">
                                        <label>@lang('conference.firstname')</label>
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
                                        <label>@lang('conference.lastname')</label>
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
                                <label>@lang('conference.gender')</label>
                                <select name="en_register_gender" class="input-control">
                                    <option value="0" {{ $en_register->en_register_gender == 0 ? 'selected' : '' }}>
                                        @lang('conference.male')</option>
                                    <option value="1" {{ $en_register->en_register_gender == 1 ? 'selected' : '' }}>
                                        @lang('conference.female')</option>
                                </select>
                            </div>
                            <div class="form-group {{ $errors->has('en_register_work_unit') ? 'has-error' : '' }}">
                                <label>@lang('conference.unit_label')</label>
                                <input type="text" name="en_register_work_unit" class="input-control"
                                    value="{{ $en_register->en_register_work_unit }}">
                                    {!! $errors->first(
                                        'en_register_work_unit',
                                        '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                    ) !!}
                            </div>
                            <div class="form-group">
                                <label>@lang('conference.nation')</label>
                                <select name="en_register_nation" class="select-2">
                                    @foreach ($getAllCountries as $key => $countries)
                                        <option value="{{ $countries->country_name }}"
                                            {{ $countries->country_name == $en_register->en_register_nation ? 'selected' : '' }}>
                                            {{ $countries->country_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group {{ $errors->has('en_register_email') ? 'has-error' : '' }}">
                                <label>@lang('conference.email')</label>
                                <input type="text" name="en_register_email" class="input-control"
                                    value="{{ $en_register->en_register_email }}">
                                    {!! $errors->first(
                                        'en_register_email',
                                        '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                    ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('en_register_phone') ? 'has-error' : '' }}">
                                <label>@lang('conference.phone')</label>
                                <input type="text" name="en_register_phone" class="input-control"
                                    value="{{ $en_register->en_register_phone }}">
                                    {!! $errors->first(
                                        'en_register_phone',
                                        '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                    ) !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Status</label>
                                <select name="payment_status" class="input-control">
                                    @if ($en_register->payment->payment_status == 1)
                                        <option value="1" selected>Wait checking</option>
                                        <option value="2">Completly payment and Wait checking</option>
                                        <option value="3">Waiting for addition</option>
                                        <option value="4">Processed and sent mail</option>
                                    @elseif($en_register->payment->payment_status == 2)
                                        <option disabled>Wait checking</option>
                                        <option value="2" selected>Completly payment and Wait checking</option>
                                        <option value="3">Waiting for addition</option>
                                        <option value="4">Processed and sent mail</option>
                                    @elseif($en_register->payment->payment_status == 3)
                                        <option disabled>Wait checking</option>
                                        <option disabled>Completly payment and Wait checking</option>
                                        <option value="3" selected>Waiting for addition</option>
                                        <option value="4">Processed and sent mail</option>
                                    @elseif($en_register->payment->payment_status == 4)
                                        <option disabled>Wait checking</option>
                                        <option disabled>Completly payment and Wait checking</option>
                                        <option disabled>Waiting for addition</option>
                                        <option value="4" selected>Processed and sent mail</option>
                                    @endif
                                </select>
                            </div>
                            <button type="submit" class="primary-btn-submit button-submit">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ versionResource('assets/js/support/tool-submit.js') }}" defer></script>
@endpush
