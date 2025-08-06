@extends('layouts.default_auth')
@section('title', __('conference.en.register_title') . ' - ')
@push('css')
    <link href="{{ versionResource('assets/styles/landing/table/support/select2.css') }}" rel="stylesheet" as="style" />
@endpush
@section('content')
    <div class="table-agile-info">
        <div class="panel-heading">
            @lang('conference.en.register_title') - {{ $conference->conference_title }}
        </div>
        <div class="filter-section">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="filter-tiles">
                        <div class="filter-title">
                            <p class="filter-title-text">
                                Counting Statistics
                            </p>
                        </div>
                        <ul class="filter-content">
                            <li class="filter-content-block">
                                <div class="filter-content-title">
                                    •&nbsp;Total Participants :
                                </div>
                                <div class="filter-content-details">{{ $getAllConferenceRegister->total() }}</div>
                            </li>
                            <li class="filter-content-block">
                                <div class="filter-content-title">
                                    •&nbsp;Theory :
                                </div>
                                <div class="filter-content-details">{{ $totalTheory['counter'] }}</div>
                            </li>
                            <li class="filter-content-block">
                                <div class="filter-content-title">
                                    •&nbsp;Practice :
                                </div>
                                <div class="filter-content-details">{{ $totalPractice['counter'] }}</div>
                            </li>
                            <li class="filter-content-block">
                                <div class="filter-content-title">
                                    •&nbsp;CME :
                                </div>
                                <div class="filter-content-details">{{ $totalCME['counter'] }}</div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="filter-tiles">
                        <div class="filter-title">
                            <p class="filter-title-text">
                                Financial Statistics
                            </p>
                        </div>
                        <ul class="filter-content">
                            <li class="filter-content-block">
                                <div class="filter-content-title">
                                    •&nbsp;Total Amount :
                                </div>
                                <div class="filter-content-details">
                                    {{ number_format($totalAmount['prices'], 0, ',', '.') . '₫' }}
                                </div>
                            </li>
                            <li class="filter-content-block">
                                <div class="filter-content-title">
                                    •&nbsp;Theoretical Total :
                                </div>
                                <div class="filter-content-details">
                                    {{ number_format($totalTheory['prices'], 0, ',', '.') . '₫' }}
                                </div>
                            </li>
                            <li class="filter-content-block">
                                <div class="filter-content-title">
                                    •&nbsp;Total Practice :
                                </div>
                                <div class="filter-content-details">
                                    {{ number_format($totalPractice['prices'], 0, ',', '.') . '₫' }}
                                </div>
                            </li>
                            <li class="filter-content-block">
                                <div class="filter-content-title">
                                    •&nbsp;Total CME :
                                </div>
                                <div class="filter-content-details">
                                    {{ number_format($totalCME['prices'], 0, ',', '.') . '₫' }}
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="filter-tiles">
                        <div class="filter-title">
                            <p class="filter-title-text">
                                Status Statistics
                            </p>
                        </div>
                        <ul class="filter-content">
                            <li class="filter-content-block">
                                <div class="filter-content-title">
                                    <span style="color: #27c24c;">•&nbsp;@lang('conference.en.status.step1') :</span>
                                </div>
                                <div class="filter-content-details">{{ $totalStatus['status1'] }}</div>
                            </li>
                            <li class="filter-content-block">
                                <div class="filter-content-title">
                                    <span style="color: #FCB322;">•&nbsp;@lang('conference.en.status.step2') :</span>
                                </div>
                                <div class="filter-content-details">{{ $totalStatus['status2'] }}</div>
                            </li>
                            <li class="filter-content-block">
                                <div class="filter-content-title">
                                    <span style="color: #c037df;">•&nbsp;@lang('conference.en.status.step3') :</span>
                                </div>
                                <div class="filter-content-details">{{ $totalStatus['status3'] }}</div>
                            </li>
                            <li class="filter-content-block">
                                <div class="filter-content-title">
                                    <span style="color: #0071e3;">•&nbsp;@lang('conference.en.status.step4') :</span>
                                </div>
                                <div class="filter-content-details">{{ $totalStatus['status4'] }}
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive table-content">
            <div id="table-scroll" class="table-scroll">
                <table class="table">
                    <thead>
                        <tr class="section-title">
                            <th>@lang('conference.en.create')</th>
                            <th>@lang('conference.en.id')</th>
                            <th>@lang('conference.en.code')</th>
                            <th>@lang('conference.en.degree')</th>
                            <th class="sticky-col first-col">@lang('conference.en.fullname')</th>
                            <th>@lang('conference.en.gender')</th>
                            <th>@lang('conference.en.date')</th>
                            <th>@lang('conference.en.month')</th>
                            <th>@lang('conference.en.year')</th>
                            <th>@lang('conference.en.email')</th>
                            <th>@lang('conference.en.phone')</th>
                            <th>@lang('conference.en.unit')</th>
                            <th>@lang('conference.en.type_register')</th>
                            <th>@lang('conference.en.cost')</th>
                            <th>@lang('conference.en.graduation_year')</th>
                            <th>@lang('conference.en.image')</th>
                            <th>@lang('conference.en.image_card')</th>
                            <th>@lang('conference.en.transfer_image')</th>
                            <th>@lang('conference.en.status.status')</th>
                            <th>@lang('conference.en.management')</th>
                        </tr>
                        <tr class="section-filter">
                            <th></th>
                            <th>
                                <select class="id select-2" multiple="multiple">
                                    @foreach ($idFilter as $id)
                                        <option value="{{ $id }}">
                                            {{ $id }}
                                        </option>
                                    @endforeach
                                </select>
                            </th>
                            <th>
                                <select class="register-code select-2" multiple="multiple">
                                    @foreach ($codeFilter as $code)
                                        <option value="{{ $code }}">
                                            {{ $code }}
                                        </option>
                                    @endforeach
                                </select>
                            </th>
                            <th></th>
                            <th class="sticky-col first-col">
                                <select class="register-name select-2" multiple="multiple">
                                    @foreach ($nameFilter as $name)
                                        <option value="{{ $name }}">
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>
                                <select class="register-email select-2" multiple="multiple">
                                    @foreach ($emailFilter as $email)
                                        <option value="{{ $email }}">
                                            {{ $email }}
                                        </option>
                                    @endforeach
                                </select>
                            </th>
                            <th>
                                <select class="register-phone select-2" multiple="multiple">
                                    @foreach ($phoneFilter as $phone)
                                        <option value="{{ $phone }}">
                                            {{ $phone }}
                                        </option>
                                    @endforeach
                                </select>
                            </th>
                            <th></th>
                            <th>
                                <select class="conference-fee-title select-2" multiple="multiple">
                                    @foreach ($conferenceFeeTitleFilter as $title)
                                        <option value="{{ $title }}">
                                            {{ $title }}
                                        </option>
                                    @endforeach
                                </select>
                            </th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>
                                <select class="payment-status select-2" multiple="multiple">
                                    @foreach ($paymentStatusFilter as $status)
                                        <option value="{{ $status }}">
                                            @if ($status == 1)
                                                @lang('conference.en.status.step1')</span>
                                            @elseif ($status == 2)
                                                @lang('conference.en.status.step2')</span>
                                            @elseif ($status == 3)
                                                @lang('conference.en.status.step3')</span>
                                            @elseif ($status == 4)
                                                @lang('conference.en.status.step4')</span>
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="tbody-content">
                        @foreach ($getAllConferenceRegister as $key => $register)
                            <tr class="section-item">
                                <td>{{ \Carbon\Carbon::parse($register->created_at)->format('H:i:s d/m/Y') }}</td>
                                <td>{{ $register->id }}</td>
                                <td>{{ $register->register_code }}</td>
                                <td>{{ $register->register_degree }}</td>
                                <td class="sticky-col first-col">{{ $register->register_name }}</td>
                                <td>{{ $register->register_gender == 0 ? 'Nam' : 'Nữ' }}</td>
                                <td>{{ $register->register_date }}</td>
                                <td>{{ $register->register_month }}</td>
                                <td>{{ $register->register_year }}</td>
                                <td>{{ $register->register_email }}</td>
                                <td>{{ $register->register_phone }}</td>
                                <td>{{ $register->register_work_unit }}</td>
                                <td>{{ $register->conference_fee_title }}</td>
                                <td>{{ $register->payment_price < 1000 ? '$' . number_format($register->payment_price, 2) : number_format($register->payment_price, 0, ',', '.') . '₫' }}
                                </td>
                                <td>{{ $register->register_graduation_year }}</td>
                                <td>
                                    @if ($register->register_image)
                                        <a href="https://drive.google.com/file/d/{{ $register->register_image }}/view"
                                            target="_blank">
                                            @lang('conference.en.link')
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @if ($register->register_image_card)
                                        <a href="https://drive.google.com/file/d/{{ $register->register_image_card }}/view"
                                            target="_blank">
                                            @lang('conference.en.link')
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @if ($register->payment_image)
                                        <a href="https://drive.google.com/file/d/{{ $register->payment_image }}/view"
                                            target="_blank">
                                            @lang('conference.en.link')
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @if ($register->payment_status == 1)
                                        <span style="color: #27c24c;">@lang('conference.en.status.step1')
                                        @elseif ($register->payment_status == 2)
                                            <span style="color: #FCB322;">@lang('conference.en.status.step2')
                                            @elseif ($register->payment_status == 3)
                                                <span style="color: #c037df;">@lang('conference.en.status.step3')
                                                @elseif ($register->payment_status == 4)
                                                    <span style="color: #0071e3;">@lang('conference.en.status.step4')
                                    @endif
                                </td>
                                <td class="management">
                                    <a href="{{ Route('conference_register.edit', [$conference->conference_code, $register->id]) }}"
                                        class="management-btn" title="@lang('vart_define.button.update')">
                                        <i class="fa fa-pencil-square-o text-success text-active"></i>
                                    </a>
                                    <form
                                        action="{{ Route('conference_register.copy', [$conference->conference_code, $register->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="management-btn button-submit"
                                            title="@lang('vart_define.button.copy')">
                                            <i class="fa-regular fa-copy btn-copy"></i>
                                        </button>
                                    </form>
                                    @can('isAdmin')
                                        <form action="{{ Route('conference_register.destroy', $register->id) }}"
                                            method="POST" id="delete-form">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="management-btn button-delete"
                                                title="@lang('vart_define.button.delete')">
                                                <i class="fa fa-times text-danger text"></i>
                                            </button>
                                        </form>
                                    @endcan
                                    <form action="{{ Route('mail.reply', $register->id) }}" method="POST"
                                        id="mail-form-{{ $register->id }}">
                                        @csrf
                                        <input type="hidden" name="type" value="register">
                                        <button type="submit" class="management-btn button-submit button-mail"
                                            title="@lang('vart_define.button.mail')">
                                            <i class="far fa-envelope btn-mail"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="table-pagination">
            @include('layouts.section.pagination_showing_current', [
                'items' => $getAllConferenceRegister,
            ])
            {{ $getAllConferenceRegister->links('pagination::custom') }}
        </div>
        <div class="export-excel">
            <div class="col-md-2">
                <input type="hidden" name="current_page" value="{{ $getAllConferenceRegister->currentPage() }}">
                <form action="{{ route('export.excel') }}" method="POST">
                    @csrf
                    <input type="hidden" name="conference_id" value="{{ $conference->id }}">
                    <input type="hidden" name="export_type" value="vnrt">
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
@push('js')
    <script type="text/javascript">
        var url_filter_register = "{{ route('conference_register.filter') }}";
    </script>
    <script src="{{ versionResource('assets/js/support/select.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/conference/register.js') }}" defer></script>
@endpush
