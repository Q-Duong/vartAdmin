@extends('layouts.default_auth')
@push('css')
    <link href="{{ versionResource('assets/css/support/filepond.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    @lang('vart_define.button.update') @lang('conference.en.register_title')
                    <span class="tools pull-right">
                        <a href="{{ Route('conference_register.index') }}" class="primary-btn-submit">@lang('conference.en.register_title')</a>
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form action="{{ Route('conference_register.update', $register->register_id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="form-group {{ $errors->has('register_object_group') ? 'has-error' : '' }}">
                                <label>@lang('conference.en.object_group')</label>
                                <input type="text" name="register_object_group" class="input-control"
                                    value="{{ $register->register_object_group }}">
                                {!! $errors->first(
                                    'register_object_group',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group">
                                <label>@lang('conference.en.degree')</label>
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
                                <label>@lang('conference.en.fullname')</label>
                                <input type="text" name="register_name" class="input-control"
                                    value="{{ $register->register_name }}">
                                {!! $errors->first(
                                    'register_name',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group">
                                <label>@lang('conference.en.gender')</label>
                                <select name="register_gender" class="input-control">
                                    <option value="0" {{ $register->register_gender == 0 ? 'selected' : '' }}>
                                        @lang('conference.en.male')</option>
                                    <option value="1" {{ $register->register_gender == 1 ? 'selected' : '' }}>
                                        @lang('conference.en.female')</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>@lang('conference.en.date')</label>
                                        <select name="register_date" class="input-control">
                                            @for ($i = 1; $i <= 31; $i++)
                                                <option value="{{ $i }}"
                                                    {{ $register->register_date == $i ? 'selected' : '' }}>
                                                    {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>@lang('conference.en.month')</label>
                                        <select name="register_month" class="input-control">
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
                                    <div class="form-group">
                                        <label>@lang('conference.en.year')</label>
                                        <select name="register_year" class="input-control">
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
                            <div class="form-group {{ $errors->has('register_work_unit') ? 'has-error' : '' }}">
                                <label>@lang('conference.en.unit')</label>
                                <input type="text" name="register_work_unit" class="input-control"
                                    value="{{ $register->register_work_unit }}">
                                {!! $errors->first(
                                    'register_work_unit',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group">
                                <label>@lang('conference.en.place_of_birth')</label>
                                <select name="register_place_of_birth" class="input-control">
                                    @foreach ($getAllProvince as $key => $province)
                                        <option value="{{ $province->province_name }}"
                                            {{ $province->province_name == $register->register_place_of_birth ? 'selected' : '' }}>
                                            {{ $province->province_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group {{ $errors->has('register_nation') ? 'has-error' : '' }}">
                                <label>@lang('conference.en.nation')</label>
                                <input type="text" name="register_nation" class="input-control"
                                    value="{{ $register->register_nation }}">
                                {!! $errors->first(
                                    'register_nation',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('register_email') ? 'has-error' : '' }}">
                                <label>@lang('conference.en.email')</label>
                                <input type="text" name="register_email" class="input-control"
                                    value="{{ $register->register_email }}">
                                {!! $errors->first(
                                    'register_email',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('register_phone') ? 'has-error' : '' }}">
                                <label>@lang('conference.en.phone')</label>
                                <input type="text" name="register_phone" class="input-control"
                                    value="{{ $register->register_phone }}">
                                {!! $errors->first(
                                    'register_phone',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('register_graduation_year') ? 'has-error' : '' }}">
                                <label>@lang('conference.en.graduation_year')</label>
                                <input type="text" name="register_graduation_year" class="input-control"
                                    value="{{ $register->register_graduation_year }}">
                            </div>
                            <div class="form-group {{ $errors->has('register_receiving_address') ? 'has-error' : '' }}">
                                <label>@lang('conference.en.address')</label>
                                <input type="text" name="register_receiving_address" class="input-control"
                                    value="{{ $register->register_receiving_address }}">
                                {!! $errors->first(
                                    'register_receiving_address',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">@lang('conference.en.image')</label>
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
                                                    onclick="deleteFile('register_image','{{ $register->register_image }}', '{{ $register->register_id }}')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">@lang('conference.en.image_card')</label>
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
                                                    onclick="deleteFile('register_image_card','{{ $register->register_image_card }}', '{{ $register->register_id }}')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">@lang('conference.en.transfer_image')</label>
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
                                                    onclick="deleteFile('payment_image', '{{ $register->payment_image }}', '{{ $register->register_id }}')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">@lang('conference.en.status.status')</label>
                                <select name="payment_status" class="input-control">
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
    <script type="text/javascript" defer>
        var url_upload = "{{ route('upload') }}";
        var url_delete = "{{ route('delete', ':path') }}";
        var csrf = {"X-CSRF-TOKEN": "{{ csrf_token() }}"};
    </script>
    <script src="{{ versionResource('assets/js/support/filepond.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/essential.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/handle-file.js') }}" defer></script>
@endpush
