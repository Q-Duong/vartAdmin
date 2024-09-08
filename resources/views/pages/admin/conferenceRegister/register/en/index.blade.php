@extends('layouts.default_auth')
@section('title', __('conference.en.en_register_title') . ' - ')
@section('content')
    <div class="table-agile-info">
        <div class="panel-heading">
            @lang('conference.en.en_register_title')
        </div>
        <div class="table-responsive table-content">
            <table class="table table-striped b-t b-light table-bordered">
                <thead>
                    <tr>
                        <th>@lang('conference.en.create')</th>
                        <th>@lang('conference.en.id')</th>
                        <th>@lang('conference.en.code')</th>
                        <th>@lang('conference.en.title.title')</th>
                        <th>@lang('conference.en.firstname')</th>
                        <th>@lang('conference.en.lastname')</th>
                        <th>@lang('conference.en.gender')</th>
                        <th>@lang('conference.en.official_company')</th>
                        <th>@lang('conference.en.country')</th>
                        <th>@lang('conference.en.email')</th>
                        <th>@lang('conference.en.phone')</th>
                        <th>@lang('conference.en.type_register')</th>
                        <th>@lang('conference.en.cost')</th>
                        <th>@lang('conference.en.status.status')</th>
                        <th>@lang('conference.en.management')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getAllConferenceRegisterInternational as $key => $en_register)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($en_register->created_at)->format('H:i:s d/m/Y') }}</td>
                            <td>{{ $en_register->id }}</td>
                            <td>{{ $en_register->en_register_code }}</td>
                            <td>{{ $en_register->en_register_title }}</td>
                            <td>{{ $en_register->en_register_firstname }}</td>
                            <td>{{ $en_register->en_register_lastname }}</td>
                            <td>{{ $en_register->en_register_gender == 0 ? 'Male' : 'Female' }}</td>
                            <td>{{ $en_register->en_register_work_unit }}</td>
                            <td>{{ $en_register->en_register_nation }}</td>
                            <td>{{ $en_register->en_register_email }}</td>
                            <td>{{ $en_register->en_register_phone }}</td>
                            <td>{{ $en_register->conference_fee_title }}</td>
                            <td>{{ '$' . number_format($en_register->payment_price, 2) }}</td>
                            <td>
                                @if ($en_register->payment_status == 1)
                                    <span style="color: #27c24c;">@lang('conference.en.status.step1')</span>
                                @elseif ($en_register->payment_status == 2)
                                    <span style="color: #FCB322;">@lang('conference.en.status.step2')</span>
                                @elseif ($en_register->payment_status == 3)
                                    <span style="color: #c037df;">@lang('conference.en.status.step3')</span>
                                @elseif ($en_register->payment_status == 4)
                                    <span style="color: #0071e3;">@lang('conference.en.status.step4')</span>
                                @endif
                            </td>
                            <td class="management">
                                <a href="{{ Route('conference_en_register.edit', [$conference->conference_code, $en_register->id]) }}"
                                    class="management-btn" title="@lang('vart_define.button.update')"><i
                                        class="fa fa-pencil-square-o text-success text-active"></i>
                                </a>
                                <form action="{{ Route('conference_en_register.destroy', $en_register->id) }}"
                                    method="POST" id="delete-form">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="management-btn button-delete"
                                        title="@lang('vart_define.button.delete')"><i class="fa fa-times text-danger text"></i></button>
                                </form>
                                <form action="{{ Route('mail.reply', $en_register->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="type" value="en_register">
                                    <button type="submit" class="management-btn button-submit"
                                        title="@lang('vart_define.button.mail')"><i class="far fa-envelope btn-mail"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $getAllConferenceRegisterInternational->links('pagination::custom') }}
        <div class="export-excel">
            <form action="{{ route('export.excel') }}" method="POST">
                @csrf
                <input type="hidden" name="conference_id" value="{{ $conference->id }}">
                <input type="hidden" name="export_type" value="enrt">
                <div class="col-md-3">
                    <button type="submit" class="primary-btn-filter">@lang('conference.en.export_excel')</button>
                </div>
            </form>
        </div>
    </div>
@endsection
