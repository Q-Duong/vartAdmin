@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật đăng ký báo cáo
                    <span class="tools pull-right">
                        <a href="{{ Route('listConferenceReport') }}" class="primary-btn-submit">Quản lý</a>
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form action="{{ Route('updateConferenceReport', $report->report_id) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label>@lang('conference.degree')</label>
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
                                <label>@lang('conference.fullname')</label>
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
                                        <label>@lang('conference.date')</label>
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
                                        <label>@lang('conference.month')</label>
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
                                        <label>@lang('conference.year')</label>
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
                                <label>@lang('conference.gender')</label>
                                <select name="report_gender" class="input-control">
                                    <option value="0" {{ $report->report_gender == 0 ? 'selected' : '' }}>
                                        @lang('conference.male')</option>
                                    <option value="1" {{ $report->report_gender == 1 ? 'selected' : '' }}>
                                        @lang('conference.female')</option>
                                </select>
                            </div>
                            <div class="form-group {{ $errors->has('report_work_unit') ? 'has-error' : '' }}">
                                <label>@lang('conference.unit')</label>
                                <input type="text" name="report_work_unit" class="input-control"
                                    value="{{ $report->report_work_unit }}">
                                {!! $errors->first(
                                    'report_work_unit',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group">
                                <label>@lang('conference.place_of_birth')</label>
                                <select name="report_place_of_birth" class="input-control">
                                    @foreach ($getAllProvince as $key => $province)
                                        <option value="{{ $province->province_name }}"
                                            {{ $province->province_name == $report->report_place_of_birth ? 'selected' : '' }}>
                                            {{ $province->province_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group {{ $errors->has('report_email') ? 'has-error' : '' }}">
                                <label>@lang('conference.email')</label>
                                <input type="text" name="report_email" class="input-control"
                                    value="{{ $report->report_email }}">
                                {!! $errors->first(
                                    'report_email',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('report_phone') ? 'has-error' : '' }}">
                                <label>@lang('conference.phone')</label>
                                <input type="text" name="report_phone" class="input-control"
                                    value="{{ $report->report_phone }}">
                                {!! $errors->first(
                                    'report_phone',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('report_graduation_year') ? 'has-error' : '' }}">
                                <label>@lang('conference.graduation_year')</label>
                                <input type="text" name="report_graduation_year" class="input-control"
                                    value="{{ $report->report_graduation_year }}">
                                {!! $errors->first(
                                    'report_graduation_year',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Trạng thái</label>
                                <select name="report_status" class="input-control">
                                    @if ($report->report_status == 1)
                                        <option value="1" selected>Chờ kiểm tra</option>
                                        <option value="2">Đã kiểm tra</option>
                                        <option value="3">Đã kiểm tra và gửi mail</option>
                                    @elseif($report->report_status == 2)
                                        <option disabled>Chờ kiểm tra</option>
                                        <option value="2" selected>Đã kiểm tra</option>
                                        <option value="3">Đã kiểm tra và gửi mail</option>
                                    @elseif($report->report_status == 3)
                                        <option disabled>Chờ kiểm tra</option>
                                        <option disabled>Đã kiểm tra</option>
                                        <option selected>Đã kiểm tra và gửi mail</option>
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
