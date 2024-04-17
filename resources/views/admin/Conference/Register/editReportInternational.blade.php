@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Updated international reporting register
                    <span class="tools pull-right">
                        <a href="{{ Route('listConferenceReportInternational') }}" class="primary-btn-submit">Quản lý</a>
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form action="{{ Route('updateConferenceReportInternational', $en_report->en_report_id) }}"
                            method="post">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label>@lang('conference.title')</label>
                                <select name="en_report_title" class="input-control">
                                    <option value="Mr." {{ $en_report->en_report_title == 'Mr.' ? 'selected' : '' }}>Mr.
                                    </option>
                                    <option value="Ms." {{ $en_report->en_report_title == 'Ms.' ? 'selected' : '' }}>Ms.
                                    </option>
                                    <option value="Mrs." {{ $en_report->en_report_title == 'Mrs.' ? 'selected' : '' }}>
                                        Mrs.</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('en_report_firstname') ? 'has-error' : '' }}">
                                        <label>@lang('conference.firstname')</label>
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
                                        <label>@lang('conference.lastname')</label>
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
                                        <label>@lang('conference.date')</label>
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
                                        <label>@lang('conference.month')</label>
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
                                        <label>@lang('conference.year')</label>
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
                                <label>@lang('conference.email')</label>
                                <input type="text" name="en_report_email" class="input-control"
                                    value="{{ $en_report->en_report_email }}">
                                {!! $errors->first(
                                    'en_report_email',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group">
                                <label>@lang('conference.profession')</label>
                                <select name="en_report_profession" class="input-control">
                                    <option value="Radiologist"
                                        {{ $en_report->en_report_profession == 'Radiologist' ? 'selected' : '' }}>
                                        Radiologist</option>
                                    <option value="Technologist"
                                        {{ $en_report->en_report_profession == 'Technologist' ? 'selected' : '' }}>
                                        Technologist</option>
                                    <option value="Physicist"
                                        {{ $en_report->en_report_profession == 'Physicist' ? 'selected' : '' }}>Physicist
                                    </option>
                                    <option value="Engineer"
                                        {{ $en_report->en_report_profession == 'Engineer' ? 'selected' : '' }}>Engineer
                                    </option>
                                    <option value="Other"
                                        {{ $en_report->en_report_profession == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            <div class="form-group {{ $errors->has('en_report_organization') ? 'has-error' : '' }}">
                                <label>@lang('conference.organization')</label>
                                <input type="text" name="en_report_organization" class="input-control"
                                    value="{{ $en_report->en_report_organization }}">
                                {!! $errors->first(
                                    'en_report_organization',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('en_report_department') ? 'has-error' : '' }}">
                                <label>@lang('conference.department')</label>
                                <input type="text" name="en_report_department" class="input-control"
                                    value="{{ $en_report->en_report_department }}">
                                {!! $errors->first(
                                    'en_report_department',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group">
                                <label>@lang('conference.nation')</label>
                                <select name="en_report_nationality" class="select-2">
                                    @foreach ($getAllCountries as $key => $countries)
                                        <option value="{{ $countries->country_name }}"
                                            {{ $countries->country_name == $en_report->en_report_nationality ? 'selected' : '' }}>
                                            {{ $countries->country_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group {{ $errors->has('en_report_file_title') ? 'has-error' : '' }}">
                                <label>@lang('conference.file_title')</label>
                                <input type="text" name="en_report_file_title" class="input-control"
                                    value="{{ $en_report->en_report_file_title }}">
                                {!! $errors->first(
                                    'en_report_file_title',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Status</label>
                                <select name="en_report_status" class="input-control">
                                    @if ($en_report->en_report_status == 1)
                                        <option value="1" selected>Wait checking</option>
                                        <option value="2">Processed</option>
                                        <option value="3">Processed and sent mail</option>
                                    @elseif($en_report->en_report_status == 2)
                                        <option disabled>Wait checking</option>
                                        <option value="2" selected>Processed</option>
                                        <option value="3">Processed and sent mail</option>
                                    @elseif($en_report->en_report_status == 3)
                                        <option disabled>Wait checking</option>
                                        <option disabled>Processed</option>
                                        <option selected>Processed and sent mail</option>
                                    @endif
                                </select>
                            </div>
                            <button type="submit" class="primary-btn-submit button-submit">Update</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
