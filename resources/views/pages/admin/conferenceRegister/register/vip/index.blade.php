@extends('layouts.default_auth')
@section('title', __('conference.en.vip_register_title') . ' - ')
@section('content')
    <div class="table-agile-info">
        <div class="panel-heading">
            @lang('conference.en.vip_register_title') - {{ $conference->conference_title }}
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
                            <th>@lang('conference.en.fullname')</th>
                            <th>@lang('conference.en.gender')</th>
                            <th>@lang('conference.en.date')</th>
                            <th>@lang('conference.en.month')</th>
                            <th>@lang('conference.en.year')</th>
                            <th>@lang('conference.en.unit')</th>
                            <th>@lang('conference.en.email')</th>
                            <th>@lang('conference.en.phone')</th>
                            <th>@lang('conference.en.dinner')</th>
                            <th>@lang('conference.en.hotel')</th>
                            <th>@lang('conference.en.address')</th>
                            <th>@lang('conference.en.image')</th>
                            {{-- <th>@lang('conference.en.management')</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($getAllConferenceRegisterVip as $key => $vip)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($vip->created_at)->format('H:i:s d/m/Y') }}</td>
                                <td>{{ $vip->id }}</td>
                                <td>{{ $vip->vip_code }}</td>
                                <td>{{ $vip->vip_degree }}</td>
                                <td>{{ $vip->vip_name }}</td>
                                <td>{{ $vip->vip_gender == 0 ? 'Nam' : 'Nữ' }}</td>
                                <td>{{ $vip->vip_date }}</td>
                                <td>{{ $vip->vip_month }}</td>
                                <td>{{ $vip->vip_year }}</td>
                                <td>{{ $vip->vip_work_unit }}</td>
                                <td>{{ $vip->vip_email }}</td>
                                <td>{{ $vip->vip_phone }}</td>
                                <td>{{ $vip->vip_dinner == 1 ? '<span style="color: #27c24c;">Có</span>' : '<span style="color: #f05050;">Không</span>' }}</td>
                                <td>{{ $vip->vip_hotel == 1 ? '<span style="color: #27c24c;">Có</span>' : '<span style="color: #f05050;">Không</span>' }}</td>
                                <td>{{ $vip->vip_receiving_address }}</td>
                                <td>
                                    @if ($vip->vip_image)
                                        <a href="https://drive.google.com/file/d/{{ $vip->vip_image }}/view"
                                            target="_blank">
                                            @lang('conference.en.link')
                                        </a>
                                    @endif
                                </td>
                                {{-- <td class="management">
                                <a href="{{ Route('conference_vip_register.edit', [$conference->conference_code, $vip->id]) }}"
                                    class="management-btn" title="@lang('vart_define.button.update')">
                                    <i class="fa fa-pencil-square-o text-success text-active"></i>
                                </a>
                                <form action="{{ Route('conference_vip_register.destroy', $vip->id) }}" method="POST"
                                    id="delete-form">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="management-btn button-delete" title="@lang('vart_define.button.delete')">
                                        <i class="fa fa-times text-danger text"></i>
                                    </button>
                                </form>
                            </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @include('layouts.section.pagination_showing_current', [
            'items' => $getAllConferenceRegisterVip,
        ])
        {{ $getAllConferenceRegisterVip->links('pagination::custom') }}
        <div class="export-excel">
            <form action="{{ route('export.excel') }}" method="POST">
                @csrf
                <input type="hidden" name="conference_id" value="{{ $conference->id }}">
                <input type="hidden" name="export_type" value="viprt">
                <div class="col-md-3">
                    <button type="submit" class="primary-btn-filter">@lang('conference.en.export_excel')</button>
                </div>
            </form>
        </div>
    </div>
@endsection
