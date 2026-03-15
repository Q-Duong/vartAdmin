@extends('layouts.default_auth')
@section('title', __('conference.en.en_register_title') . ' - ')
@section('content')
    <div class="table-agile-info">
        <div class="panel-heading">
            @lang('conference.en.en_register_title') - {{ $conference->conference_title_en }}
        </div>
        <div class="table-responsive table-content">
            <div id="table-scroll" class="table-scroll">
                <table class="table">
                    <thead>
                        <tr class="section-title">
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
                        @foreach ($getAllConferenceRegister as $key => $register)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($register->created_at)->format('H:i:s d/m/Y') }}</td>
                                <td>{{ $register->id }}</td>
                                <td>{{ $register->register_code }}</td>
                                <td>{{ $register->member->member_title }}</td>
                                <td>{{ \Str::title($register->member->member_first_name) }}</td>
                                <td>{{ \Str::title($register->member->member_last_name) }}</td>
                                <td>{{ $register->member->member_gender == 0 ? 'Male' : 'Female' }}</td>
                                <td>{{ $register->member->member_work_unit }}</td>
                                <td>{{ $register->member->member_country }}</td>
                                <td>{{ $register->member->member_email }}</td>
                                <td>{{ $register->member->member_phone }}</td>
                                <td>{{ $register->fees->implode('conference_fee_title', ', ') }}</td>
                                <td>{{ '$' . number_format($register->payment->payment_price, 2) }}</td>
                                <td>
                                    @if ($register->payment->payment_status == 1)
                                        <span style="color: #27c24c;">@lang('conference.en.status.step1')</span>
                                    @elseif ($register->payment->payment_status == 2)
                                        <span style="color: #FCB322;">@lang('conference.en.status.step2')</span>
                                    @elseif ($register->payment->payment_status == 3)
                                        <span style="color: #c037df;">@lang('conference.en.status.step3')</span>
                                    @elseif ($register->payment->payment_status == 4)
                                        <span style="color: #0071e3;">@lang('conference.en.status.step4')</span>
                                    @endif
                                </td>
                                <td class="management">
                                    @can('isAdmin')
                                        <a href="{{ Route('conference_en_register.edit', [$conference->conference_code, $register->id]) }}"
                                            class="management-btn" title="@lang('vart_define.button.update')"><i
                                                class="fa fa-pencil-square-o text-success text-active"></i>
                                        </a>
                                        <form action="{{ Route('conference_en_register.destroy', $register->id) }}"
                                            method="POST" id="delete-form">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="management-btn button-delete"
                                                title="@lang('vart_define.button.delete')"><i class="fa fa-times text-danger text"></i></button>
                                        </form>
                                        <form action="{{ Route('mail.reply', $register->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="type" value="en_register">
                                            <button type="submit" class="management-btn button-submit"
                                                title="@lang('vart_define.button.mail')"><i class="far fa-envelope btn-mail"></i></button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @include('layouts.section.pagination_showing_current', [
            'items' => $getAllConferenceRegister,
        ])
        {{ $getAllConferenceRegister->links('pagination::custom') }}


        <div class="export-excel">
            <div class="col-md-2">
                <input type="hidden" name="current_page" value="{{ $getAllConferenceRegister->currentPage() }}">
                <form action="{{ route('export.excel') }}" method="POST">
                    @csrf
                    <input type="hidden" name="conference_id" value="{{ $conference->id }}">
                    <input type="hidden" name="export_type" value="enrt">
                    <button type="submit" class="primary-btn-filter">@lang('conference.en.export_excel')</button>

                </form>
            </div>
            @can('isAdmin')
                <div class="col-md-2">
                    <form action="{{ route('mail.certificate') }}" method="POST">
                        @csrf
                        <input type="hidden" name="conference_id" value="{{ $conference->id }}">
                        <input type="hidden" name="current_page" value="{{ $getAllConferenceRegister->currentPage() }}">
                        <button type="submit" class="primary-btn-filter">Sent Certificate</button>
                    </form>
                </div>
            @endcan
        </div>

    </div>
@endsection
