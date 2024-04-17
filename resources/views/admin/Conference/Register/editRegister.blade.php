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
                        <form action="{{ Route('updateConferenceRegister', $register->register_id) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="form-group {{ $errors->has('register_object_group') ? 'has-error' : '' }}">
                                <label>@lang('conference.object_group')</label>
                                <input type="text" name="register_object_group" class="input-control"
                                    value="{{ $register->register_object_group }}">
                                    {!! $errors->first(
                                        'register_object_group',
                                        '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                    ) !!}
                            </div>
                            <div class="form-group">
                                <label>@lang('conference.degree')</label>
                                <select name="register_degree" class="input-control">
                                    @foreach ($getAllAcademic as $key => $academic)
                                        <option value="{{ $academic->academic_title }}"
                                            {{ $academic->academic_title == $register->register_degree ? 'selected' : '' }}>
                                            {{ $academic->academic_title }}
                                        </option>
                                    @endforeach
                                    <option value="">Trống</option>
                                </select>
                            </div>
                            <div class="form-group {{ $errors->has('register_name') ? 'has-error' : '' }}">
                                <label>@lang('conference.fullname')</label>
                                <input type="text" name="register_name" class="input-control"
                                     value="{{ $register->register_name }}">
                                     {!! $errors->first(
                                        'register_name',
                                        '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                    ) !!}
                            </div>
                            <div class="form-group">
                                <label>@lang('conference.gender')</label>
                                <select name="register_gender" class="input-control">
                                    <option value="0" {{ $register->register_gender == 0 ? 'selected' : '' }}>Nam</option>
                                    <option value="1" {{ $register->register_gender == 1 ? 'selected' : '' }}>Nữ</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>@lang('conference.date')</label>
                                        <select name="register_date" class="input-control">
                                            @for ($i = 1; $i <= 31; $i++)
                                                <option value="{{ $i }}" {{ $register->register_date == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>@lang('conference.month')</label>
                                        <select name="register_month" class="input-control">
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}" {{ $register->register_month == $i ? 'selected' : '' }}>{{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>@lang('conference.year')</label>
                                        <select name="register_year" class="input-control">
                                            @for ($i = 1940; $i < 2010; $i++)
                                                <option value="{{ $i }}" {{ $register->register_year == $i ? 'selected' : '' }}>{{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('register_work_unit') ? 'has-error' : '' }}">
                                <label>@lang('conference.unit')</label>
                                <input type="text" name="register_work_unit" class="input-control"
                                     value="{{ $register->register_work_unit }}">
                                     {!! $errors->first(
                                        'register_work_unit',
                                        '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                    ) !!}
                            </div>
                            <div class="form-group">
                                <label>@lang('conference.place_of_birth')</label>
                                <select name="register_place_of_birth" class="input-control">
                                    @foreach ($getAllProvince as $key => $province)
                                        <option value="{{ $province->province_name }}"
                                            {{ $province->province_name == $register->register_place_of_birth ? 'selected' : '' }}>
                                            {{ $province->province_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group {{ $errors->has('register_nation') ? 'has-error' : '' }}">
                                <label>@lang('conference.nation')</label>
                                <input type="text" name="register_nation" class="input-control"
                                     value="{{ $register->register_nation }}">
                                     {!! $errors->first(
                                        'register_nation',
                                        '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                    ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('register_email') ? 'has-error' : '' }}">
                                <label>@lang('conference.email')</label>
                                <input type="text" name="register_email" class="input-control"
                                     value="{{ $register->register_email }}">
                                     {!! $errors->first(
                                        'register_email',
                                        '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                    ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('register_phone') ? 'has-error' : '' }}">
                                <label>@lang('conference.phone')</label>
                                <input type="text" name="register_phone" class="input-control"
                                     value="{{ $register->register_phone }}">
                                     {!! $errors->first(
                                        'register_phone',
                                        '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                    ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('register_graduation_year') ? 'has-error' : '' }}">
                                <label>@lang('conference.graduation_year')</label>
                                <input type="text" name="register_graduation_year" class="input-control"
                                    value="{{ $register->register_graduation_year }}">
                            </div>
                            <div class="form-group {{ $errors->has('register_receiving_address') ? 'has-error' : '' }}">
                                <label>Địa chỉ nhận CME</label>
                                <input type="text" name="register_receiving_address" class="input-control"
                                     value="{{ $register->register_receiving_address }}">
                                     {!! $errors->first(
                                        'register_receiving_address',
                                        '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                    ) !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Trạng thái</label>
                                <select name="payment_status" class="input-control">
                                    @if ($register->payment->payment_status == 1)
                                        <option value="1" selected>Chờ kiểm tra</option>
                                        <option value="2">Đã thanh toán và chờ kiểm tra</option>
                                        <option value="3">Chờ bổ sung</option>
                                        <option value="4">Đã kiểm tra và gửi mail</option>
                                    @elseif($register->payment->payment_status == 2)
                                        <option disabled>Chờ kiểm tra</option>
                                        <option value="2" selected>Đã thanh toán và chờ kiểm tra</option>
                                        <option value="3">Chờ bổ sung</option>
                                        <option value="4">Đã kiểm tra và gửi mail</option>
                                    @elseif($register->payment->payment_status == 3)
                                        <option disabled>Chờ kiểm tra</option>
                                        <option disabled>Đã thanh toán và chờ kiểm tra</option>
                                        <option value="3" selected>Chờ bổ sung</option>
                                        <option value="4">Đã kiểm tra và gửi mail</option>
                                    @elseif($register->payment->payment_status == 4)
                                        <option disabled>Chờ kiểm tra</option>
                                        <option disabled>Đã thanh toán và chờ kiểm tra</option>
                                        <option disabled>Chờ bổ sung</option>
                                        <option value="4" selected>Đã kiểm tra và gửi mail</option>
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