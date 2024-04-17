@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel-heading">
            Conference Registration International List
        </div>
        <div class="table-responsive table-content">
            <table class="table table-striped b-t b-light table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>Title</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Gender</th>
                        <th>Official Company Name</th>
                        <th>Country</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Register type</th>
                        <th>Fee</th>
                        <th>Registration time</th>
                        <th>Status</th>
                        <th style="width:60px;">Management</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getAllConferenceRegisterInternational as $key => $en_register)
                        <tr>
                            <td>{{ $en_register->en_register_id }}</td>
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
                            <td>{{ \Carbon\Carbon::parse($en_register->created_at)->format('d/m/Y H:i:s') }}</td>
                            <td>
                                @if ($en_register->payment_status == 1)
                                    <span style="color: #27c24c;">Wait checking</span>
                                @elseif ($en_register->payment_status == 2)
                                    <span style="color: #FCB322;">Paid and waiting for check</span>
                                @elseif ($en_register->payment_status == 3)
                                    <span style="color: #c037df;">Waiting for addition</span>
                                @elseif ($en_register->payment_status == 4)
                                    <span style="color: #0071e3;">Processed and sent mail</span>
                                @endif
                            </td>
                            <td class="management">
                                <a href="{{ Route('editConferenceRegisterInternational', $en_register->en_register_id) }}"
                                    class="management-btn" ui-toggle-class=""><i
                                        class="fa fa-pencil-square-o text-success text-active"></i>
                                </a>
                                <form action="{{ Route('deleteConferenceRegisterInternational', $en_register->en_register_id) }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="management-btn button-submit"><i class="fa fa-times text-danger text"></i></button>
                                </form>
                                <form action="{{ Route('sendMailReply', $en_register->en_register_id) }}" method="POST">
                                    @method('patch')
                                    @csrf
                                    <input type="hidden" name="email" value="{{ $en_register->en_register_email }}">
                                    <input type="hidden" name="type" value="en_register">
                                    <button type="submit" class="management-btn button-submit"><i class="far fa-envelope"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $getAllConferenceRegisterInternational->links('pagination::bootstrap-4') }}
        <div class="export-excel">
            <form action="{{ route('export-excel') }}" method="POST">
                @csrf
                <input type="hidden" name="conference_id" value="{{ $conference_id }}">
                <input type="hidden" name="export_type" value="enrt">
                <div class="col-md-3">
                    <button type="submit" class="primary-btn-filter">Export Excel</button>
                </div>
            </form>
        </div>
    </div>
@endsection